<?php

namespace App\Http\Controllers;

use App\Events\EscanerQrEvent;
use App\Repository\AccesoUsuarioRepository;
use App\Repository\PuertaRepository;
use App\Repository\QrUsuarioRepository;
use App\Repository\UsuarioRepository;
use App\Repository\ZonaRepository;
use DateTime;
use DateTimeZone;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    //

    function __construct(

       public UsuarioRepository $UsuarioRepository,
       public ZonaRepository $ZonaRepository,
       public AccesoUsuarioRepository $AccesoUsuarioRepository,
       public QrUsuarioRepository $QrUsuarioRepository,
       public PuertaRepository $PuertaRepository,
    ){}

    function index(string $id_zona,string $codigo_puerta, string $lado){
        $respuestaServidor=[
            "status_code" => null,
            "data" => null,
            "mensaje" => null,
            "detalle" => [],
        ];

        $zona=$this->ZonaRepository->consultarPorId($id_zona);

        if(!$zona){
            $respuestaServidor["status_code"]=400;
            $respuestaServidor["mensaje"]="la zona no a sido encontrada";
            return new JsonResponse($respuestaServidor);
        }


        $puerta=$this->PuertaRepository->consultarPorUnCampo("codigo",$codigo_puerta,"=");

        if(count($puerta)==0){
            $respuestaServidor["status_code"]=400;
            $respuestaServidor["mensaje"]="la puerta no a sido encontrada";
            return new JsonResponse($respuestaServidor);
        }

        $validandoLado=null;
        if($lado=="entrada"){
            if($puerta[0]->entrada==true){
                $validandoLado="entrada";
            }
        }

        if($lado=="salida"){
            if($puerta[0]->salida==true){
                $validandoLado="salida";
            }
        }

        if($validandoLado==null){
            $respuestaServidor["status_code"]=400;
            $respuestaServidor["mensaje"]="por favor seleccione un lado de la puerta";
            return new JsonResponse($respuestaServidor);
        }


        if($puerta[0]->zona_id!=$zona->id){
            $respuestaServidor["status_code"]=400;
            $respuestaServidor["mensaje"]="la puerta no pertenece a esa zona";
            return new JsonResponse($respuestaServidor);
        }

        return view("scaner.index",[
            "id_zona" => $id_zona,
            "codigo_puerta" => $codigo_puerta,
            "lado" => $validandoLado,
            "puerta" => $puerta[0],
            "zona" => $zona,
        ]);
    }

    function validarAcceso(Request $request,string $id_zona ,string $codigo_puerta, string $lado){
        $respuestaServidor=[
            "status_code" => null,
            "data" => null,
            "mensaje" => null,
            "detalle" => [],
        ];

        $token=$request->token;
        $key=env("JWT_KEY");

        try {
            $acceso=false;
            $dataToken = JWT::decode($token, new Key($key, 'HS256'));
            $puerta=$this->PuertaRepository->consultarPorUnCampo("codigo","=",$codigo_puerta);

            $validaraToken=$this->QrUsuarioRepository->consultarPorUnCampo("token_qr","=",$token);
            $usuario=$this->UsuarioRepository->consultarPorId($dataToken->id_usuario);

            if(!$usuario){
                $respuestaServidor["status_code"]=400;
                $respuestaServidor["data"]=[
                    "acceso" => $acceso,
                ];
                $respuestaServidor["mensaje"]="se le a denegado el acceso por que no se a encontrado el usuario";
                return new JsonResponse($respuestaServidor);
            }

            if(count($validaraToken)==0){
                $data=[
                    "mensaje" => "el qr del usuario no a sido encontrado",
                    "id_zona" => $id_zona,
                    "lado" => $lado,
                    "qr" => $validaraToken[0],
                    "puerta" => $puerta[0],
                    "user_id" => $dataToken->id_usuario,
                ];

                EscanerQrEvent::dispatch($data);

                $respuestaServidor["status_code"]=400;
                $respuestaServidor["data"]=[
                    "acceso" => $acceso,
                ];
                $respuestaServidor["mensaje"]="el qr no asido encontrado";
                return new JsonResponse($respuestaServidor);
            }

            if($validaraToken[0]->status==0){

                $data=[
                    "mensaje" => "el qr del usuario no se le dio acceso por que esta de baja",
                    "id_zona" => $id_zona,
                    "lado" => $lado,
                    "qr" => $validaraToken[0],
                    "puerta" => $puerta[0],
                    "user_id" => $dataToken->id_usuario,
                ];

                EscanerQrEvent::dispatch($data);

                $respuestaServidor["status_code"]=400;
                $respuestaServidor["data"]=[
                    "acceso" => $acceso,
                ];
                $respuestaServidor["mensaje"]="el qr esta de baja";
                return new JsonResponse($respuestaServidor);
            }

            $accessoZona=$this->AccesoUsuarioRepository->consultarPorIdZonaYIdUser($id_zona,$dataToken->id_usuario);

            if(!$accessoZona){

                $data=[
                    "mensaje" => "el usuario no tiene acceso por que no la tiene asignada",
                    "id_zona" => $id_zona,
                    "lado" => $lado,
                    "qr" => $validaraToken[0],
                    "puerta" => $puerta[0],
                    "user_id" => $dataToken->id_usuario,
                ];

                EscanerQrEvent::dispatch($data);

                $respuestaServidor["status_code"]=400;
                $respuestaServidor["data"]=[
                    "acceso" => $acceso,
                ];
                $respuestaServidor["mensaje"]="el usuario no tiene acceso a la zona por que no la tiene asignada";
                return new JsonResponse($respuestaServidor);
            }


            for ($index=0; $index < count($dataToken->zonas); $index++) {
                $zonaDelQR=$dataToken->zonas[$index];
                if($zonaDelQR==$accessoZona->id){
                    $acceso=true;
                    break;
                }
            }

            if(!$acceso){

                $data=[
                    "mensaje" => "se le nego el acceso por que no tiene acceso a la zona",
                    "id_zona" => $id_zona,
                    "lado" => $lado,
                    "qr" => $validaraToken[0],
                    "puerta" => $puerta[0],
                    "user_id" => $dataToken->id_usuario,
                ];

                EscanerQrEvent::dispatch($data);

                $respuestaServidor["status_code"]=400;
                $respuestaServidor["data"]=[
                    "acceso" => $acceso,
                ];
                $respuestaServidor["mensaje"]="el usuario no tiene acceso a la zona";
                return new JsonResponse($respuestaServidor);
            }

            $zonaHoraria = new DateTimeZone('America/Caracas');
            $ahora=new DateTime("now",$zonaHoraria);
            $data=[];

            if($lado=="entrada"){


                if(
                    $this->compararHorasMenorIgual($ahora->format("H:i:s"),$accessoZona->zona->horario_de_cierre_de_la_zona) &&
                    $this->compararHorasMayorIgual($ahora->format("H:i:s"),$accessoZona->zona->horario_de_acceso_de_la_zona)
                ){
                    $data=[
                        "mensaje" => "Acceso consedido",
                        "id_zona" => $id_zona,
                        "lado" => $lado,
                        "qr" => $validaraToken[0],
                        "puerta" => $puerta[0],
                        "user_id" => $dataToken->id_usuario,
                    ];

                    EscanerQrEvent::dispatch($data);


                    $usuario->persona;

                    $respuestaServidor["status_code"]=200;
                    $respuestaServidor["data"]=[
                        "acceso" => $acceso,
                        "usuario" => $usuario,
                    ];

                    $respuestaServidor["mensaje"]="Acceso consedido";

                    return new JsonResponse($respuestaServidor);

                }
                else{
                    $acceso=false;
                    $data=[
                        "mensaje" => "Acceso denagado por no esta dentro del horario permitido",
                        "id_zona" => $id_zona,
                        "lado" => $lado,
                        "qr" => $validaraToken[0],
                        "puerta" => $puerta[0],
                        "user_id" => $dataToken->id_usuario,
                    ];

                    EscanerQrEvent::dispatch($data);


                    $usuario->persona;

                    $respuestaServidor["status_code"]=200;
                    $respuestaServidor["data"]=[
                        "acceso" => false,
                        "usuario" => $usuario,
                    ];

                    $respuestaServidor["mensaje"]="Acceso denagado por no esta dentro del horario permitido";

                    return new JsonResponse($respuestaServidor);

                }

            }
            else if($lado=="salida"){
                $data=[
                    "mensaje" => "Acceso consedido",
                    "id_zona" => $id_zona,
                    "lado" => $lado,
                    "qr" => $validaraToken[0],
                    "puerta" => $puerta[0],
                    "user_id" => $dataToken->id_usuario,
                ];

                EscanerQrEvent::dispatch($data);


                $usuario->persona;

                $respuestaServidor["status_code"]=200;
                $respuestaServidor["data"]=[
                    "acceso" => $acceso,
                    "usuario" => $usuario,
                ];

                $respuestaServidor["mensaje"]="Acceso permitido";

                return new JsonResponse($respuestaServidor);

            }

        } catch (\Throwable $th) {

            $respuestaServidor["status_code"]=500;
            $respuestaServidor["mensaje"]="Error al decifrar el token sssss";

            return new JsonResponse($respuestaServidor);
        }

    }

    function compararHorasMenorIgual($hora1, $hora2){

        $formato = 'H:i:s';

        $dateTime1 = DateTime::createFromFormat($formato, $hora1);
        $dateTime2 = DateTime::createFromFormat($formato, $hora2);

        return $dateTime1 <= $dateTime2;

    }

    function compararHorasMayorIgual($hora1, $hora2){

        $formato = 'H:i:s';

        $dateTime1 = DateTime::createFromFormat($formato, $hora1);
        $dateTime2 = DateTime::createFromFormat($formato, $hora2);

        return $dateTime1 >= $dateTime2;

    }


}
