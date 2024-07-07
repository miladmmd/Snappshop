<?php

namespace Modules\Payment\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Enums\AccountStatusEnum;
use Modules\Payment\Models\Account;
use Modules\Payment\Models\Bank;
use Modules\Users\Models\User;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        User::all()->map(function (User $user) use($faker){
             $faker->numberBetween(500000, 1000000);
            $this->generateAccount(
                userId: $user->getAttribute('id'),
                balance: $faker->numberBetween(500000, 1000000),
                repeats: $faker->numberBetween(1, 5)
            );
        });
    }


    protected function generateUniqueAccountNumber()
    {
        $accountNumber = rand(100000, 999999);
        while (DB::table('accounts')->where('account_number', $accountNumber)->exists()) {
            $accountNumber = rand(100000, 999999);
        }
        return $accountNumber;
    }

    protected function generateAccount($userId,$balance,$repeats)
    {
        for ($j = 0; $j < $repeats ; $j++) {
           $payload =  [
                'account_number' => $this->generateUniqueAccountNumber(),
                'user_id' => $userId,
                'balance' => $balance,
                'bank_id' => Bank::all('id')->random(1)->pluck('id')->first(), // Assuming you have 10 banks in your 'banks' table
                'currency' => 'IRR',
                'status' => AccountStatusEnum::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            Account::query()->create($payload);
        }

    }
}
