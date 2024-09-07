<?php

namespace App\Filament\Resources\QrDeAcceso\QrUsuarioResource\Pages;

use App\Filament\Resources\QrDeAcceso\QrUsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
