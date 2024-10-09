<?php 
session_start(); 

// Habilitar la visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lubricantes Chapin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;400;600;700&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    $Username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
    ?>

    <!-- Estilos adicionales -->
    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        header h1 {
            font-weight: 700;
            letter-spacing: 2px;
        }

        .navbar {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.8rem;
        }

        .carousel {
            margin: 2rem auto;
            width: 90%;
            max-width: 1200px;
            border-radius: 15px;
            overflow: hidden;
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }

        .carousel-indicators button {
            background-color: #ffc107;
        }

        .card {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body h5 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-footer a {
            font-weight: 600;
        }

        footer {
            background-color: #212529;
            color: #f8f9fa;
            padding: 2rem 0;
            margin-top: 3rem;
            text-align: center;
        }

        footer p,
        footer a {
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
</head>

<body>

    <!-- Encabezado -->
    <header>
        <h1>Lubricantes Chapin</h1>
        <p><strong>La mejor tienda de Lubricantes en Cedros</strong></p>
    </header>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="img/logo.png" alt="Logo" width="70" height="70" class="d-inline-block align-text-top me-2">
                Lubricantes Chapin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="bestseller.php">Productos más Populares</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="ManagementOnclick();">Administrador</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección del carrusel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slide1.png" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="img/slide2.png" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="img/slide3.png" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="img/slide4.png" class="d-block w-100" alt="Slide 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Sección de productos -->
    <div class="container my-5">
        <div class="row">
            <?php
            // Conexión a la base de datos utilizando PDO y la clase Conexion
            require_once 'conexion.php'; // Asegúrate de que este archivo está correctamente ubicado
            $conn = Conexion::conectar();

            if ($conn) {
                // Consulta para obtener productos
                $sql = "SELECT p.*, c.nombre_categoria FROM `tbl_products` p
                        JOIN `categorias` c ON p.id_categoria = c.categoria_id";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($productos) {
                    foreach ($productos as $row) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
                                <div class="product-image bg-light">
                                    <?php 
                                    // Validar la existencia de la imagen
                                    $image_path = htmlspecialchars($row['imagen']);
                                    if (file_exists($image_path)) {
                                        echo "<img src='$image_path' alt='Producto' class='img-fluid'>";
                                    } else {
                                        echo "<img src='img/default.png' alt='Imagen no disponible' class='img-fluid'>";
                                    }
                                    ?>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title font-weight-bold text-primary"><?php echo htmlspecialchars($row['nombre']); ?></h5>
                                    <p class="card-text"><strong>Descripción:</strong> 
                                        <?php echo htmlspecialchars($row['descripcion']); ?>
                                    </p>
                                    <p class="card-text"><strong>Precio:</strong> 
                                        <span class="text-success">$<?php echo htmlspecialchars($row['precio']); ?></span>
                                    </p>
                                    <p class="card-text"><strong>Categoría:</strong> 
                                        <?php echo htmlspecialchars($row['nombre_categoria']); ?>
                                    </p>
                                    <p class="card-text"><strong>Cantidad disponible:</strong> 
                                        <?php echo htmlspecialchars($row['cantidad_disponible']); ?>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="detalle_producto.php?id=<?php echo htmlspecialchars($row['id_producto']); ?>" class="btn btn-primary">Ver Detalle</a>
                                </div>
                            </div>
                        </div>
                    <?php 
                    }
                } else {
                    echo "<div class='alert alert-danger'>No se encontraron productos.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No se pudo establecer la conexión con la base de datos.</div>";
            }
            ?>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Lubricantes Chapin. Todos los derechos reservados.</p>
            <p>Desarrollado por tu nombre.</p>
        </div>
    </footer>

    <!-- Bootstrap JS (incluyendo Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function ManagementOnclick() {
            Swal.fire({
                title: 'Acceso de Administrador',
                text: "Por favor, ingresa tu usuario y contraseña.",
                input: 'text',
                inputLabel: 'Usuario',
                showCancelButton: true,
                inputPlaceholder: 'Escribe tu usuario aquí'
            }).then((result) => {
                if (result.isConfirmed) {
                    const user = result.value;
                    // Agregar lógica para verificar usuario y contraseña
                    console.log("Usuario ingresado: ", user);
                    // Puedes redirigir o mostrar una alerta dependiendo de la validación
                }
            });
        }
    </script>
</body>

</html>
