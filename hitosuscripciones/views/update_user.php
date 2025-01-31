<?php
require_once '..\src\User.php';
require_once '..\src\Subscription.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = new User();
    $subscription = new Subscription();
    $userData = $user->getUserById($userId);
    $userPackages = $subscription->getPackages($userId);

    if (!$userData) {
        echo "Usuario no encontrado.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $base_plan = $_POST['base_plan'];
        $subscription_duration = $_POST['subscription_duration'];
        $packages = [];
        if (isset($_POST['packages'])) {
            $packages = $_POST['packages'];
        }

        if ($subscription_duration < $userData['subscription_duration']) {
            echo "<script>document.getElementById('alert-container').textContent = 'La nueva duración no puede ser menor que la actual.'; document.getElementById('alert-container').style.display = 'block';</script>";
            exit();
        }

        try {
            $user->updateUser($userId, [
                'name' => $name,
                'email' => $email,
                'age' => $age,
                'base_plan' => $base_plan,
                'subscription_duration' => $subscription_duration
            ]);

            $subscription->delete($userId);
            $subscription->create($userId, $packages);

            header("Location: list_users.php?updated=true");
            exit();
        } catch (Exception $e) {
            echo "Error al actualizar el usuario: " . $e->getMessage();
        }
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
<body class="no-blur">
    <div class="overlay"></div>
    <header class="text-center py-5">
        <h1>Editar Usuario</h1>
    </header>

    <main class="container py-5">
        <div id="alert-container" style="color: red; display: none;"></div>

        <section class="form-section">
            <div class="card bg-dark text-white" style="transition: none; transform: none;">
                <div class="card-body">
                    <form method="POST" id="user-form" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese un nombre.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese un correo electrónico válido.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Edad:</label>
                            <input type="number" id="age" name="age" class="form-control" value="<?php echo htmlspecialchars($userData['age']); ?>" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese una edad válida.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="base_plan" class="form-label">Plan Base:</label>
                            <select id="base_plan" name="base_plan" class="form-select" required>
                                <option value="Básico" <?php echo $userData['base_plan'] == 'Básico' ? 'selected' : ''; ?>>Básico</option>
                                <option value="Estándar" <?php echo $userData['base_plan'] == 'Estándar' ? 'selected' : ''; ?>>Estándar</option>
                                <option value="Premium" <?php echo $userData['base_plan'] == 'Premium' ? 'selected' : ''; ?>>Premium</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione un plan base.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subscription_duration" class="form-label">Duración de la Suscripción (meses):</label>
                            <input type="number" id="subscription_duration" name="subscription_duration" class="form-control" min="<?php echo htmlspecialchars($userData['subscription_duration']); ?>" value="<?php echo htmlspecialchars($userData['subscription_duration']); ?>" required>
                            <div class="invalid-feedback">
                                Por favor, ingrese una duración válida.
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" id="deporte" name="packages[]" value="Deporte" class="form-check-input" <?php echo in_array('Deporte', $userPackages) ? 'checked' : ''; ?>>
                            <label for="deporte" class="form-check-label">Deporte</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" id="cine" name="packages[]" value="Cine" class="form-check-input" <?php echo in_array('Cine', $userPackages) ? 'checked' : ''; ?>>
                            <label for="cine" class="form-check-label">Cine</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" id="infantil" name="packages[]" value="Infantil" class="form-check-input" <?php echo in_array('Infantil', $userPackages) ? 'checked' : ''; ?>>
                            <label for="infantil" class="form-check-label">Infantil</label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" style="background-color: #6C7AAB; color: white;">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </section>

        <br>
        <div class="text-center">
            <a href="list_users.php" class="btn btn-secondary">Volver a la lista de usuarios</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/script.js"></script>

</body>
</html>