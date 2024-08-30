<?php

namespace App\Listeners;

use App\Events\EscanerQrEvent;
use App\Repository\LogAccesoRepository;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegistrarEnElLogAccesoListenner
{
    /**
     * Create the event listener.
     */
    public function __construct(
        public LogAccesoRepository $LogAccesoRepository,
        ){}

    /**
     * Handle the event.
     */
    public function handle(EscanerQrEvent $EscanerQrEvent): void
    {

        $data=$EscanerQrEvent->data;
        $datetime = new DateTime();
        $fecha = $datetime->format('Y-m-d');
        $hora = $datetime->format('H:i:s');

        $datosLog=[
            "mensaje" => $data["mensaje"],
            "fecha" => $fecha,
            "hora" => $hora,
            "lado" => $data["lado"],
            "qr_usuario_id" => $data["qr"]->id,
            "puerta_id" => $data["puerta"]->id,
            "user_id" =>  $data["user_id"],
        ];

        $this->LogAccesoRepository->registrar($datosLog);

    }
}
