<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            TextInput::make('name')->label('Nome')->required()->maxLength(255),
            TextInput::make('email')->label('Email')->email()->required()->maxLength(255),
            TextInput::make('password')->label('Senha')->password()->required(fn (string $operation): bool => $operation === 'create')->dehydrated(fn ($state): bool => filled($state))->maxLength(255),
            Toggle::make('is_admin')->label('Admin')->default(false),
            DateTimePicker::make('email_verified_at')->label('Email verificado em')->default(now()),
        ]);
    }
}
