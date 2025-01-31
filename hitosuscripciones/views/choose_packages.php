<?php
require_once '..\src\Subscription.php';
require_once '..\src\User.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $subscription = new Subscription();
    $user = new User();
    $userData = $user->getUserById($userId);
    $userPackages = $subscription->getPackages($userId);

    if (!$userData) {
        echo "Usuario no encontrado.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $packages = [];
        if (isset($_POST['packages'])) {
            $packages = $_POST['packages'];
        }

        try {
            $subscription->delete($userId);
            $subscription->create($userId, $packages);
            header("Location: list_users.php?updated=true");
            exit();
        } catch (Exception $e) {
            echo "Error al actualizar los paquetes: " . $e->getMessage();
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
    <title>Elegir Paquetes</title>
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
        <h1>Elegir Paquetes</h1>
    </header>

    <main class="container py-5">
        <div id="alert-container" style="color: red; display: none;"></div>

        <section class="form-section">
            <div class="card bg-dark text-white" style="transition: none; transform: none;">
                <div class="card-body">
                    <form action="choose_packages.php?user_id=<?php echo $userId; ?>" method="POST" id="user-form" class="needs-validation" novalidate>
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
                        <button type="submit" class="btn btn-primary mt-3" style="background-color: #6C7AAB; color: white;">Añadir Paquetes</button>
                    </form>
                </div>
            </div>
        </section>

        <br>
        <div class="text-center">
            <a href="list_users.php" class="btn btn-secondary">No, gracias. Volver a la lista de usuarios.</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/script.js"></script>
    <script>
        document.querySelector("form#user-form").addEventListener("submit", function(e) {
            const age = <?php echo $userData['age']; ?>;
            const basePlan = "<?php echo $userData['base_plan']; ?>";
            const subscriptionDuration = <?php echo $userData['subscription_duration']; ?>;
            const packages = Array.from(document.querySelectorAll("input[name='packages[]']:checked")).map(p => p.value);
            const alertContainer = document.getElementById("alert-container");

            alertContainer.style.display = "none";

            if (age < 18) {
                if (packages.length > 0 && (!packages.includes("Infantil") || packages.length > 1)) {
                    alertContainer.textContent = "Los usuarios menores de 18 años solo pueden contratar el Pack Infantil.";
                    alertContainer.style.display = "block";
                    e.preventDefault();
                }
                if (basePlan !== "Básico") {
                    alertContainer.textContent = "Los usuarios menores de 18 años solo pueden contratar el Plan Básico.";
                    alertContainer.style.display = "block";
                    e.preventDefault();
                }
            }

            if (basePlan === "Básico" && packages.length > 1) {
                alertContainer.textContent = "El Plan Básico solo permite un paquete adicional.";
                alertContainer.style.display = "block";
                e.preventDefault();
            }

            if (basePlan === "Estándar" && packages.length > 2) {
                alertContainer.textContent = "El Plan Estándar solo permite hasta dos paquetes adicionales.";
                alertContainer.style.display = "block";
                e.preventDefault();
            }

            if (subscriptionDuration < 12 && packages.includes("Deporte")) {
                alertContainer.textContent = "El Pack Deporte solo puede ser contratado si la duración de la suscripción es de 1 año.";
                alertContainer.style.display = "block";
                e.preventDefault();
            }

            if (age < 18 && basePlan === "Premium" && packages.length === 3) {
                alertContainer.textContent = "Los usuarios menores de 18 años no pueden contratar los tres paquetes con el plan Premium.";
                alertContainer.style.display = "block";
                e.preventDefault();
            }
        });
    </script>
</body>
</html>