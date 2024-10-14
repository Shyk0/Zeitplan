let editingRow = null; // Guardará la fila en edición

// Mostrar modal y limpiar los campos o cargar datos existentes
function showModal(editing = false, row = null) {
    const modal = document.getElementById('subjectModal');
    const modalTitle = document.getElementById('modalTitle');
    const saveButton = document.getElementById('saveSubjectButton');
    
    // Si es edición, cargamos los datos de la fila
    if (editing && row) {
        modalTitle.textContent = 'Editar Asignatura';
        document.getElementById('subjectName').value = row.cells[0].textContent;
        document.getElementById('subjectGrade').value = row.cells[1].textContent;
        document.getElementById('subjectLocation').value = row.cells[2].textContent;
        document.getElementById('subjectTeacher').value = row.cells[3].textContent;
        document.getElementById('subjectCedula').value = row.cells[4].textContent;
        editingRow = row; // Guardamos la fila en edición
    } else {
        // Si es nuevo, limpiamos los campos
        modalTitle.textContent = 'Agregar Asignatura';
        document.getElementById('subjectName').value = '';
        document.getElementById('subjectGrade').value = '';
        document.getElementById('subjectLocation').value = '';
        document.getElementById('subjectTeacher').value = '';
        document.getElementById('subjectCedula').value = '';
        editingRow = null; // No estamos editando ninguna fila
    }

    modal.style.display = 'block';

    saveButton.onclick = function () {
        saveSubject();
    };
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('subjectModal').style.display = 'none';
}

// Función para guardar o actualizar la asignatura
function saveSubject() {
    const nombre = document.getElementById('subjectName').value;
    const grado = document.getElementById('subjectGrade').value;
    const aula = document.getElementById('subjectLocation').value;
    const docente = document.getElementById('subjectTeacher').value;
    const cedula = document.getElementById('subjectCedula').value;

    if (nombre && grado && aula && docente && cedula) {
        if (editingRow) {
            // Si estamos editando una fila, actualizamos la fila existente
            editingRow.cells[0].textContent = nombre;
            editingRow.cells[1].textContent = grado;
            editingRow.cells[2].textContent = aula;
            editingRow.cells[3].textContent = docente;
            editingRow.cells[4].textContent = cedula;
        } else {
            // Si es nuevo, agregamos una nueva fila
            const tableBody = document.getElementById('subjectTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${nombre}</td>
                <td>${grado}</td>
                <td>${aula}</td>
                <td>${docente}</td>
                <td class="cedula-column">${cedula}</td>
                <td>
                    <i class="bi bi-pencil-square" onclick="editSubject(this)"></i>
                    <i class="bi bi-trash" onclick="deleteSubject(this)"></i>
                </td>
            `;
            tableBody.appendChild(newRow);
        }

        closeModal(); // Cerrar el modal después de guardar
    } else {
        alert('Todos los campos son obligatorios.');
    }
}

// Función para editar una asignatura
function editSubject(button) {
    const row = button.parentElement.parentElement;
    showModal(true, row); // Llamamos al modal en modo edición
}

// Función para crear una nueva asignatura
document.getElementById('createButton').addEventListener('click', function() {
    showModal(); // Llamamos al modal en modo agregar
});

// Función para eliminar una asignatura
function deleteSubject(button) {
    if (confirm('¿Estás seguro de que deseas eliminar esta asignatura?')) {
        const row = button.parentElement.parentElement;
        row.remove();
        updateRowCount();
    }
}

// Contador de filas actualizadas
function updateRowCount() {
    const rowCount = document.querySelectorAll('#subjectTableBody tr').length;
    document.getElementById('rowCount').textContent = rowCount;
}

// Llamada para actualizar el contador cada vez que se modifique la tabla
const observer = new MutationObserver(updateRowCount);
observer.observe(document.getElementById('subjectTableBody'), { childList: true });
updateRowCount(); // Llamar inicialmente para configurar el valor

// Función para filtrar la tabla según la búsqueda
document.getElementById('searchInput').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#subjectTableBody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let matchFound = false;

        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchValue)) {
                matchFound = true;
            }
        });

        // Mostrar u ocultar la fila dependiendo si se encuentra la coincidencia
        row.style.display = matchFound ? '' : 'none';
    });
});

// Mostrar el botón al hacer scroll hacia abajo
window.onscroll = function() {
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        scrollToTopBtn.style.display = 'block'; // Mostrar el botón
    } else {
        scrollToTopBtn.style.display = 'none'; // Ocultar el botón
    }
};

// Función para volver al inicio
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Scroll suave hacia arriba
}

function goToHome() {
    window.location.href = 'CodeHTML.html'; // Redirige a la página de inicio
}
