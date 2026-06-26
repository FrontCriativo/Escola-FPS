<?php

namespace App\Filament\Resources\ActiveSessions\Pages;

use App\Filament\Resources\ActiveSessions\ActiveSessionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewActiveSession extends ViewRecord
{
    protected static string $resource = ActiveSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
