// Funciones para abrir y cerrar el modal
function openSettingsModal() {
    document.getElementById("settingsModal").style.display = "flex"; // Muestra el modal
}

function closeSettingsModal() {
    document.getElementById("settingsModal").style.display = "none"; // Oculta el modal
}

// Muestra la sección correspondiente dentro del modal
function showSection(sectionId) {
    var sections = document.querySelectorAll('.settings-content');
    sections.forEach(function(section) {
        section.style.display = 'none'; // Oculta todas las secciones
    });
    document.getElementById(sectionId).style.display = 'block'; // Muestra la sección seleccionada
}

// Cierra el modal al hacer clic en el botón de cerrar
document.getElementById('closeSettings').onclick = closeSettingsModal;

// Función de cierre de sesión
function logout() {
    window.location.href = "Landing_page.html"; // Redirige al inicio de sesión
}

//Funcion para mostrar fecha
function updateDateTime() {
    var now = new Date();

    // Extraer día, mes y año
    var day = String(now.getDate()).padStart(2, '0');
    var month = String(now.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
    var year = now.getFullYear();

    // Formatear la fecha en "DD/MM/YYYY"
    var dateString = day + "/" + month + "/" + year;

    // Insertar la fecha en el elemento con id "date-time"
    document.getElementById("date-time").innerText = dateString;
}

// Llama a la función cuando la página esté completamente cargada
window.onload = updateDateTime;



