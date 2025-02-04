<?php
error_reporting(E_ALL);
//Ejercicio1
function calculadora($num1, $num2, $operador) {
    try {
        if ($operador == '/' && $num2 == 0) {
            return "Error: No se puede dividir entre cero.";
        }

        switch ($operador) {
            case '+':
                return $num1 + $num2;
            case '-':
                return $num1 - $num2;
            case '*':
                return $num1 * $num2;
            case '/':
                return $num1 / $num2;
            default:

                throw new Exception("Operador no válido.");
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

echo calculadora(10, 0, '/');


//Ejercicio2

function validarEmail ($email=null){
    if ($email===null){
        $email=readline("Escribe tu correo: ");
    }
    $longitudEmail = strlen($email);
    $arroba=false;
    $puntos=false;
    $posArroba=-1;
    $posPuntos=-1;

    for($i=0;$i<$longitudEmail;$i++){
        if ($email[$i]=='@'){
            $arroba=true;
            $posArroba=$i;
        } 
        if ($email[$i]=='.'){
            $puntos=true;
            $posPuntos=$i;
        }

        if ($arroba&&$puntos&&$posArroba<$posPuntos){
            return "Válido";
        } else{
            $mensajeError = "Error: El correo $email no es válido\n";
            file_put_contents('errores.log', $mensajeError, FILE_APPEND);
            return "Error registrado en errores.log";    
        }
    }
}

echo validarEmail();


// Ejercicio 3

function buscarElemento($array, $valor) {
    try {
        $indice = array_search($valor, $array);
        if ($indice === false) {
            throw new Exception("Error: El elemento no se encuentra en el array.");
        }
        return $indice;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

$array = ["manzana", "naranja", "pera"];
echo buscarElemento($array, "pera") . "\n";
echo buscarElemento($array, "plátano") . "\n";


// Ejercicio 4

function tablaMultiplicar($numero) {
    try {
        if (!is_int($numero) || $numero < 0) {
            throw new Exception("Error: El número debe ser un entero positivo.");
        }

        for ($i = 1; $i <= 10; $i++) {
            echo "$numero x $i = " . ($numero * $i) . "\n";
        }
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}

tablaMultiplicar(5);
tablaMultiplicar(-2);


// Ejercicio 5

function convertirTemperatura($valor, $unidad) {
    try {
        if ($unidad == "C") {
            return ($valor - 32) * 5 / 9;
        } elseif ($unidad == "F") {
            return ($valor * 9 / 5) + 32;
        } else {
            throw new Exception("Unidad no válida. Usa 'C' para Celsius o 'F' para Fahrenheit.");
        }
    } catch (Exception $e) {
        $mensajeError = "Error: " . $e->getMessage() . "\n";
        file_put_contents('errores.log', $mensajeError, FILE_APPEND);
        return "Error registrado en errores.log";
    }
}

echo convertirTemperatura(100, "C") . "\n";
echo convertirTemperatura(0, "F") . "\n";
echo convertirTemperatura(25, "X") . "\n";

?>