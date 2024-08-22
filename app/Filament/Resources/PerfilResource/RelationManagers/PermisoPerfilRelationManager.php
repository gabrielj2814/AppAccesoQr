<?php

namespace App\Filament\Resources\PerfilResource\RelationManagers;

use App\Models\PermisoPerfil;
use App\Repository\PerfilRepository;
use App\Repository\PermisoRepository;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermisoPerfilRelationManager extends RelationManager
{
    protected static string $relationship = 'PermisoPerfil';

    protected static ?string $model = PermisoPerfil::class;


    public function form(Form $form): Form
    {
        $permisoRepository= new PerfilRepository();
        $permisoRepository= new PermisoRepository();
        $permisos=$permisoRepository->consultarTodo();
        $permisosOpciones=$this->serializarDatosParaElInputSelect($permisos,"id","nombre");

        return $form
            ->schema([
                Placeholder::make("informacion")
                ->label($this->ownerRecord->nombre),
                Hidden::make("id_perfil")->default($this->ownerRecord->id_perfil),
                Select::make("permiso_id")
                    ->label("Permiso")
                    ->options($permisosOpciones)
                    ->searchable()
                    ->required(),
                Radio::make('status')
                    ->boolean()
                    ->inline()
                    ->inlineLabel(false)
                    ->required(),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Permisos')
            ->columns([
                TextColumn::make('permiso.nombre')->label("Permiso"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
