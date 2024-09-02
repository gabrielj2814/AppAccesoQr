<?php

namespace App\Filament\Resources\LogAccesoResource\Pages;

use App\Filament\Resources\LogAccesoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogAccesos extends ListRecords
{
    protected static string $resource = LogAccesoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
