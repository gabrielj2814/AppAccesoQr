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

    <script type="text/javascript" src="{{ secure_asset('js/library/instascan.min.js') }}"></script>

    {{-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
<script type="text/javascript">
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
    scanner.addListener('scan',function(content){
        alert(content);
    });
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            if(cameras.indexOf("1")==0){
                scanner.start(cameras[1]);
            }
            else{
                scanner.start(cameras[0]);
            }

            // $('[name="options"]').on('change',function(){
            //     if($(this).val()==1){
            //         if(cameras[0]!=""){
            //             scanner.start(cameras[0]);
            //         }else{
            //             alert('No Front camera found!');
            //         }
            //     }else if($(this).val()==2){
            //         if(cameras[1]!=""){
            //             scanner.start(cameras[1]);
            //         }else{
            //             alert('No Back camera found!');
            //         }
            //     }
            // });
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function(e){
        // console.error(e);
        // alert(e);
    });
</script>



</body>
</html>
