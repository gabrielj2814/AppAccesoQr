<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermisoResource\Pages;
use App\Filament\Resources\PermisoResource\RelationManagers;
use App\Models\Permiso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermisoResource extends Resource
{
    protected static ?string $recordTitleAttribute = "nombre";

    protected static ?string $model = Permiso::class;

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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPermisos::route('/'),
            'create' => Pages\CreatePermiso::route('/create'),
            'edit' => Pages\EditPermiso::route('/{record}/edit'),
        ];
    }
}
