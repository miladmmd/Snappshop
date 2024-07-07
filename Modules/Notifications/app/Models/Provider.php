<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Notifications\Database\Factories\ProviderFactory;
use Modules\Notifications\Enums\ProviderStatusEnum;

class Provider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'status',
        'blacklist'
    ];
    protected $casts = [
        'status' =>ProviderStatusEnum::class
    ];

}
