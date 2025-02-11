<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Iniciar Sesión</h2>
    <!-- Verificar si hay un mensaje de error en la URL y mostrarlo -->
    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <!-- Formulario de inicio de sesión -->
    <form action="../src/login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
    <!-- Enlace a la página de registro -->
    <a href="registro.php">¿No tienes cuenta? Regístrate</a>
</body>
</html>
