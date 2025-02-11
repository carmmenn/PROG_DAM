<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body class="container mt-5">
    <h2>Registro</h2>
    <form action="../src/register.php" method="POST">
        <!-- Campo de entrada para el nombre de usuario -->
        <div class="mb-3">
            <label for="username" class="form-label">Usuario:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <!-- Campo de entrada para el correo electrónico -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
            <!-- Mostrar mensaje de error si el parámetro 'error' está establecido en la URL -->
            <?php if (isset($_GET['error'])): ?>
                <div class="invalid-feedback" style="display: block;">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- Campo de entrada para la contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <!-- Casilla de verificación para aceptar las políticas -->
        <div class="mb-3 form-check">
            <input type="checkbox" id="acceptPolicies" name="acceptPolicies" class="form-check-input" required>
            <label for="acceptPolicies" class="form-check-label">Acepto las políticas correspondientes</label>
        </div>
        <!-- Casilla de verificación para aceptar las cookies -->
        <div class="mb-3 form-check">
            <input type="checkbox" id="acceptCookies" name="acceptCookies" class="form-check-input" required>
            <label for="acceptCookies" class="form-check-label">Acepto el uso de cookies</label>
        </div>
        <!-- Botón de envío -->
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <!-- Enlace a la página de inicio de sesión -->
    <a href="iniciarsesion.php">Ya tienes una cuenta? Inicia Sesión</a>
</body>
</html>
