<?php

namespace App\Http\Controllers;

use App\Repository\PuertaRepository;
use App\Repository\ZonaRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    //

    function __construct(

       public ZonaRepository $ZonaRepository,
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

        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        $respuestaServidor["status_code"]=200;
        $respuestaServidor["data"]=$decoded;
        $respuestaServidor["mensaje"]="ok";

        return new JsonResponse($respuestaServidor);

    }


}
