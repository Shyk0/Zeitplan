document.addEventListener('DOMContentLoaded', function() {
    let grupoCounter = 1;

        function agregarGrupo() {
            grupoCounter++;
            const nuevoGrupoId = 'grupo' + grupoCounter;

            // Agrega un nuevo grupo al select 'no-asisten'
            const selectNoAsisten = document.getElementById('no-asisten');
            const newOption = document.createElement('option');
            newOption.value = nuevoGrupoId;
            newOption.text = 'Grupo ' + grupoCounter;
            selectNoAsisten.appendChild(newOption);

            // Crea un nuevo div con select de materias para el nuevo grupo
            const nuevoGrupoDiv = document.createElement('div');
            nuevoGrupoDiv.innerHTML = `
                <label for="materias-${nuevoGrupoId}">Materias para Grupo ${grupoCounter}:</label>
                <select id="materias-${nuevoGrupoId}">
                  <option value="matematicas">Matemáticas</option>
                  <option value="ciencias">Ciencias</option>
                </select>
            `;
            document.getElementById('grupos-container').appendChild(nuevoGrupoDiv);
            console.log("FUNCIONA SI FUNCIONA");
    }

        //Llamamos al evento desde aqui sin tener un "onClick" desde el HTML
        document.getElementById('agregar-grupo').addEventListener('click', agregarGrupo);
    // Función para actualizar la vista previa
    function actualizarVistaPrevia() {

        
        
        const actividadEspecial = document.getElementById('actividad-especial').value;
        const novedades = document.getElementById('novedades').value;

        const previewContent = document.getElementById('preview-content');
        previewContent.innerHTML = '';

        if (noAsisten.length > 0) {
            const noAsistenDiv = document.createElement('div');
            noAsistenDiv.classList.add('preview-item');
            noAsistenDiv.innerHTML = `<strong>Grupos que no asisten:</strong> ${noAsisten.join(', ')}`;
            previewContent.appendChild(noAsistenDiv);
        }

        for (let i = 1; i <= grupoCounter; i++) {
            const grupoId = 'grupo' + i;
            if (!noAsisten.includes(`Grupo ${i}`)) {
                const materiaGrupo = document.getElementById(`materias-${grupoId}`).value;
                const materiaDiv = document.createElement('div');
                materiaDiv.classList.add('preview-item');
                materiaDiv.innerHTML = `<strong>Materias para Grupo ${i}:</strong> ${materiaGrupo}`;
                previewContent.appendChild(materiaDiv);
            }
        }

        if (actividadEspecial) {
            const actividadDiv = document.createElement('div');
            actividadDiv.classList.add('preview-item');
            actividadDiv.innerHTML = `<strong>Actividad Especial:</strong> ${actividadEspecial}`;
            previewContent.appendChild(actividadDiv);
        }

        if (novedades) {
            const novedadesDiv = document.createElement('div');
            novedadesDiv.classList.add('preview-item');
            novedadesDiv.innerHTML = `<strong>Novedades del Día:</strong> ${novedades}`;
            previewContent.appendChild(novedadesDiv);
        }

        document.getElementById('preview-container').style.display = 'block';
    }

    // Función para deshabilitar materias si el grupo no asiste
    function actualizarMaterias() {
        const noAsisten = Array.from(document.getElementById('no-asisten').selectedOptions).map(option => option.value);

        for (let i = 1; i <= grupoCounter; i++) {
            const grupoId = 'materias-grupo' + i;
            const grupoMaterias = document.getElementById(grupoId);

            if (grupoMaterias) {
                if (noAsisten.includes('grupo' + i)) {
                    grupoMaterias.disabled = true;
                } else {
                    grupoMaterias.disabled = false;
                }
            }
        }
    }

    // Inicializar Select2 para el campo de selección múltiple
    
    });
