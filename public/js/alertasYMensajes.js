document.addEventListener('DOMContentLoaded', (event) => {
    const message = document.querySelector('#alertMessage').value;
    const error = document.querySelector('#alertError').value;

    if (message) {
        alert(message);
    }

    if (error) {
        alert(error);
    }
});

