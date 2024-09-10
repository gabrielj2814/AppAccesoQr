<?php

namespace App\Filament\Resources\MisQrDeAcceso;

use App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource\Pages;
use App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource\RelationManagers;
use App\Models\QrUsuario;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QrUsuarioResource extends Resource
{
    protected static ?string $model = QrUsuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel="Mis Qr";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {

        $usuario=Auth::user();
        // return parent::getEloquentQuery()->where('user_id', $usuario->id)->where('status', 1);
        return parent::getEloquentQuery()->where('user_id', $usuario->id);

    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("created_at")->label("Creado")->date()->description(fn (QrUsuario $record): string => $record->uuid),
                TextColumn::make("fecha_vencimiento")->date(),
                ToggleColumn::make('status'),
                // IconColumn::make("status")->boolean(),
            ])
            ->filters([
                // Filter::make('status')->label("Qr de baja")->query(fn($query): Builder => $query->where("status","0")),
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
                // Tables\Actions\EditAction::make(),
                Action::make('updateQrFechaVencimiento')
                ->label("Editar")
                ->fillForm(fn (QrUsuario $record): array => [
                    'id' => $record->id,
                    'fecha_vencimiento' => $record->fecha_vencimiento,
                    'se_puede_vencer' => $record->se_puede_vencer,
                ])
                ->form([
                    Hidden::make("id"),
                    DateTimePicker::make("fecha_vencimiento")->label("Fecha de vencimiente")->time(false),
                    Checkbox::make("se_puede_vencer")->label("Se Puede Vencer"),
                ])
                ->action(function (array $data, QrUsuario $record): void {
                    $record->save();
                })
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
            'index' => Pages\ListQrUsuarios::route('/'),
            // 'create' => Pages\CreateQrUsuario::route('/create'),
            // 'edit' => Pages\EditQrUsuario::route('/{record}/edit'),
        ];
    }
}
