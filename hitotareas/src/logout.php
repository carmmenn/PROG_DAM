<?php
// Iniciar la sesión
session_start();

// Destruir la sesión
session_destroy();

// Eliminar cookies
setcookie("user", "", time() - 3600, "/");
setcookie("user_id", "", time() - 3600, "/");

// Redirigir a la página de inicio
header("Location: ../index.php");
exit();
?>