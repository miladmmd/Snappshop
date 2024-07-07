<?php

namespace Modules\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Notifications\Database\Factories\TemplateFactory;

class Template extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'service_id',
        'topic'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
