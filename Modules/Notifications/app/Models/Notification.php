<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Notifications\Database\Factories\NotificationFactory;
use Modules\Notifications\Enums\NotificationStatusEnum;
use Modules\Notifications\Enums\NotificationTypeEnum;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'provider_id',
        'operator_id',
        'service_id',
        'template_id',
        'type',
        'status',
        'count_try',
        'argument',
        'mobile'
    ];
    protected $casts = [
        'status' => NotificationStatusEnum::class,
        'type' => NotificationTypeEnum::class
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function smsInfos(): HasMany
    {
        return $this->hasMany(SmsInfo::class,'notification_id','id');
    }

}
