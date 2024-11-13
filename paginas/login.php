<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dr Tecnologia</title>

    <!-- conexiones con bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../estilos/styleLogin.css">
   

</head>

<body>

    <div class="login-form">

            <svg xmlns="http://www.w3.org/2000/svg" width="80px" style="margin-bottom: 30px;" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg>

            <?php
                // Verifica si hay algun error de
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo '<div id="error-message" class="alert alert-danger" role="alert" style="text-align: center; border-radius: 55px; padding: 3px;">
                            Cuenta Bloqueada
                        </div>';
                }

                // Verifica si hay un error en la URL
                if (isset($_GET['error']) && $_GET['error'] == 2) {
                    echo '<div id="error-message" class="alert alert-danger" role="alert" style="text-align: center; border-radius: 55px; padding: 3px;">
                            Usuario o contraseña Invalidos
                        </div>';
                }

            ?>

            <form action="../controladores/controlerLogin.php" method="POST">
                
                <!-- Div para el username -->
                <div class="form-group input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    <input type="text" name="username" required class="form-control" placeholder="Username" style="border: none; border-radius: 10px">
                </div>

                <!-- div para el password -->
                <div class="form-group input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2" />
                    </svg>
                    <input type="password" name="password" required class="form-control" placeholder="Password" style="border: none; border-radius: 10px">
                </div>
                
                <button class="btn btn-primary">Login</button>
            </form>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="../javaScrip/scripLogin.js"></script>

</body>

</html>