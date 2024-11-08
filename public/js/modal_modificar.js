document.addEventListener('DOMContentLoaded', function () {
    const modal = document.querySelector('.modal');
    const modifyButtons = document.querySelectorAll('button.btn-action');

    modifyButtons.forEach(button => {
        if (button.textContent.trim() === 'Modificar') {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const id = row.cells[0].textContent.trim();
                const amount = row.cells[1].textContent.trim();
                openModal(id, amount);
                modal.style.display = 'block';
            });
        }
    });

    const closeButton = document.querySelector('.close-button');
    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });
});

// Define la función en el ámbito global
function closeModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
}

function openModal(id, amount) {
    const idField = document.getElementById('id_inversion');
    const amountField = document.getElementById('monto_viejo');

    console.log('ID:', id);  // Para verificar que estamos obteniendo el ID correcto
    console.log('Amount:', amount);  // Para verificar que estamos obteniendo el monto correcto

    idField.value = id;
    amountField.value = amount;

    // Asegúrate de que los campos están bloqueados
    idField.readOnly = true;
    amountField.readOnly = true;
}
