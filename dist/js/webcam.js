var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var snap = document.getElementById("boton");
var estado = document.getElementById('estado');
var documento = document.getElementById('Documento');

const constraints = {
    audio: false,
    video: {
        width: 330, height: 270
    }
};

// Access webcam
async function init() {
    try {
		window.URL = window.URL || window.webkitURL;
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || function(){alert('Su navegador no soporta navigator.getUserMedia().');};
 
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
    } catch (e) {
        console.log("La camara esta desconectada " + e)
         showAlert("No hay camaras conectadas", "warn");
    }
}

// Success
function handleSuccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');
snap.addEventListener("click", function () {
    context.drawImage(video, 0, 0, 270, 270);
    var foto = canvas.toDataURL(); //Esta es la foto, en base 64
    estado.innerHTML = "Enviando foto. Por favor, espera...";
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "Model/Admin/guardar_foto.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(encodeURIComponent(foto) + "&user=" + documento.value); //Codificar y enviar

    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            console.log("La foto fue enviada correctamente");
            console.log(xhr);
            estado.innerHTML = "Foto generada correctamente";
            canvas.style.display = "block";
        }
    }
});


function showAlert(text, style) {
    $.notify(text, style);
}