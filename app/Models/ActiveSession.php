<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActiveSession extends Model
{
    protected $table = 'sessions';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'last_activity' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLastSeenAtAttribute(): ?string
    {
        return $this->last_activity ? now()->setTimestamp($this->last_activity)->format('d/m/Y H:i') : null;
    }

    public function getIsOnlineAttribute(): bool
    {
        return $this->last_activity >= now()->subMinutes(15)->timestamp;
    }
}
