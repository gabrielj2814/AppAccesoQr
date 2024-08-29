<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scanner</title>
    <style>
        #preview{
           width:500px;
           height: 500px;
           margin:0px auto;
        }
        </style>
</head>
<body>
    <h1>Zona: {{$zona->nombre}}</h1>
    <h3>Puerta: {{$puerta->nombre}}</h3>
    <h3>Lado: {{$lado}}</h3>
    <h1>Vista Scanner</h1>

    <div class="px-2">
        <div class=" pt-2">
            <div class="max-w-screen-1xl mx-auto sm:px-6 lg:px-8 flex flex-row justify-center items-center" style="height: calc(100vh - 115px);">
                <div class="contendor-scanner">
                    <video class=" w-full h-full" id="preview"></video>
                </div>
            </div>
        </div>
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
