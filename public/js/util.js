const switcher = document.querySelector('#theme-switcher')
const doc = document.firstElementChild

switcher.addEventListener('input', e =>
    setTheme(e.target.value))

const setTheme = theme =>
    doc.setAttribute('color-scheme', theme)


// Función para cerrar el modal
function closeModalNotifications() {
    document.getElementById('notificationModal').style.display = 'none';
}