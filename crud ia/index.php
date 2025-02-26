<?php
require_once "modelo.php";

$modelo = new Modelo();
$iaModel = new IaModel();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"])) {
    $titulo = $_POST["titulo"];
    $ingredientes = $iaModel->obtenerIngredientes($titulo);
    $elaboracion = $iaModel->obtenerElaboracion($titulo);
    $modelo->agregarReceta($titulo, $ingredientes, $elaboracion);
    header("Location: index.php");
}

if (isset($_GET["eliminar"])) {
    $modelo->eliminarReceta($_GET["eliminar"]);
    header("Location: index.php");
}

$recetas = $modelo->obtenerRecetas();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recetas de Cocina</title>
</head>
<body>
    <h1>Recetas de Cocina</h1>

    <form method="POST">
        <input type="text" name="titulo" placeholder="Nombre de la receta" required>
        <button type="submit">Añadir Receta</button>
    </form>

    <ul>
        <?php foreach ($recetas as $receta): ?>
            <li>
                <strong><?= $receta["titulo"] ?></strong>
                <br>Ingredientes: <?= $receta["ingredientes"] ?>
                <br>Elaboración: <?= $receta["elaboracion"] ?>
                <br><a href="?eliminar=<?= $receta["id"] ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
