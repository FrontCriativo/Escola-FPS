<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'isbn',
        'publisher',
        'publication_year',
        'pages',
        'description',
        'cover_path',
        'accent_color',
        'shelf_location',
        'status',
        'copies_total',
        'copies_available',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'publication_year' => 'integer',
            'pages' => 'integer',
            'copies_total' => 'integer',
            'copies_available' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public static function statusOptions(): array
    {
        return [
            'available' => 'Disponivel',
            'reserved' => 'Reservado',
            'maintenance' => 'Manutencao',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans(): HasMany
    {
        return $this->loans()->whereIn('status', ['borrowed', 'overdue']);
    }

    public function getIsAvailableAttribute(): bool
    {
        return $this->status === 'available' && $this->copies_available > 0;
    }
}
