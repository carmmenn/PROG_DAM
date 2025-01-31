<?php
require_once '..\src\User.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = new User();

    try {
        $user->deleteUser($userId);
        $message = "Usuario eliminado exitosamente.";
    } catch (Exception $e) {
        $message = "Error al eliminar el usuario: " . $e->getMessage();
    }
} else {
    $message = "ID de usuario no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="../public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="overlay"></div>
    <header class="text-center py-5">
        <h1>Eliminar Usuario</h1>
    </header>

    <main class="container py-5 text-center">
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
        <a href="list_users.php" class="btn btn-secondary">Volver a la lista de usuarios</a>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>