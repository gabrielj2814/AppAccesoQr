<?php

namespace App\Filament\Resources\PermisoResource\Pages;

use App\Filament\Resources\PermisoResource;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePermiso extends CreateRecord
{
    protected static string $resource = PermisoResource::class;

    public function form(Form $form): Form{
        return $form->schema([
            Section::make("Formulario")->schema([
                TextInput::make('nombre')->label("Nombre")->required()->autocomplete(false),
                Radio::make('status')
                ->boolean()
                ->inline()
                ->inlineLabel(false)
                ->required(),
            ]),
        ]);
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Recurso creado con exito')
            ->body('OK.');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}
