<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\AccesoRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\PerfilRelationManager;
use App\Models\Perfil;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?string $recordTitleAttribute = "name";

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            // ...
        ]);
    }

    // // Modifica la consulta que obtiene los registros
    // protected function getTableQuery()
    // {
    //     // Obtén el usuario autenticado
    //     $usuarioAutenticado = Auth::user();

    //     // Filtra los registros basados en una relación con el usuario autenticado
    //     // Por ejemplo, si tienes una columna user_id en tu modelo
    //     return parent::getTableQuery()->where('user_id', $usuarioAutenticado->id);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make("name")->label("Nickname"),
                TextColumn::make("persona.nombre")->label("Nombre"),
                TextColumn::make("persona.apellido")->label("Apellido"),
                TextColumn::make("perfil.nombre")->label("Perfil"),
                TextColumn::make("tipoUsuario.nombre")->label("Tipo de Usuario"),
                TextColumn::make("email")->label("Correo"),
                // IconColumn::make("status")->boolean(),
                // TextColumn::make("status")->formatStateUsing(function ($state) {
                //     return $state ? 'Activo' : 'Inactivo';
                // }),
            ])
            ->filters([
                //
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            AccesoRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return "Usuario";
    }
}
