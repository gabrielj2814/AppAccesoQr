<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZonaResource\Pages;
use App\Filament\Resources\ZonaResource\RelationManagers;
use App\Filament\Resources\ZonaResource\RelationManagers\PuertasRelationManager;
use App\Models\Zona;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ZonaResource extends Resource
{

    protected static ?string $recordTitleAttribute = "nombre";

    protected static ?string $model = Zona::class;

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
                TextColumn::make("nombre")->label("Nombre"),
                TextColumn::make("numero_puertas")->label("Numero de Puertas"),
                TextColumn::make("horario_de_acceso_de_la_zona")->label("Hora Acceso"),
                TextColumn::make("horario_de_cierre_de_la_zona")->label("Hora Cierre"),
            ])
            ->filters([
                //
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PuertasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZonas::route('/'),
            'create' => Pages\CreateZona::route('/create'),
            'edit' => Pages\EditZona::route('/{record}/edit'),
        ];
    }
}
