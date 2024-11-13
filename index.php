<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="stylesheet" href="estilos/styleInicio.css">    
    <!-- conexiones con bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

     <!-- Contenedor del video -->
     <div id="intro-video-container">
        <video id="intro-video" autoplay muted>
            <source src="video/videoIntro.mp4" type="video/mp4">
            
        </video>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <script>
        // Redireccionar a login.php después de 6 segundos
        // setTimeout(function () {
        //     window.location.href = "paginas/login.php";
        // }, 4000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const video = document.getElementById("intro-video");

            // Evento que detecta cuando el video ha terminado
            video.onended = function() {
                // Redirigir a la página principal
                window.location.href = "paginas/login.php"; // Cambia esto a la ruta de tu página principal
            };
        });
    </script>

</body>
</html>