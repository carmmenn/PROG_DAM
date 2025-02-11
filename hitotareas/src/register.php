<?php
require_once "db.php";

$pdo = Conexion::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Verificar si se ha marcado la casilla de aceptación de políticas
        if (!isset($_POST["acceptPolicies"])) {
            header("Location: ../views/registro.php?error=Debe aceptar las políticas.");
            exit();
        }

        // Verificar si se ha marcado la casilla de aceptación de cookies
        if (!isset($_POST["acceptCookies"])) {
            header("Location: ../views/registro.php?error=Debe aceptar el uso de cookies.");
            exit();
        }

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        // Verificar si el correo ya está registrado
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            header("Location: ../views/registro.php?error=Este correo ya está registrado.");
            exit();
        }

        // Insertar el nuevo usuario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        header("Location: ../views/iniciarsesion.php");
        exit();
    } catch (Exception $e) {
        header("Location: ../views/registro.php?error=Error al registrar el usuario.");
        exit();
    }
}
?>
