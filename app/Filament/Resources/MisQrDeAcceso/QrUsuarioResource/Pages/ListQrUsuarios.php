<?php

namespace App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource\Pages;

use App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListQrUsuarios extends ListRecords
{
    protected static string $resource = QrUsuarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

}
