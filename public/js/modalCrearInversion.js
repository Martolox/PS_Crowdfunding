// Bandera de control para el estado del modal
let modalOpen = false;

function openInvestmentModal(userId, projectId) {
    document.getElementById('id_username').value = userId;
    document.getElementById('id_project').value = projectId;

    // Cambia la bandera a true cuando se abre el modal
    modalOpen = true;

    // Muestra el modal
    document.getElementById('modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';

    // Cambia la bandera a false cuando se cierra el modal
    modalOpen = false;
}

window.onclick = function(event) {
    const modal = document.getElementById('modal');
    if (event.target == modal && modalOpen) {
        modal.style.display = 'none';
        modalOpen = false; // Cambia la bandera a false cuando se cierra el modal
    }
}