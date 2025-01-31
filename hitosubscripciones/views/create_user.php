<?php
require_once '..\src\User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $base_plan = $_POST['base_plan'];
    $subscription_duration = $_POST['subscription_duration'];

    $userData = [
        'name' => $name,
        'email' => $email,
        'age' => $age,
        'base_plan' => $base_plan,
        'subscription_duration' => $subscription_duration
    ];

    $user = new User();

    try {
        $userId = $user->createUser($userData);
        header("Location: choose_packages.php?user_id=" . $userId);
        exit();
    } catch (Exception $e) {
        echo "Error al crear el usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-check-input:checked {
            background-color: #6C7AAB;
            border-color: #6C7AAB;
        }
        .overlay {
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <header class="text-center py-5">
        <h1>Crear Usuario</h1>
    </header>

    <main class="container py-5">
        <div id="alert-container" style="color: red; display: none;"></div>

        <section class="form-section">
            <div class="card bg-dark text-white" style="transition: none; transform: none;">
                <div class="card-body">
                    <form action="create_user.php" method="POST" id="user-form" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese un nombre.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese un correo electrónico válido.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Edad:</label>
                            <input type="number" id="age" name="age" class="form-control" min="1" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese una edad válida.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="base_plan" class="form-label">Plan Base:</label>
                            <select id="base_plan" name="base_plan" class="form-select" required>
                                <option value="Básico">Básico</option>
                                <option value="Estándar">Estándar</option>
                                <option value="Premium">Premium</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione un plan base.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subscription_duration" class="form-label">Duración de la Suscripción (meses):</label>
                            <input type="number" id="subscription_duration" name="subscription_duration" class="form-control" min="1" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese una duración válida.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" style="background-color: #6C7AAB; color: white;">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/script.js"></script>
</body>
</html>