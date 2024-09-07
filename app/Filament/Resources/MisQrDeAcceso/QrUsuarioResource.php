<?php

namespace App\Filament\Resources\MisQrDeAcceso;

use App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource\Pages;
use App\Filament\Resources\MisQrDeAcceso\QrUsuarioResource\RelationManagers;
use App\Models\QrUsuario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
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
        return parent::getEloquentQuery()->where('user_id', $usuario->id)->where('status', 1);

    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("created_at")->label("Creado")->date()->description(fn (QrUsuario $record): string => $record->uuid),
                TextColumn::make("fecha_vencimiento")->date(),
                IconColumn::make("status")->boolean(),
            ])
            ->filters([

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
            'index' => Pages\ListQrUsuarios::route('/'),
            // 'create' => Pages\CreateQrUsuario::route('/create'),
            // 'edit' => Pages\EditQrUsuario::route('/{record}/edit'),
        ];
    }
}
