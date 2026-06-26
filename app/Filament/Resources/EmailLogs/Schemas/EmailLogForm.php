<?php

namespace App\Filament\Resources\EmailLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmailLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('sender_id')
                    ->relationship('sender', 'name'),
                Select::make('recipient_id')
                    ->relationship('recipient', 'name'),
                TextInput::make('recipient_email')
                    ->email()
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['sent' => 'Sent', 'failed' => 'Failed'])
                    ->default('sent')
                    ->required(),
                Textarea::make('error')
                    ->columnSpanFull(),
                DateTimePicker::make('sent_at'),
            ]);
    }
}
