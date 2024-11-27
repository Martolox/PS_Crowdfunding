function openProjectModal(projectId = null) {
    var modal = document.getElementById('projectModal');
    var form = document.getElementById('formModalProject'); // modal.querySelector('form');
    var titleElement = document.getElementById('modalTitle');

    // Reset the form
    form.reset();

    if (projectId) {
        // If projectId is provided, we're editing an existing project
        titleElement.textContent = 'Editar Proyecto';
        document.getElementById('project_id').value = projectId;
        // Here you would typically fetch the project data and populate the form
        // This is a placeholder for that functionality
        // fetchProjectData(projectId).then(populateForm);
    } else {
        // If no projectId, we're creating a new project
        titleElement.textContent = 'Crear Proyecto';
        document.getElementById('project_id').value = '';
        const projectImage = document.getElementById('projectImage');
        projectImage.src = '';
        projectImage.hidden = true;
    }

    // Show the modal
    modal.style.display = 'block';
}

function closeProjectModal() {
    document.getElementById('formModalProject').reset;
    const projectImage = document.getElementById('projectImage');
        projectImage.src = '';
        projectImage.hidden = true;
    var modal = document.getElementById('projectModal');
    modal.style.display = 'none';
}

//funciones para modal de confirmacion de cancelacion
function showCancelModal(id, name, url) {
    // Mostrar el modal
    document.getElementById('cancelModal').style.display = 'block';
    // Cambiar el texto del modal
    document.getElementById('modal-text').textContent = `¿Estás seguro de que deseas cancelar el proyecto "${name}"?`;
   
    // Asignar la URL al botón de confirmación
    //document.getElementById('confirmButton').href = url;
    // Guardar el ID del proyecto en un campo oculto
    document.getElementById('cancelProjectId').value = id;
}

function closeModal() {
    // Ocultar el modal
    document.getElementById('cancelModal').style.display = 'none';
}

function confirmCancel() {
    // Enviar el formulario para cancelar el proyecto
    document.getElementById('cancelForm').submit();
}

// Add event listeners when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add click event to close button
    var closeButton = document.querySelector('.close');
    if (closeButton) {
        closeButton.addEventListener('click', closeProjectModal);
    }
});

// Placeholder function for fetching project data
function fetchProjectData(projectId) {
    // This function should make an AJAX request to get the project data
    // For now, it just returns a promise that resolves immediately
    return new Promise((resolve) => {
        resolve({
            // Placeholder data
            name: 'Proyecto Ejemplo',
            category: 'TECNOLOGIA',
            impact: 'ALTO',
            budget: 10000,
            status: 'EN PROCESO',
            end_date: '2023-12-31',
            reward_plan: 'Plan de recompensas ejemplo'
        });
    });
}

// Function to populate the form with project data
function populateForm(data) {
    document.getElementById('name').value = data.name;
    document.getElementById('category').value = data.category;
    document.getElementById('impact').value = data.impact;
    document.getElementById('budget').value = data.budget;
    document.getElementById('status').value = data.status;
    document.getElementById('end_date').value = data.end_date;
    document.getElementById('reward_plan').value = data.reward_plan;
}


function showCancelModal(id, name, url) {
    // Mostrar el modal
    document.getElementById('cancelModal').style.display = 'block';
    // Cambiar el texto del modal
    document.getElementById('modal-text').textContent = `¿Estás seguro de que deseas cancelar el proyecto "${name}"?`;
  
   // Asignar la acción del formulario con la URL correcta
   document.getElementById('cancelForm').action = url;
    // Guardar el ID del proyecto en un campo oculto
    
    document.getElementById('cancelProjectId').value = id;
}

function closeModal() {
    // Ocultar el modal
    document.getElementById('cancelModal').style.display = 'none';
}

function confirmCancel() {
    // Enviar el formulario para cancelar el proyecto
    document.getElementById('cancelForm').submit();
}


function editProject(projectId) {
    // Realizar una petición AJAX para obtener los datos del proyecto
    fetch(`<?= base_url('projectsController/getProject/') ?>${projectId}`)
        .then(response => response.json())
        .then(data => {
            // Cargar los datos al formulario del modal
           // Mostrar el modal
           openProjectModal();
            document.getElementById('modalTitle').innerText = 'Editar Proyecto';
            document.getElementById('project_id').value = data.id_projects;
            document.getElementById('name').value = data.name;
            document.getElementById('category').value = data.category;
            document.getElementById('impact').value = data.impact;
            document.getElementById('budget').value = data.budget;
            document.getElementById('status').value = data.status;
            document.getElementById('end_date').value = data.end_date;
            document.getElementById('reward_plan').value = data.reward_plan;
            // Configurar la imagen del proyecto
            const projectImageElement = document.getElementById('projectImage');
            if (data.img_name && data.img_name.trim() !== '') {
                projectImageElement.src = `<?= base_url('/') ?>${data.img_name}`;
                projectImageElement.hidden = false; // Mostrar la imagen
            } else {
                projectImageElement.hidden = true; // Ocultar si no hay imagen
            }
            
        })
        .catch(error => console.error('Error al cargar los datos del proyecto:', error));
}
