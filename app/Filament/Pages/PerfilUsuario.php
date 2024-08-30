<?php

namespace App\Filament\Pages;

use App\Repository\QrUsuarioRepository;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Firebase\JWT\JWT;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            Action::make("botonActualizarAccesoDelQR")
            ->label('Actualizar Acceso QR')
            ->action('actualizarAccesoDelQR')
            ->color('primary')
            ->icon('heroicon-o-bell'),
        ];

    }

    protected function getViewData(): array
    {
        $user = Auth::user();
        $user->perfil;
        $user->tipoUsuario;
        $user->persona;
        $user->qrusuario;
        $user->acceso;
        $QrUsuarioRepository= new QrUsuarioRepository();
        $datos=$QrUsuarioRepository->consultarPorIdYOrdenarPor("user_id",$user->id,"created_at","DESC");
        $qrAcceso=null;
        if(count($datos)>0){
            $qrAcceso=$datos[0];
        }
        return [
            'user' => $user,
            'qrAcceso' => $qrAcceso,
        ];
    }

    public function actualizarAccesoDelQR(): void
    {

        // ->body('Has hecho clic en el botón personalizado')

        $user = Auth::user();
        $user->acceso;
        if(count($user->acceso)>0){

            $key=env("JWT_KEY");

            $accesos=[];
            for ($index=0; $index < count($user->acceso); $index++) {
                $accesos[]=$user->acceso[$index]->zona_id;
            }

            $uuid=Str::uuid();

            $playload=[
                "id_usuario"=> $user->id,
                "uuid"=>$uuid,
                "zonas"=> $accesos,
            ];

            $jwt= JWT::encode($playload,$key,'HS256');

            $datos=[
                "user_id" => $user->id,
                "uuid" => $uuid,
                "token_qr" => $jwt,
                "status" => true,
            ];

            $QrUsuarioRepository= new QrUsuarioRepository();
            $QrUsuarioRepository->registrar($datos);

            Notification::make("ok")
            ->title('Acceso del QR actualizado')
            ->success()
            ->send();

        }
        else{
            Notification::make("warning")
            ->title('Error al actualizar permisos')
            ->body("el usuario no tiene ningun zona asignada para poder actualizar le qr")
            ->warning()
            ->send();

        }

        redirect(PerfilUsuario::getUrl());



    }

}
