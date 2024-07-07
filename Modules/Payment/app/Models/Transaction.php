<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Payment\Database\Factories\TransactionFactory;
use Modules\Payment\Enums\TransactionStatusEnum;
use Modules\Payment\Enums\TransactionTypeEnum;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'credit_card_id',
        'amount',
        'client_tracking',
        'currency',
        'type',
        'status'
    ];

    protected $casts = [
        "type" => TransactionTypeEnum::class,
        "status" => TransactionStatusEnum::class
    ];

    public function creditCard(): BelongsTo
    {
        return $this->belongsTo(CreditCard::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class,'transaction_id');
    }
}
