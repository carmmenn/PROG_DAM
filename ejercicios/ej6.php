<?php
error_reporting(E_ALL);
//ejercicio1
class Libro{
    public $titulo;
    public $autor;
    public $numero_de_paginas;
    public function mostrarInfo(){
        echo $this->titulo. $this->autor. $this->numero_de_paginas;
    }
}
$mi_libro=new Libro;
$mi_libro->titulo="Luna de Plutón";
$mi_libro->autor="Patricio Estrella";
$mi_libro->numero_de_paginas=13;
$mi_libro->mostrarInfo();

//ejercicio2
class Circulo{
    public $radio=5;
    public function calculaRadio(){
        $area = pi() * pow($this->radio, 2);
        echo "El área es" .$area;
    }
}

$circulo = new Circulo();
$circulo->calculaRadio();

//ejercicio3
class Vehiculo{
    public $marca;
    public function encender(){
        echo "El coche está encendiéndose.";

    }
}
class Coche extends Vehiculo{
    public $modelo;
}

$Coche= new Coche;
$Coche->marca = "Skoda";
$Coche->encender();

//ejercicio4
class empleado{
    public $nombre;
    public $sueldo;
    public function mostrarDetalles(){
        echo "Nombre: ".$this->nombre. "\n";
        echo "Sueldo: ".$this->sueldo. "\n";
    }
}

class gerente extends empleado{
    public $departamento;
    public function mostrarDetalles(){
        echo "Nombre: ".$this->nombre. "\n";
        echo "Sueldo: ".$this->sueldo. "\n";
        echo "Departamento: ".$this->departamento. "\n";
    }
}

$gerente= new gerente;
$gerente->nombre="Pepito ";
$gerente->sueldo="1234 ";
$gerente->departamento="ventas ";
$gerente->mostrarDetalles();

$empleado= new empleado;
$empleado->nombre="Juan ";
$empleado->sueldo="4321 ";
$empleado->mostrarDetalles();

//ejercicio5
class Calculadora {
    public $num1;
    public $num2;

    public function sumar() {
        return $this->num1 + $this->num2;
    }

    public function restar() {
        return $this->num1 - $this->num2;
    }

    public function multiplicar() {
        return $this->num1 * $this->num2;
    }

    public function dividir() {
        if ($this->num2 == 0) {
            return "Error: División por cero no permitida.";
        }
        return $this->num1 / $this->num2;
    }
}

$calculadora1 = new Calculadora;
$calculadora1->num1=10;
$calculadora1->num2=5;
echo "Calculadora1\n";
echo "Suma: " . $calculadora1->sumar() . "\n";
echo "Resta: " . $calculadora1->restar() . "\n";
echo "Multiplicación: " . $calculadora1->multiplicar() . "\n";
echo "División: " . $calculadora1->dividir() . "\n";

$calculadora2 = new Calculadora;
$calculadora2->num1=10;
$calculadora2->num2=0;
echo "Calculadora2\n";
echo "División con cero: " . $calculadora2->dividir() . "\n";
?>