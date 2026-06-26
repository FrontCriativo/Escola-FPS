<?php

namespace App\Filament\Resources\ActiveSessions\Pages;

use App\Filament\Resources\ActiveSessions\ActiveSessionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateActiveSession extends CreateRecord
{
    protected static string $resource = ActiveSessionResource::class;
}
