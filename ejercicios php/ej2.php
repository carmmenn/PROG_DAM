<?php
error_reporting(E_ALL);

//ejercicio1
$cadena = readline ("Escribe una cadena de texto: ");
$contador = 0;
$longitud = strlen($cadena);
for ($i=0;$i>$longitud;$i++){
    if ($cadena== ' '){
        $contador++;
    }
}

if ($longitud>0){
    $contador++;
}
echo $contador;

$array = [5, 2, 9, 1, 6, 3];

echo "Array original: ";
foreach ($array as $numero) {
    echo "$numero ";
}
echo "\n";

$longitud = count($array);

for ($i = 0; $i < $longitud - 1; $i++) {
    for ($j = 0; $j < $longitud - $i - 1; $j++) {
        if ($array[$j] > $array[$j + 1]) {
            $temp = $array[$j];
            $array[$j] = $array[$j + 1];
            $array[$j + 1] = $temp;
        }
    }
}

echo "Array ordenado: ";
foreach ($array as $numero) {
    echo "$numero ";
}
echo "\n";

//ejercicio3
echo "Ingresa una contraseña: ";
$contrasena = readline();

if (strlen($contrasena) < 8) {
    echo "La contraseña debe tener al menos 8 caracteres.\n";
    exit;
}

$mayuscula = false;
$minuscula = false;
$numero = false;

for ($i = 0; $i < strlen($contrasena); $i++) {
    $caracter = $contrasena[$i];
    if ($caracter >= 'A' && $caracter <= 'Z') {
        $mayuscula = true;
    } elseif ($caracter >= 'a' && $caracter <= 'z') {
        $minuscula = true;
    } elseif ($caracter >= '0' && $caracter <= '9') {
        $numero = true;
    }
}

if (!$mayuscula) {
    echo "La contraseña debe contener al menos una letra mayúscula.\n";
    exit;
}

if (!$minuscula) {
    echo "La contraseña debe contener al menos una letra minúscula.\n";
    exit;
}

if (!$numero) {
    echo "La contraseña debe contener al menos un número.\n";
    exit;
}

echo "Contraseña válida.\n";


//ejercicio4
$nombres = ["Carlos", "María", "José", "Laura", "Miguel", "Ana"];
$apellidos = ["García", "López", "Martínez", "Pérez", "Rodríguez", "Sánchez"];

$indiceNombre = rand(0, count($nombres) - 1);
$indiceApellido = rand(0, count($apellidos) - 1);

$nombreCompleto = $nombres[$indiceNombre] . " " . $apellidos[$indiceApellido];

echo "Nombre generado: $nombreCompleto\n";


//ejercicio5
$resultado = rand(1, 6);
echo "El resultado del lanzamiento del dado es: $resultado\n";
?>