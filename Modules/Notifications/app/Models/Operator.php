<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Notifications\Enums\OperatorStatusEnum;

class Operator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'code',
        'status',
        'regex'
    ];

    protected $casts = [
        'status' => OperatorStatusEnum::class
    ];

}
