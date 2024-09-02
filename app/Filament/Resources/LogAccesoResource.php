<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogAccesoResource\Pages;
use App\Filament\Resources\LogAccesoResource\RelationManagers;
use App\Models\LogAcceso;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogAccesoResource extends Resource
{
    protected static ?string $model = LogAcceso::class;

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
                TextColumn::make("user.persona.nombre")->label("Usuario"),
                TextColumn::make("user.persona.apellido")->label("Apellido"),
                TextColumn::make("user.email")->label("Email"),
                TextColumn::make("puerta.zona.nombre")->label("Zona")->description(fn (LogAcceso $record): string => $record->mensaje),
                TextColumn::make("puerta.nombre")->label("Puerta"),
                TextColumn::make("puerta.codigo")->label("Codigo Puerta"),
                TextColumn::make("fecha")->label("Fecha")->date(),
                TextColumn::make("hora")->label("Hora"),
                TextColumn::make("lado")->label("Lado"),
            ])
            ->filters([
                //
                SelectFilter::make("usuario")
                ->relationship('user.persona', 'nombre', fn (Builder $query) => $query->withTrashed()),
                SelectFilter::make("Zona")
                ->relationship('puerta.zona', 'nombre', fn (Builder $query) => $query->withTrashed()),
                Filter::make('Fecha')
                ->form([
                    DatePicker::make('fecha_desde')->default(now()),
                    DatePicker::make('fecha_hasta')->default(now()),

                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['fecha_desde'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha', '>=', $date),
                        )
                        ->when(
                            $data['fecha_hasta'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha', '<=', $date),
                        );
                }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListLogAccesos::route('/'),
            // 'create' => Pages\CreateLogAcceso::route('/create'),
            // 'edit' => Pages\EditLogAcceso::route('/{record}/edit'),
        ];
    }
}
