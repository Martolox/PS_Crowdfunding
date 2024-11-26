document.addEventListener('DOMContentLoaded', (event) => {
	const messageInput = document.getElementById('alertMessage');
	const errorInput = document.getElementById('alertError');
	const message = messageInput ? messageInput.value : '';
	const error = errorInput ? errorInput.value : '';

	if (message) {
		alert(message);
	}

//	if (error2) {
//		alert(error);
//	}
});
