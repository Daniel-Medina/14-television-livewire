//Cambiar imagen
document.getElementById("file").addEventListener('change', cambiarImagen); //Cuando existe el evento change activa el evento de cambio
//Campo de imagen
const img = document.getElementById('picture');

function cambiarImagen(event) {
    //Obtener el evento
    var file = event.target.files[0];

    var reader = new FileReader();
    reader.onload = (event) => {
        img.setAttribute('src', event.target.result);
    };

    //Asignar la imagen
    reader.readAsDataURL(file);
}