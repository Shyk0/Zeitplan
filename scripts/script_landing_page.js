function login() {
    const institutionInput = document.getElementById('institution');
    const passwordInput = document.getElementById('password');
    const institutionName = institutionInput.value.toUpperCase();
    const password = passwordInput.value;

    if (institutionName === 'EL TRIUNFO SANTA TERESA') {
        alert(`Bienvenido ${institutionName}!`);
        window.location.href = "Home_page.html"; // Redirigir a la página deseada
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

console.log("HOLAAAAAAa")