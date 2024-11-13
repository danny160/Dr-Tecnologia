<?php
$estado = isset($_GET['estado']) ? $_GET['estado'] : null;
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador-Usuarios</title>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../estilos/styleUsuariosNuevos.css">
</head>

<body>

    <div class="container">

        <!-- Barra superior -->
        <div class="topbar">
            <div class="admin-info" style="display: flex; align-items: center; margin-right: 20px;">
                <!-- Icono de administrador (color blanco) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="white" class="bi bi-person"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span style="margin-left: 8px; color: white;">Administrador</span>
            </div>
        </div>

        <!-- Barra lateral -->
        <div class="sidebar">
            <div class="logo">
                <img src="../imagenes/logoSi.png" alt="Logo" width="100px">
            </div>
            <ul class="nav-links">
                <li>
                    <a href="../paginas/administrador.php">
                        <!-- SVG de la casa -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                        </svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="../paginas/usuarios.php">
                        <!-- SVG de la persona -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                        Usuarios
                    </a>
                </li>
                <li>
                    <a href="../paginas/categorias.php">
                        <!-- SVG de la cuadrícula -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
                            <path
                                d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1m9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1m0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0z" />
                        </svg>
                        Categorias
                    </a>
                </li>
                <li>
                    <a href="../paginas/ventas.php">
                        <!-- SVG del carrito -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .49.598l-1.5 6A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.49-.598L4.89 5H2.89l-.8 3.197A.5.5 0 0 1 1.5 9H.5a.5.5 0 0 1-.5-.5v-7z" />
                        </svg>
                        Ventas
                    </a>
                </li>
                <li>
                    <a href="../paginas/inventario.php">
                        <!-- SVG del lápiz -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                        Inventarios
                    </a>
                </li>
                <li>
                    <a href="#">
                        <!-- SVG del engranaje -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                            <path
                                d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z" />
                        </svg>
                        Configuración
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenedor principal -->
        <div class="content">
            <div class="container my-4">

                <!-- titulo que aparece de usuario -->
                <h3 class="text-center" id="titulo-usuario">Usuarios</h3>

                <!-- Boton de añadir usuario -->
                <div class="row mt-3 mb-3">
                    <div class="d-flex justify-content-end col">
                        <button class="btn btn-sm - btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">Añadir Usuarios</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <table class="table table-striped" id="dataTableUsuarios">
                            <thead>
                                <tr>
                                    <th class="centerend">IdUsuario</th>
                                    <th class="centerend">Cedula</th>
                                    <th class="centerend">Nombre</th>
                                    <th class="centerend">Apellido</th>
                                    <th class="centerend">RolUsuario</th>
                                    <th class="centerend">EstadoCuenta</th>
                                    <th class="centerend">Configuración</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal de registrar Usuario -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Añadir Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../controladores/controlerRegistrarUsuario.php">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="25"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" maxlength="25"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                                <select class="form-select" name="tipoDocumento" id="tipoDocumento" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <option value="Cc">Cédula de Ciudadanía (Cc)</option>
                                    <option value="Pasaporte">Pasaporte (PPT)</option>
                                    <option value="otro">otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Documento</label>
                                <input type="text" class="form-control" name="documento" id="documento" maxlength="11"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="number" class="form-control" name="edad" id="edad" min="18" max="100"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario"
                                    maxlength="11" required>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="contraseña" id="contraseña"
                                    maxlength="11" required>
                            </div>
                            <div class="mb-3">
                                <label for="correoElectronico" class="form-label">Correo Electronico</label>
                                <input type="gmail" class="form-control" name="correoElectronico" id="correoElectronico"
                                    min="8" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="rolUsuario" class="form-label">Rol de Usuario</label>
                                <select class="form-select" name="rolUsuario" id="rolUsuario" required>
                                    <option value="" disabled selected>Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="userInventory">User Inventory</option>
                                    <option value="userSales">User Sales</option>
                                    <option value="userInvite">User Invite</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fechaCreacion" class="form-label">Fecha de Creación de la Cuenta</label>
                                <input type="date" class="form-control" name="fechaCreacion" id="fechaCreacion"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="estadoCuenta" class="form-label">Estado de Cuenta</label>
                                <select class="form-select" name="estadoCuenta" id="estadoCuenta" required>
                                    <option value="0">Activo</option>
                                    <option value="1">Inactivo</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Div de mensajes de registro Usuario -->
        <div class="container mt-5">
            <?php if ($estado === 'exito' || $estado === 'error'): ?>
                <div class="modal fade show d-block" id="modalMensaje" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $estado === 'exito' ? 'Éxito' : 'Error'; ?></h5>
                            </div>
                            <div class="modal-body">
                                <p><?php echo $estado === 'exito' ? 'Usuario Agregado exitosamente.' : 'Hubo un error al registrar el usuario. Por favor, inténtelo de nuevo.'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modal para Editar Usuario -->
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarUsuarioLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarUsuario">
                            <input type="hidden" id="idUsuarioEditar" name="idUsuario">
                            <div class="mb-3">
                                <label for="nombreUsuarioEditar" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombreUsuarioEditar" name="nombreUsuarioEditar">
                            </div>
                            <div class="mb-3">
                                <label for="apellidoUsuarioEditar" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellidoUsuarioEditar" name="apellidoUsuarioEditar">
                            </div>
                            <div class="mb-3">
                                <label for="tipoDocumentoEditar" class="form-label">Tipo de Documento</label>
                                <select class="form-select" name="tipoDocumentoEditar" id="tipoDocumentoEditar" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <option value="Cc">Cédula de Ciudadanía (Cc)</option>
                                    <option value="Pasaporte">Pasaporte (PPT)</option>
                                    <option value="otro">otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="documentoUsuarioEditar" class="form-label">Documento</label>
                                <input type="text" class="form-control" id="documentoUsuarioEditar" name="documentoUsuarioEditar" >
                            </div>
                            <div class="mb-3">
                                <label for="edadEditar" class="form-label">Edad</label>
                                <input type="number" class="form-control" name="edadEditar" id="edadEditar" min="18" max="100"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimientoEditar" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fechaNacimientoEditar" id="fechaNacimientoEditar"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="nombreUsuarioInicioEditar" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" name="nombreUsuarioInicioEditar" id="nombreUsuarioInicioEditar"
                                    maxlength="11" required>
                            </div>
                            <div class="mb-3">
                                <label for="contraseñaEditar" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" name="contraseñaEditar" id="contraseñaEditar"
                                    maxlength="11" required>
                            </div>
                            <div class="mb-3">
                                <label for="correoElectronicoEditar" class="form-label">Correo Electronico</label>
                                <input type="gmail" class="form-control" name="correoElectronicoEditar" id="correoElectronicoEditar"
                                    min="8" max="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="rolUsuario" class="form-label">Rol de Usuario</label>
                                <select class="form-select" name="rolUsuarioEditar" id="rolUsuarioEditar" required>
                                    <option value="" disabled selected>Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="userInventory">User Inventory</option>
                                    <option value="userSales">User Sales</option>
                                    <option value="userInvite">User Invite</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fechaCreacionEditar" class="form-label">Fecha de Creación de la Cuenta</label>
                                <input type="date" class="form-control" name="fechaCreacionEditar" id="fechaCreacionEditar"
                                readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label for="estadoCuentaEditar" class="form-label">Estado de Cuenta</label>
                                <select class="form-select" id="estadoCuentaEditar" name="estadoCuentaEditar">
                                    <option value="0">Activo</option>
                                    <option value="1">Bloqueado</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="guardarEdicionUsuario()">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom JS -->
    <script src="../javaScrip/scripUsuario.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>

</html>