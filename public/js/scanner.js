
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
    document.getElementById("contenedorLoader").style.display="flex";
    const DATA={
        token:token
    }

    axios.post(`/api/v1/valiadar-acceso/${id_zona}/${codigo_puerta}/${lado}`,DATA)
    .then(respuesta => {
        document.getElementById("contenedorLoader").style.display="none";
        document.getElementById("mensajeError").textContent="";
        console.log("respuesta servidor => ",respuesta)
        let {data,mensaje} = respuesta.data
        if(data.acceso==true){
            document.getElementById("islaNotificaciones").style.border="1px solid green"
            document.getElementById("scanner-ok").style.display="block"
            document.getElementById("scanner-error").style.display="none"
            document.getElementById("nombre").textContent=`${data.usuario.persona.nombre} ${data.usuario.persona.apellido}`
            document.getElementById("email").textContent=`${data.usuario.email}`
        }
        else{
            document.getElementById("islaNotificaciones").style.border="1px solid red"
            document.getElementById("scanner-ok").style.display="none"
            document.getElementById("scanner-error").style.display="block"
            document.getElementById("mensajeError").textContent=`Error: ${mensaje}`
        }
        setTimeout(()=>{
            document.getElementById("scanner-ok").style.display="none"
            document.getElementById("scanner-error").style.display="none"
            document.getElementById("islaNotificaciones").style.border="1px solid #fff"
        },10000)

    })
    .catch(error => {
        document.getElementById("contenedorLoader").style.display="none";
        console.error("error servidor => ",error)
        alert("error")
        alert(JSON.stringify(error))
        document.getElementById("scanner-ok").style.display="none"
        document.getElementById("scanner-error").style.display="block"
        document.getElementById("mensajeError").textContent="Error con el servidor";
        document.getElementById("islaNotificaciones").style.border="1px solid red"
        setTimeout(()=>{
            document.getElementById("scanner-ok").style.display="none"
            document.getElementById("scanner-error").style.display="none"
            document.getElementById("islaNotificaciones").style.border="1px solid #fff"
        },10000)
    })
}
