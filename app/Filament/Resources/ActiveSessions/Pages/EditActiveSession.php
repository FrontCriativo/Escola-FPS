<?php

namespace App\Filament\Resources\ActiveSessions\Pages;

use App\Filament\Resources\ActiveSessions\ActiveSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditActiveSession extends EditRecord
{
    protected static string $resource = ActiveSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
