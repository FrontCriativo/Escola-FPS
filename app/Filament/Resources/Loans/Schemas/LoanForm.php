<?php

namespace App\Filament\Resources\Loans\Schemas;

use App\Models\Loan;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            Select::make('user_id')->label('Conta')->relationship('user', 'name')->searchable()->preload()->required(),
            Select::make('book_id')->label('Livro')->relationship('book', 'title')->searchable()->preload()->required(),
            Select::make('status')->label('Status')->options(Loan::statusOptions())->default('borrowed')->required(),
            DateTimePicker::make('borrowed_at')->label('Emprestado em')->default(now()),
            DateTimePicker::make('due_at')->label('Devolver ate')->default(now()->addDays(14)),
            DateTimePicker::make('returned_at')->label('Devolvido em'),
            Textarea::make('notes')->label('Observacoes')->columnSpanFull(),
        ]);
    }
}
