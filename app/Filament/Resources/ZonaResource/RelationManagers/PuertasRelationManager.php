<?php

namespace App\Filament\Resources\ZonaResource\RelationManagers;

use App\Filament\Resources\ZonaResource;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PuertasRelationManager extends RelationManager
{
    protected static string $relationship = 'puertas';


    public function form(Form $form): Form
    {
        // numero_puertas

        // $puertas = $this->ownerRecord->puertas;
        // $numeroPuertas = (int)$this->ownerRecord->numero_puertas;
        //  // Verifica si ya se alcanzó el límite de puertas
        //  if (count($puertas) >= $numeroPuertas) {
        //     // Mostrar notificación si la condición no se cumple
        //     Notification::make()
        //         ->title('Acceso Denegado')
        //         ->body('Esta zona ya tiene todas las puertas asignadas.')
        //         ->warning()
        //         ->send();

        //     // Redirigir al índice del recurso o a la página de edición
        //     redirect(ZonaResource::getUrl('edit', ['record' => $this->ownerRecord->getKey()]));
        // }

        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 3,
                    'lg' => 3,
                    'xl' => 3,
                    '2xl' => 3,
                ])->schema([
                    Placeholder::make("informacion")
                    ->label("Zona: ".$this->ownerRecord->nombre),
                    Hidden::make("id_zona")->default($this->ownerRecord->id),
                    TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('codigo')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                    Checkbox::make('entrada')
                        ->default(true),
                    Checkbox::make('salida')
                        ->default(true),
                ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('codigo'),
                Tables\Columns\TextColumn::make('nombre'),
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
