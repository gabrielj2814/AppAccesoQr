
var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });


scanner.addListener('scan',function(content){
    // alert(content);
    validarAcceso(content);
});


Instascan.Camera.getCameras().then(function (cameras){
    if(cameras.length>0){
        // $('[name="options"]').on('change',function(){
        //     if($(this).val()==1){
        //         if(cameras[0]!=""){
        //            scanner.start(cameras[0]);
        //         }else{
        //            alert('No Front camera found!');
        //         }
        //     }else if($(this).val()==2){
        //         if(cameras[1]!=""){
        //            scanner.start(cameras[1]);
        //         }else{
        //            alert('No Back camera found!');
        //         }
        //     }
        // });

        if(cameras.indexOf("1")==0){
            // camara frontal
            scanner.start(cameras[1]);
        }
        else{
            // camara tracera
            scanner.start(cameras[1]);
        }
    }else{
        console.error('No cameras found.');
        alert('No cameras found.');
    }
}).catch(function(e){
    console.error(e);
    // alert(e);
});


function validarAcceso(token){
    // alert(token)
    const DATA={
        token:token
    }

    axios.post(`/api/v1/valiadar-acceso/${id_zona}/${codigo_puerta}/${lado}`,DATA)
    .then(respuesta => {
        console.log("respuesta servidor => ",respuesta)

        alert(JSON.stringify(respuesta.data))
        document.getElementById("dataJson").textContent=JSON.stringify(respuesta.data)

    })
    .catch(error => {
        console.error("error servidor => ",error)
        alert(JSON.stringify(error))
    })
}
