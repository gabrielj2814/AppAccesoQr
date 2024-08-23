<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Repository\PerfilRepository;
use App\Repository\PersonaRepository;
use App\Repository\TipoUsuarioRepository;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Collection;

class CreateUser extends CreateRecord
{


    protected static string $recordTitleAttribute = "name";

    protected static string $resource = UserResource::class;

    public function form(Form $form): Form{
        $PersonaRepository= new PersonaRepository();
        $personas=$PersonaRepository->consultarTodo();
        $personaOpciones=$this->serializarDatosParaElInputSelect($personas,"id_persona","nombre");
        $TipoUsuarioRepository= new TipoUsuarioRepository();
        $tiposUsuarios=$TipoUsuarioRepository->consultarTodo();
        $tipoUsuarioOpciones=$this->serializarDatosParaElInputSelect($tiposUsuarios,"id_tipo_usuario","nombre");
        $PerfilRepository= new PerfilRepository();
        $perfiles=$PerfilRepository->consultarTodo();
        $perfilOpciones=$this->serializarDatosParaElInputSelect($perfiles,"id_perfil","nombre");

        return $form->schema([
           Section::make("Formulario")
           ->schema([
               Select::make("id_persona")
                   ->label("Persona")
                   ->options($personaOpciones)
                   ->searchable()
                   ->required(),
                TextInput::make('name')->label("Nickname")->required()->autocomplete(false),
                TextInput::make('email')->email()->required()->autocomplete(false),
                Select::make("id_perfil")
                    ->label("Perfiles")
                    ->options($perfilOpciones)
                    ->searchable()
                    ->required(),
                Select::make("id_tipo_usuario")
                    ->label("Tipo de Usuarios")
                    ->options($tipoUsuarioOpciones)
                    ->searchable()
                    ->required(),
                Radio::make('status')
                    ->boolean()
                    ->inline()
                    ->inlineLabel(false)
                    ->required(),
            ]),

        ]);
    }

    function serializarDatosParaElInputSelect(Collection $data,string $id,string $valorHaMostrar){
        $opciones=[];
        for ($index=0; $index < count($data) ; $index++) {
            # code...
            $registro=$data[$index]->toArray();
            $opciones[$registro[$id]] =$registro[$valorHaMostrar];
        }
        return $opciones;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User updated')
            ->body('The user has been saved successfully.');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
