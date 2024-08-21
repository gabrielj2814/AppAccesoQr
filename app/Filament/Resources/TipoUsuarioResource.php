<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoUsuarioResource\Pages;
use App\Filament\Resources\TipoUsuarioResource\RelationManagers;
use App\Models\TipoUsuario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoUsuarioResource extends Resource
{

    protected static ?string $recordTitleAttribute = "nombre";

    protected static ?string $model = TipoUsuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make("nombre"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTipoUsuarios::route('/'),
            'create' => Pages\CreateTipoUsuario::route('/create'),
            'edit' => Pages\EditTipoUsuario::route('/{record}/edit'),
        ];
    }
}
