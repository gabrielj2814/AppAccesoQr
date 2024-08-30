<?php

namespace App\Filament\Resources\ZonaResource\Pages;

use App\Filament\Resources\ZonaResource;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditZona extends EditRecord
{
    protected static string $resource = ZonaResource::class;


    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make("Formulario")
            ->schema([
                TextInput::make('nombre')->label("Nombre")->required()->autocomplete(false),
                DateTimePicker::make("horario_de_acceso_de_la_zona")->date(false),
                DateTimePicker::make("horario_de_cierre_de_la_zona")->date(false),
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
