<?php
error_reporting(E_ALL);

//ejercicio1
$num1 = readline("Dame el primer numero: ");
$num2 = readline("Dame el segundo numero: ");

echo "Menú de operaciones:
Suma(1)
Resta(2)
Multiplicación(3)
División(4)";

$operaciones = readline("Elije una operación: ");
if ($operaciones==1){
    $resultado=$num1+$num2;
    echo "Este es el resultado de la suma: $resultado";
} elseif ($operaciones==2){
    $resultado=$num1-$num2;
    echo "Este es el resultado de la resta: $resultado";
} elseif ($operaciones==3){
    $resultado=$num1*$num2;
    echo "Este es el resultado de la multiplicación: $resultado";
} elseif ($operaciones==4){
    if ($num2!=0){
    $resultado=$num1/$num2;
        echo "Este es el resultado de la división: $resultado";
    }
    else{
        echo "No se puede dividir entre 0. ";
    }
}
else{
    echo "Elige entre una de las opciones disponibles.";
}


//ejercicio2
$num1 = readline("Dame un número: ");

for ($i = 1; $i <= 10; $i++) {
    $resultado = $num1 * $i;
    echo "$num1 x $i = $resultado\n";
}


//ejercicio3
$num1 = readline("Dame un numero: ");

for ($i=2; $i<=$num1/2; ) {
    echo ($num1 % $i == 0 ) ? "$num1 es primo" : "No es primo ";
    break;
}


//ejercicio4

$numeroSecreto = rand(1, 100);
$adivinanza = 0;

echo "Adivina un número del 1 al 100.\n ";

while ($adivinanza != $numeroSecreto) {
    $adivinanza = readline("Ingresa tu apuesta: ");

    if ($adivinanza < $numeroSecreto) {
        echo "Demasiado bajo, intenta de nuevo.";
    } elseif ($adivinanza > $numeroSecreto) {
        echo "Demasiado alto, intenta de nuevo.";
    } else {
        echo "Has adivinado el número $numeroSecreto.";
    }
}
?>


//ejercicio5

$numero = readline("Ingresa la altura de la pirámide: ");
for ($i=1;$i<=$numero;$i++){
    for ($espacio=1;$espacio <= $numero - $i;$espacio++){
        echo " ";
    }
    for ($asteriscos=1;$asteriscos<=(2*$i-1);$asteriscos++){
        echo "*";
    }
    echo "\n";
}
?>