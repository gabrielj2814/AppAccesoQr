<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Pages\PerfilUsuario;
use App\Filament\Resources\UserResource;
use App\Repository\PerfilRepository;
use App\Repository\PersonaRepository;
use App\Repository\TipoUsuarioRepository;
use Filament\Actions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Collection;

class EditUser extends EditRecord
{
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
                TextInput::make('name')->label("Nickname")->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('pin')->minLength(4)->maxLength(4),
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User updated de forma piola')
            ->body('The user has been saved successfully siiiiiiiiiiiiiiii.');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected function getRedirectUrl(): string
    // {
    //    return PerfilUsuario::getUrl();
    // }
}
