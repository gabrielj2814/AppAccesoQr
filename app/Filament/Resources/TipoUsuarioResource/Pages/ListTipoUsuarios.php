<?php

namespace App\Filament\Resources\TipoUsuarioResource\Pages;

use App\Filament\Resources\TipoUsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoUsuarios extends ListRecords
{
    protected static string $resource = TipoUsuarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
