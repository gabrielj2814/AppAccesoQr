<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\UserResource;
use App\Repository\ZonaRepository;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccesoRelationManager extends RelationManager
{
    protected static string $relationship = 'acceso';

    public function form(Form $form): Form
    {

        $ZonaRepository= new ZonaRepository();
        $zonas=$ZonaRepository->consultarTodo();

        if (count($zonas)==0) {
            // Mostrar notificación si la condición no se cumple
            Notification::make()
                ->title('Acceso Denegado')
                ->body('No hay zonas registradas para poder asignarle al usuario.')
                ->warning()
                ->send();

            // Redirigir al índice del recurso o a la página de edición
            redirect(UserResource::getUrl('edit', ['record' => $this->ownerRecord->getKey()]));
        }


        $zonaOpciones=$this->serializarDatosParaElInputSelect($zonas,"id","nombre");

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
                    ->label("Usuario: ".$this->ownerRecord->name),
                    Hidden::make("user_id")->default($this->ownerRecord->id),
                    Select::make("zona_id")
                        ->label("Zona")
                        ->options($zonaOpciones)
                        ->searchable()
                        ->required(),
                ]),

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
            ->recordTitleAttribute('Acceso')
            ->columns([
                Tables\Columns\TextColumn::make('zona.nombre')->label("Zona"),
                Tables\Columns\TextColumn::make('zona.numero_puertas')->label("Puertas"),
            ])
            ->filters([
                //
                TrashedFilter::make(),
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
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
