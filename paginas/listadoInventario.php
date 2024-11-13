<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado-inventario</title>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../estilos/styleListadoinventario.css">
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
            <div class="container">

                <!-- container de los botones y barra de busqueda -->
                <div class="container-opciones row justify-content-center align-items-center g-2">
                    <div class="col-auto">
                        <button class="btn btn-custom me-4" id="btn-agregar" data-bs-toggle="modal"
                            data-bs-target="#addProducto">Agregar Producto</button>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-custom me-4" id="btnModificar" data-bs-toggle="modal" data-bs-target="#modalBuscarProducto">Modificar Producto</button>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-custom me-4" id="btnEliminarProducto" data-bs-toggle="modal" data-bs-target="#modalBuscarProducto">Eliminar Producto</button>
                    </div>

                    <!-- Campo de búsqueda personalizado -->
                    <div class="col-auto">
                        <div class="input-container">
                            <input type="text" name="productoBuscar" id="productoBuscar" class="form-control"
                                placeholder="Buscar producto">
                            <i class="bi bi-search"></i> <!-- Ícono de búsqueda -->
                        </div>
                    </div>
                </div>

                <!-- Contenido tabla productos -->
                <div class="container-tabla">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <table class="table table-striped" id="dataTableProductos">
                                <thead>
                                    <tr>
                                        <th class="centerend">ID</th>
                                        <th class="centerend">Nombre</th>
                                        <th class="centerend">Descripcion</th>
                                        <th class="centerend">Cantidad</th>
                                        <th class="centerend">Precio</th>
                                        <th class="centerend">Categoria</th>
                                        <th class="centerend">Fecha Ingreso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Las filas de productos se cargarán aquí automáticamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal de Mensaje -->
            <div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mensajeModalLabel">Resultado de la operación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="mensajeModalBody">
                            <!-- Aquí se insertará el mensaje -->
                        </div>
                        <div class="modal-footer" id="mensajeModalFooter">
                            <!-- Los botones de acción se insertarán dinámicamente -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar un producto -->
            <div class="modal fade" id="addProducto" tabindex="-1" aria-labelledby="addProducto" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductolabel1">Añadir Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form method="POST" action="../controladores/controlerRegistrarProducto.php"
                                enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripcion</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        maxlength="50" required>
                                </div>

                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" name="precio" id="precio" maxlength="50"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" name="cantidad" id="cantidad"
                                        maxlength="1000" min="1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="fechaIngreso" class="form-label">Fecha Ingreso</label>
                                    <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="imgProducto" class="form-label">Imagen Producto</label>
                                    <input type="file" class="form-control" name="imgProducto" id="imgProducto"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoría</label>
                                    <select class="form-control" name="categoria" id="categoria" required>
                                        <option value="">Seleccione una categoría</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal de busqueda -->
            <div class="modal fade" id="modalBuscarProducto" tabindex="-1" aria-labelledby="modalBuscarProductoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalBuscarProductoLabel">Buscar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formBuscarProducto">
                                <div class="mb-3">
                                    <label for="productoBuscarIdNombre" class="form-label">ID o Nombre del Producto</label>
                                    <input type="text" class="form-control" id="productoBuscarIdNombre" required>
                                </div>
                                <button type="button" class="btn btn-primary" id="btnBuscarProducto">Buscar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Edición del Producto -->
            <div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarProductoLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditarProducto">
                                <input type="hidden" id="idProductoEditar" name="idProductoEditar" value="">

                                <div class="mb-3">
                                    <label for="nombreProductoEditar" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombreProductoEditar" name="nombreProductoEditar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcionProductoEditar" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcionProductoEditar" name="descripcionProductoEditar" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="precioProductoEditar" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="precioProductoEditar" name="precioProductoEditar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="cantidadRegistrarEditar" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidadRegistrarEditar" name="cantidadRegistrarEditar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fechaIngresoEditar" class="form-label">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="fechaIngresoEditar" name="fechaIngresoEditar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoriaEditar" class="form-label">Categoría</label>
                                    <select id="categoriaEditar" name="categoriaEditar" class="form-control" required></select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Imagen del Producto</label>
                                    <div id="imagenProductoActual"></div> <!-- Div para mostrar la imagen actual -->
                                    <br>
                                    <input type="file" class="form-control" id="imagenProductoEditar" name="imagenProductoEditar">
                                </div>
                                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            </form>
                        </div>
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
        <script src="../javaScrip/scripListadoInventario.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

</body>

</html>