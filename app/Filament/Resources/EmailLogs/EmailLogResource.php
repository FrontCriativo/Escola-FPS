<?php

namespace App\Filament\Resources\EmailLogs;

use App\Filament\Resources\EmailLogs\Pages\ListEmailLogs;
use App\Filament\Resources\EmailLogs\Pages\ViewEmailLog;
use App\Filament\Resources\EmailLogs\Schemas\EmailLogInfolist;
use App\Filament\Resources\EmailLogs\Tables\EmailLogsTable;
use App\Models\EmailLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EmailLogResource extends Resource
{
    protected static ?string $model = EmailLog::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;
    protected static string|UnitEnum|null $navigationGroup = 'Comunicacao';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'email enviado';
    protected static ?string $pluralModelLabel = 'emails enviados';

    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }

    public static function infolist(Schema $schema): Schema { return EmailLogInfolist::configure($schema); }
    public static function table(Table $table): Table { return EmailLogsTable::configure($table); }

    public static function getPages(): array
    {
        return [
            'index' => ListEmailLogs::route('/'),
            'view' => ViewEmailLog::route('/{record}'),
        ];
    }
}
