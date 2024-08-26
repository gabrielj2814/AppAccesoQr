<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class PerfilUsuario extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Mi Perfil';

    protected static string $view = 'filament.pages.perfil-usuario';

    // con esto puedo crear grupos de opciones en el menu y cambiarle el nombre en el item del menu
    // protected static ?string $navigationLabel = 'Custom Page';
    // protected static ?string $navigationGroup = 'Custom Pages';

    protected function getActions(): array
    {
        return [
            Action::make("hola")
            ->label('Custom Button')
            ->action('customButtonAction')
            ->color('primary')
            ->icon('heroicon-o-bell'),
        ];
    }

    public function customButtonAction(): void
    {
        // Lógica personalizada aquí
        Notification::make()
            ->title('Acción Personalizada Ejecutada')
            ->body('Has hecho clic en el botón personalizado')
            ->success()
            ->send();

        // Aquí puedes añadir cualquier otra lógica personalizada
    }


}
