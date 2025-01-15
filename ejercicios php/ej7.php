<?php
error_reporting(E_ALL);
//ejercicio1
class Persona{
    public $nombre;
    public $edad;
    public $genero;
    public function presentar(){
        echo $this->nombre. $this->edad. $this->genero;
    }
}

$persona=new Persona;
$persona->nombre="Carmen";
$persona->edad=18;
$persona->genero="Mujer";
$persona->presentar();

//ejercicio2
class Rectangulo {
    public $base;
    public $altura;

    public function calcularArea() {
        return $this->base * $this->altura;
    }
}

$rectangulo = new Rectangulo;
$rectangulo->base = 10;
$rectangulo->altura = 5;

echo "El área del rectángulo es: " . $rectangulo->calcularArea();

//ejercicio3
error_reporting(E_ALL);

class Animal {
    public $especie;

    public function emitirSonido() {
        echo "El animal hace un sonido genérico.";
    }
}

class Perro extends Animal {
    public $raza;

    public function emitirSonido() {
        echo "El perro ladra: ¡Guau guau!";
    }
}

$perro = new Perro;
$perro->especie = "Canino";
$perro->raza = "Labrador";

echo "Especie: " . $perro->especie . "\n";
echo "Raza: " . $perro->raza . "\n";
$perro->emitirSonido();

//ejercicio4
class Producto {
    public $nombre;
    public $precio;

    public function mostrarDetalles() {
        echo "Producto: " . $this->nombre . "\n";
        echo "Precio: $" . $this->precio . "\n";
    }
}

class Electrodomestico extends Producto {
    public $consumo;

    public function mostrarDetalles() {
        parent::mostrarDetalles();
        echo "Consumo: " . $this->consumo . " kWh\n";
    }
}

$producto = new Producto;
$producto->nombre = "Mesa";
$producto->precio = 150;
$producto->mostrarDetalles();

echo "\n";

$electrodomestico = new Electrodomestico;
$electrodomestico->nombre = "Refrigerador";
$electrodomestico->precio = 500;
$electrodomestico->consumo = 1.2;
$electrodomestico->mostrarDetalles();

//ejercicio5
class ConversorMoneda {
    private $factorDolarEuro = 0.85; // 1 USD = 0.85 EUR
    private $factorEuroDolar = 1.18; // 1 EUR = 1.18 USD

    public function convertirDolaresAEuros($dolares) {
        return $dolares * $this->factorDolarEuro;
    }

    public function convertirEurosADolares($euros) {
        return $euros * $this->factorEuroDolar;
    }
}

$conversor = new ConversorMoneda;

$dolares = 100;
$euros = 85;

echo "$dolares USD son " . $conversor->convertirDolaresAEuros($dolares) . " EUR\n";
echo "$euros EUR son " . $conversor->convertirEurosADolares($euros) . " USD\n";
?>