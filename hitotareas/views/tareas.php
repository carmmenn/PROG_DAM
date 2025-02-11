<?php
require_once "../src/db.php";
session_start();
// Verificar si el usuario está autenticado usando sesión o cookies
if (!isset($_SESSION["user"]) && isset($_COOKIE["user"])) {
    $_SESSION["user"] = $_COOKIE["user"];
    $_SESSION["user_id"] = $_COOKIE["user_id"];
}

if (!isset($_SESSION["user"])) {
    header("Location: iniciarsesion.php");
    exit();
}

$user = $_SESSION["user"];
$userId = $_SESSION["user_id"];

$pdo = Conexion::getConnection();

// Obtener las tareas del usuario 
$stmt = $pdo->prepare("SELECT id, task, completed FROM tasks WHERE user_id = ?");
$stmt->execute([$userId]);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Tareas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Mis Tareas</h2>
    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="../src/tasks.php" method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="task" class="form-control" placeholder="Nueva Tarea" required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </form>
    <ul class="list-group">
        <?php foreach ($tasks as $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo htmlspecialchars($task["task"]); ?>
                <div>
                    <?php if (!$task["completed"]): ?>
                        <form action="../src/tasks.php" method="POST" class="d-inline">
                            <button type="submit" name="complete" value="<?php echo $task["id"]; ?>" class="btn btn-success btn-sm">Completar</button>
                        </form>
                    <?php else: ?>
                        <form action="../src/tasks.php" method="POST" class="d-inline">
                            <button type="submit" name="incomplete" value="<?php echo $task["id"]; ?>" class="btn btn-warning btn-sm">Incompleta</button>
                        </form>
                    <?php endif; ?>
                    <form action="../src/tasks.php" method="POST" class="d-inline">
                        <button type="submit" name="delete" value="<?php echo $task["id"]; ?>" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="../src/logout.php" class="btn btn-secondary mt-3">Cerrar Sesión</a>
</body>
</html>
