<?php
require_once '..\src\User.php';
require_once '..\src\Subscription.php';

$user = new User();
$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-delete {
            background-color: #FF6B6B;
            border-color: #FF6B6B;
        }
        .btn-delete:hover {
            background-color: #FF4C4C;
            border-color: #FF4C4C;
        }
    </style>
</head>
<body class="no-blur">
    <div class="overlay"></div>
    <header class="text-center py-5">
        <h1>Lista de Usuarios</h1>
    </header>

    <main class="container py-5">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Edad</th>
                    <th>Plan Base</th>
                    <th>Duración de la Suscripción (meses)</th>
                    <th>Paquetes Adicionales</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    $packages = (new Subscription())->getPackages($user['id']);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['age']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['base_plan']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['subscription_duration']) . "</td>";
                    echo "<td>" . (empty($packages) ? "Sin paquetes" : implode(", ", $packages)) . "</td>";
                    echo "<td>
                            <a href='update_user.php?id=" . $user['id'] . "' class='btn btn-primary btn-sm' style='background-color: #6C7AAB; color: white;'>Editar</a>
                            <a href='delete_user.php?id=" . $user['id'] . "' class='btn btn-delete btn-sm'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        <div class="text-center">
            <a href="create_user.php" class="btn btn-secondary">Crear Nuevo Usuario</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>