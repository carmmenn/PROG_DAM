<?php
require_once "db.php";
session_start();

$pdo = Conexion::getConnection();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user"])) {
    header("Location: ../views/iniciarsesion.php");
    exit();
}

$user = $_SESSION["user"];
$userId = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Añadir nueva tarea
        if (isset($_POST["task"])) {
            $task = $_POST["task"];
            $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
            $stmt->execute([$userId, $task]);
        } 
        // Marcar tarea como completada
        elseif (isset($_POST["complete"])) {
            $taskId = $_POST["complete"];
            $stmt = $pdo->prepare("UPDATE tasks SET completed = TRUE WHERE id = ? AND user_id = ?");
            $stmt->execute([$taskId, $userId]);
        } 
        // Marcar tarea como incompleta
        elseif (isset($_POST["incomplete"])) {
            $taskId = $_POST["incomplete"];
            $stmt = $pdo->prepare("UPDATE tasks SET completed = FALSE WHERE id = ? AND user_id = ?");
            $stmt->execute([$taskId, $userId]);
        } 
        // Eliminar una tarea
        elseif (isset($_POST["delete"])) {
            $taskId = $_POST["delete"];
            $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
            $stmt->execute([$taskId, $userId]);
        }
        header("Location: ../views/tareas.php");
        exit();
    } catch (Exception $e) {
        header("Location: ../views/tareas.php?error=Error al procesar la tarea.");
        exit();
    }
}
?>
