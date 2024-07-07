<?php

namespace Modules\Payment\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Interfaces\Repositories\TransactionRepositoryInterfaces;
use Modules\Payment\Models\Transaction;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterfaces
{
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function getLastTenMinuteTransaction()
    {
        $now = Carbon::now();
        $topUsers = DB::table('transactions')->join(
                'credit_cards',
                'transactions.credit_card_id',
                '=',
                'credit_cards.id'
            )->join('accounts', 'credit_cards.account_id', '=', 'accounts.id')->join(
                'users',
                'accounts.user_id',
                '=',
                'users.id'
            )->where('transactions.created_at', '>=', $now->subMinute(10000))->select(
                'users.id as user_id',
                DB::raw('COUNT(transactions.id) as transaction_count')
            )->groupBy('users.id')->orderBy('transaction_count', 'desc')->limit(3)->pluck('user_id');
        $transactions = DB::table('transactions')->join(
                'credit_cards',
                'transactions.credit_card_id',
                '=',
                'credit_cards.id'
            )->join('accounts', 'credit_cards.account_id', '=', 'accounts.id')->join(
                'users',
                'accounts.user_id',
                '=',
                'users.id'
            )->whereIn('users.id', $topUsers)->select(
                'users.id as user_id',
                'transactions.id as transaction_id',
                'transactions.created_at',
                'transactions.amount'
            )->orderBy('users.id')->orderBy('transactions.created_at', 'desc')->get()->groupBy('user_id');

        $result = [];
        foreach ($topUsers as $userId) {
            $result[$userId] = [
                'user_id' => $userId,
                'transaction_count' => $transactions->get($userId)->count(),
                'recent_transactions' => $transactions->get($userId)->take(10),
            ];
        }
        return $result;
    }

}
