<?php

namespace App\Filament\Resources\PersonaResource\Pages;

use App\Filament\Resources\PersonaResource;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPersona extends EditRecord
{
    protected static string $resource = PersonaResource::class;

    public function form(Form $form): Form{
        return $form->schema([
            Section::make("Formulario")->schema([
                TextInput::make('nombre')->label("Nombre")->required()->autocomplete(false),
                TextInput::make('apellido')->label("Apellido")->required()->autocomplete(false),
                Radio::make('status')
                ->boolean()
                ->inline()
                ->inlineLabel(false)
                ->required(),
            ]),
        ]);
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Recurso editado con exito')
            ->body('OK.');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
