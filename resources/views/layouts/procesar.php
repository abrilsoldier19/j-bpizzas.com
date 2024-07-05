<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzería delicioso</title>
    <!-- Agrega el enlace al CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strtoupper($_POST["nombre"]);
    $hora = $_POST["hora"];
    $hora_24h = convertirHoraAMPMa24($hora);

    // Agrega el contenido del cuerpo de la página de la actividad anterior

    // Barra de navegación
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Pizzería delicioso</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Regístrate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ordena</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mis Pedidos</a>
                    </li>
                </ul>
            </div>
        </nav>';

    // Cuerpo del sitio
    echo '<div class="container text-center mb-5 mt-5">
            <h1>¡Bienvenido a Pizzería delicioso!</h1>
            <p>Te ofrecemos las mejores pizzas recién salidas del horno.</p>
          </div>';

    echo '<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>¡Bienvenido a mi negocio!</h2>
                    <p>Una descripción adecuada de mi negocio.</p>
                </div>
            </div>
          </div>';

    echo '<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Primer Elemento</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-md-4">
                    <h2>Segundo Elemento</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-md-4">
                    <h2>Tercer Elemento</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
          </div>';

    echo '<div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <p>Pellentesque sapien odio, vehicula ac vestibulum ut, porttitor quis velit. Etiam tempus blandit lectus sit amet rhoncus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus arcu leo, molestie non varius at, commodo nec nulla. Nunc in rutrum urna. Phasellus tempus nibh vel urna efficitur ultricies. Aliquam porta, diam in venenatis ornare, dui nibh lobortis tellus, ut consectetur orci lorem id ante. Nunc ut mauris dignissim, finibus elit et, rutrum nibh. Curabitur vel feugiat dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas tellus urna, maximus a lacus id, vestibulum semper eros.</p>
                </div>
                <div class="col-md-4">
                    <p>Donec luctus, neque eu auctor posuere, dui justo rhoncus est, vel gravida nisl magna sit amet orci. Nullam vel mauris turpis. Praesent vestibulum ipsum sed ipsum finibus blandit. Aliquam a nulla aliquam, aliquet odio quis, semper tellus. Praesent euismod semper nibh scelerisque volutpat. Praesent quis euismod est, vitae lacinia enim. Fusce eu congue mi. Integer imperdiet varius eros.</p>
                </div>
            </div>
          </div>';

    // Pie de página
    echo '<footer class="footer mt-5">
            <div class="container">
                <p>Mi Negocio - 2022</p>
            </div>
          </footer>';
}

function convertirHoraAMPMa24($hora)
{
    return date("H:i:s", strtotime($hora));
}
?>

<!-- Agrega los enlaces al JS de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
