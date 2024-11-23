function mostrarModalYRedirigir(mensaje, redireccion, tiempo = 4000) {
    // Crear el modal dinámicamente
    const modal = document.createElement('div');
    modal.id = 'modal-bloqueo';
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    `;

    const modalContent = document.createElement('div');
    modalContent.style.cssText = `
        background: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    `;

    const mensajeTexto = document.createElement('p');
    mensajeTexto.innerText = mensaje;

    modalContent.appendChild(mensajeTexto);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);

    // Redirigir después del tiempo especificado
    setTimeout(() => {
        window.location.href = redireccion;
    }, tiempo);
}

function comprobarEstadoUsuario() {
    fetch('../controladores/verificacionEstado.php')
        .then(response => response.json())
        .then(data => {
            if (data.estado === "bloqueado") {
                mostrarModalYRedirigir(
                    "Tu cuenta ha sido bloqueada. Serás redirigido al inicio de sesión.",
                    'login.php?error=1'
                );
            } else if (data.estado === "no_autenticado") {
                window.location.href = 'login.php'; // Redirige si no está autenticado
            }
        })
        .catch(error => {
            console.error('Error al verificar el estado:', error);
        });
}

// Llamar periódicamente a la función
setInterval(comprobarEstadoUsuario, 1000);
