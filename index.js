function login() {
    const institutionInput = document.getElementById('institution');
    const passwordInput = document.getElementById('password');
    const institutionName = institutionInput.value.toUpperCase();
    const password = passwordInput.value;

    if (institutionName === 'EL TRIUNFO SANTA TERESA') {
        alert(`Bienvenido ${institutionName}!`);
        window.location.href = "/components/Home_page.html"; // Redirigir a la página deseada
    } else {
        alert('Nombre de la institución incorrecto. Intenta nuevamente.');
    }
}

function forgotPassword() {
    const institution = prompt("Ingresa el nombre de la institución para recuperar tu contraseña:");
    if (institution && institution.toUpperCase() === 'EL TRIUNFO SANTA TERESA') {
        alert('Un enlace para restablecer la contraseña ha sido enviado a tu correo.');
    } else {
        alert('No se pudo encontrar la institución. Verifica los datos e intenta nuevamente.');
    }
}


let currentImageIndex = 0;
const images = document.querySelectorAll('.carousel-image');
const totalImages = images.length;

// Establece el tiempo que se mostrará cada imagen (2 segundos)
const displayTime = 5000; 

function showNextImage() {
    // Oculta la imagen actual
    images[currentImageIndex].classList.remove('active');

    // Incrementa el índice de la imagen actual
    currentImageIndex = (currentImageIndex + 1) % totalImages; // Bucle infinito

    // Muestra la siguiente imagen
    images[currentImageIndex].classList.add('active');
}

// Inicializa el carrusel mostrando la primera imagen
images[currentImageIndex].classList.add('active');

// Inicia el carrusel y cambia de imagen cada 2 segundos
setInterval(showNextImage, displayTime);

