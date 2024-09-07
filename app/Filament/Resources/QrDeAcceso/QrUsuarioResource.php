<?php

namespace App\Filament\Resources\QrDeAcceso;

use App\Filament\Resources\QrDeAcceso\QrUsuarioResource\Pages;
use App\Filament\Resources\QrDeAcceso\QrUsuarioResource\RelationManagers;
use App\Models\QrUsuario;
use App\Repository\UsuarioRepository;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QrUsuarioResource extends Resource
{
    protected static ?string $model = QrUsuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel="Qr De Acceso";

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
                TextColumn::make("created_at")->label("Creado")->date()->description(fn (QrUsuario $record): string => $record->uuid),
                TextColumn::make("fecha_vencimiento")->date(),
                IconColumn::make("status")->boolean(),
            ])
            ->filters([
                //
                SelectFilter::make("usuario")
                ->relationship('user.persona', 'nombre', fn (Builder $query) => $query->withTrashed()),
                Filter::make('Fecha')
                ->form([
                    DatePicker::make('fecha_desde')->default(now()->firstOfMonth()),
                    DatePicker::make('fecha_hasta')->default(now()->lastOfMonth()),

                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['fecha_desde'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['fecha_hasta'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                }),
            ])
            ->actions([
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    static function serializarDatosParaElInputSelect(Collection $data,string $id,string $valorHaMostrar){
        $opciones=[];
        for ($index=0; $index < count($data) ; $index++) {
            # code...
            $registro=$data[$index]->toArray();
            $opciones[$registro[$id]] =$registro[$valorHaMostrar];
        }
        return $opciones;
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
            'index' => Pages\ListQrUsuarios::route('/'),
            // 'create' => Pages\CreateQrUsuario::route('/create'),
            // 'edit' => Pages\EditQrUsuario::route('/{record}/edit'),
        ];
    }
}
