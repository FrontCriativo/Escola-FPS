<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'borrowed_at',
        'due_at',
        'returned_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'borrowed_at' => 'datetime',
            'due_at' => 'datetime',
            'returned_at' => 'datetime',
        ];
    }

    public static function statusOptions(): array
    {
        return [
            'borrowed' => 'Emprestado',
            'returned' => 'Devolvido',
            'overdue' => 'Atrasado',
            'lost' => 'Perdido',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Loan $loan) {
            $loan->borrowed_at ??= now();
            $loan->due_at ??= now()->addDays(14);
        });

        static::created(function (Loan $loan) {
            if (in_array($loan->status, ['borrowed', 'overdue'], true)) {
                Book::whereKey($loan->book_id)
                    ->where('copies_available', '>', 0)
                    ->decrement('copies_available');
            }
        });

        static::updating(function (Loan $loan) {
            if ($loan->status === 'returned' && $loan->returned_at === null) {
                $loan->returned_at = now();
            }
        });

        static::updated(function (Loan $loan) {
            $wasActive = in_array($loan->getOriginal('status'), ['borrowed', 'overdue'], true);
            $isActive = in_array($loan->status, ['borrowed', 'overdue'], true);

            if ($wasActive && ! $isActive) {
                $loan->book?->increment('copies_available');
            }

            if (! $wasActive && $isActive) {
                Book::whereKey($loan->book_id)
                    ->where('copies_available', '>', 0)
                    ->decrement('copies_available');
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
