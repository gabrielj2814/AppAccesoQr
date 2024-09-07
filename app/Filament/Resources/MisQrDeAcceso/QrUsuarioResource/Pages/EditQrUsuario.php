<?php

namespace App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource\Pages;

use App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQrUsuario extends EditRecord
{
    protected static string $resource = QrUsuarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
