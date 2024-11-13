// Verifica si hay un mensaje de error y lo oculta después de 5 segundos
window.onload = function() {
    const errorMessage = document.getElementById('error-message');
    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 5000); // 5000 ms = 5 segundos
    }
};