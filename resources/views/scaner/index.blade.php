<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scanner</title>
    <style>
        *{
            box-sizing: border-box;
        }
        html,body{
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .contendor{
            width:100vw;
            height: 100vh;
            margin:0px 0px;
            overflow: hidden;
            position: relative;
            /* border: 5px solid red; */
        }
        #preview{
           width:100vw;
           height: 100vh;
           margin:0px 0px;
           transform: scale(1.3);

        }

        .contendor-isla{
            width:100vw;
            height: 100vh;
            margin:0px 0px;
            display: flex;
            position: absolute;
            top: 0;
            z-index: 500;
            display: flex;
            flex-direction: row;
            justify-content: center;
            padding-top: 10px;
        }

        .isla-notificaciones{
            width: 90vw;
            min-height: 40px;
            background: rgb(40 40 40);
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #fff;

        }

        .nombre-zona-scanner{
            font-size: 1.5rem;
            color: #fff;
            text-align: center;
        }

        .puerta-zona-scanner, .nombre-usuario, .email-usuario, .mensaje-error{
            font-size: 1.2rem;
            color: #fff;
            text-align: center;
        }

        .nombre-usuario, .email-usuario, .mensaje-error{
            margin-bottom: 5px;
        }

        .datos-usuario{

        }

        .scanner-ok{

        }

        .foto-usuario{
            width: 250px;
            height: 250px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 30px
        }

        .foto-usuario .img-foto{
            width: 100%;
            height: 100%;
        }

        .scanner-error{

        }

        .separador{
            width: 100%;
            border: 1px solid #fff;
        }

        .contenedor-loader{
            width:100%;
            height: 100%;
            background-color: #111111a9;
            position: absolute;
            top: 0;
            z-index: 600;
            display: none;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            pointer-events: none;
        }

        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: #FF3D00;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        </style>
</head>
<body>

    {{--
    <h1>Zona: {{$zona->nombre}}</h1>
    <h3>Puerta: {{$puerta->nombre}}</h3>
    <h3>Lado: {{$lado}}</h3>
    <h1>Vista Scanner</h1>
    --}}

    <div class="contendor">
        <div class="contendor-isla">
            <div class="contenedor-loader" id="contenedorLoader">
                <div class="loader"></div>
            </div>
            <div >
                <div class="isla-notificaciones" id="islaNotificaciones">
                    <h1 class="nombre-zona-scanner">{{$zona->nombre}}</h1>
                    <h2 class="puerta-zona-scanner">{{$puerta->nombre}}</h2>
                    <section class="datos-usuario" id="datos-usuario">

                        {{-- OK --}}
                        <div id="scanner-ok" style="display: none">
                            <div class="separador" style="margin-bottom: 30px;"></div>
                            {{-- nombre de la persona que quiere acceder --}}
                            <div class="foto-usuario">
                                <img class="img-foto" src="https://th.bing.com/th/id/OIP.1axdQVWc76O41FS8VLSsfQHaGr?rs=1&pid=ImgDetMain" alt="foto usuario">
                            </div>
                            <div class="nombre-usuario" id="nombre">Erispheria</div>
                            <div class="email-usuario" id="email">erispheria@gmail.com</div>
                        </div>

                        {{-- ERROR --}}
                        <div id="scanner-error" style="display:none">
                            <div class="separador" style="margin-bottom: 30px;"></div>
                            <p class="mensaje-error" id="mensajeError">hola error</p>
                        </div>

                    </section>
                </div>
            </div>
        </div>
        <video class="" id="preview"></video>
    </div>


    <div id="dataJson"></div>

    <script type="text/javascript">
        let id_zona='{{$zona->id}}'
        let codigo_puerta='{{$puerta->codigo}}'
        let lado='{{$lado}}'
    </script>
    <script type="text/javascript" src="{{ secure_asset('js/library/axios.min.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('js/library/instascan.min.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('js/scanner.js?v='.microtime()) }}"></script>



</body>
</html>
