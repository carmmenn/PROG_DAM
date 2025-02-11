<?php
require_once "db.php";
session_start();

$pdo = Conexion::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Preparar y ejecutar la consulta para obtener los datos del usuario
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verificar la contraseña y establecer la sesión y las cookies si es válida
        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["username"];
            $_SESSION["user_id"] = $user["id"];
            
            // Establecer cookies por 30 días
            setcookie("user", $user["username"], time() + (86400 * 30), "/");
            setcookie("user_id", $user["id"], time() + (86400 * 30), "/");
            
            header("Location: ../views/tareas.php");
            exit();
        } else {
            header("Location: ../views/iniciarsesion.php?error=Credenciales incorrectas.");
            exit();
        }
    } catch (Exception $e) {
        header("Location: ../views/iniciarsesion.php?error=Error al iniciar sesión.");
        exit();
    }
}
?>
