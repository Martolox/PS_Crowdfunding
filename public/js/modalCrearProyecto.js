function openProjectModal(projectId = null) {
    var modal = document.getElementById('projectModal');
    var form = modal.querySelector('form');
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
    }

    // Show the modal
    modal.style.display = 'block';
}

function closeProjectModal() {
    var modal = document.getElementById('projectModal');
    modal.style.display = 'none';
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