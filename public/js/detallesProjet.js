document.addEventListener('DOMContentLoaded', function() {
    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    
    // Función para decodificar los parámetros de la URL
    const decodeParam = (param) => decodeURIComponent(param || '');

    // Obtener los datos del proyecto de los parámetros de la URL
    const projectData = {
        id: decodeParam(urlParams.get('id')),
        name: decodeParam(urlParams.get('name')),
        category: decodeParam(urlParams.get('category')),
        impact: decodeParam(urlParams.get('impact')),
        budget: decodeParam(urlParams.get('budget')),
        status: decodeParam(urlParams.get('status')),
        endDate: decodeParam(urlParams.get('endDate')),
        rewardPlan: decodeParam(urlParams.get('rewardPlan')),
        imgName: decodeParam(urlParams.get('imgName'))
    };

    // Mostrar los detalles del proyecto
    showProjectDetails(projectData);
});

function showProjectDetails(project) {
    document.getElementById('projectName').textContent = project.name;
    document.getElementById('projectCategory').textContent = project.category;
    document.getElementById('projectImpact').textContent = project.impact;
    document.getElementById('projectBudget').textContent = new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(project.budget);
    document.getElementById('projectStatus').textContent = project.status;
    document.getElementById('projectEndDate').textContent = new Date(project.endDate).toLocaleDateString('es-ES');
    document.getElementById('projectRewardPlan').textContent = project.rewardPlan;
    document.getElementById('projectImage').src = `/ruta/a/las/imagenes/${project.imgName}`;
    document.getElementById('projectImage').alt = `Imagen de ${project.name}`;
}