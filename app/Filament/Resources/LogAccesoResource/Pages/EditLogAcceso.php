<?php

namespace App\Filament\Resources\LogAccesoResource\Pages;

use App\Filament\Resources\LogAccesoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLogAcceso extends EditRecord
{
    protected static string $resource = LogAccesoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
