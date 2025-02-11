<?php
// Inicia la sesión
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="container mt-5">
    <h1>Bienvenido a la Gestión de Tareas</h1>
    <?php if (!isset($_SESSION['user'])): ?>
        <!-- Muestra los enlaces de registro e inicio de sesión si el usuario no está autenticado -->
        <a href="views/registro.php" class="btn btn-primary">Registrarse</a>
        <a href="views/iniciarsesion.php" class="btn btn-secondary">Iniciar Sesión</a>
    <?php else: ?>
        <!-- Muestra los enlaces de ver tareas y cerrar sesión si el usuario está autenticado -->
        <a href="views/tareas.php" class="btn btn-primary">Ver Mis Tareas</a>
        <a href="src/logout.php" class="btn btn-secondary">Cerrar Sesión</a>
    <?php endif; ?>
</body>
</html>
