<?php
error_reporting(E_ALL);

// ejercicio1
class CuentaBancaria {
    public $titular;
    public $saldo;
    public $tipoDeCuenta;

    public function __construct($titular, $saldoInicial, $tipoDeCuenta) {
        $this->titular = $titular;
        $this->saldo = $saldoInicial;
        $this->tipoDeCuenta = $tipoDeCuenta;
    }

    public function depositar($cantidad) {
        $this->saldo += $cantidad;
        echo "Se han depositado $cantidad. Nuevo saldo: " . $this->saldo . "\n";
    }

    public function retirar($cantidad) {
        if ($cantidad <= $this->saldo) {
            $this->saldo -= $cantidad;
            echo "Se han retirado $cantidad. Nuevo saldo: " . $this->saldo . "\n";
        } else {
            echo "Saldo insuficiente para retirar $cantidad.\n";
        }
    }

    public function mostrarInfo() {
        echo "Titular: " . $this->titular . "\n";
        echo "Tipo de cuenta: " . $this->tipoDeCuenta . "\n";
        echo "Saldo actual: " . $this->saldo . "\n";
    }
}

$cuenta = new CuentaBancaria("Carmen Perez", 1000, "Ahorros");

$cuenta->depositar(500);
$cuenta->retirar(300);
$cuenta->retirar(1500);

$cuenta->mostrarInfo();

// ejercicio2
class Tarea {
    public $nombre;
    public $descripcion;
    public $fechalimite;
    public $estado;

    public function __construct($nombre, $descripcion, $fechalimite, $estado = "pendiente") {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechalimite = $fechalimite;
        $this->estado = $estado;
    }

    public function marcarCompletada() {
        $this->estado = "completada";
    }

    public function editarDescripcion($nuevaDescripcion) {
        $this->descripcion = $nuevaDescripcion;
    }

    public function mostrarTarea() {
        echo "Tarea: $this->nombre\n";
        echo "Descripción: $this->descripcion\n";
        echo "Fecha Límite: $this->fechalimite\n";
        echo "Estado: $this->estado\n";
    }
}

$tareas = [
    new Tarea("Comprar comida", "Ir al supermercado", "2025-02-10"),
    new Tarea("Estudiar PHP", "Repasar POO en PHP", "2025-02-15")
];

$tareas[0]->marcarCompletada();
$tareas[1]->editarDescripcion("Estudiar programación orientada a objetos en PHP");

foreach ($tareas as $tarea) {
    $tarea->mostrarTarea();
    echo "\n";
}

// ejercicio3
class Empleado {
    public $nombre;
    public $sueldo;
    public $aniosExperiencia;

    public function __construct($nombre, $sueldo, $aniosExperiencia) {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
        $this->aniosExperiencia = $aniosExperiencia;
    }

    public function calcularBonus() {
        return ($this->sueldo * 0.05) * floor($this->aniosExperiencia / 2);
    }

    public function mostrarDetalles() {
        echo "Empleado: $this->nombre\n";
        echo "Sueldo: $this->sueldo\n";
        echo "Años de Experiencia: $this->aniosExperiencia\n";
        echo "Bonus: " . $this->calcularBonus() . "\n";
    }
}

class Consultor extends Empleado {
    public $horasPorProyecto;

    public function __construct($nombre, $sueldo, $aniosExperiencia, $horasPorProyecto) {
        parent::__construct($nombre, $sueldo, $aniosExperiencia);
        $this->horasPorProyecto = $horasPorProyecto;
    }

    public function calcularBonus() {
        $bonusBase = parent::calcularBonus();
        $bonusExtra = ($this->horasPorProyecto > 100) ? 500 : 0;
        return $bonusBase + $bonusExtra;
    }
}

$empleado = new Empleado("Juan Pérez", 3000, 6);
$consultor = new Consultor("Ana Gómez", 4000, 4, 120);

$empleado->mostrarDetalles();
echo "\n";
$consultor->mostrarDetalles();

// ejercicio4
class Carrito {
    public $productos = [];

    public function agregarProducto($nombre, $precio, $cantidad) {
        $this->productos[] = ["nombre" => $nombre, "precio" => $precio, "cantidad" => $cantidad];
    }

    public function quitarProducto($nombre) {
        foreach ($this->productos as $key => $producto) {
            if ($producto["nombre"] == $nombre) {
                unset($this->productos[$key]);
                break;
            }
        }
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->productos as $producto) {
            $total += $producto["precio"] * $producto["cantidad"];
        }
        return $total;
    }

    public function mostrarDetalleCarrito() {
        echo "Carrito de compras:\n";
        foreach ($this->productos as $producto) {
            echo "{$producto['nombre']} - {$producto['cantidad']} unidades - ${$producto['precio']} c/u\n";
        }
        echo "Total a pagar: $" . $this->calcularTotal() . "\n";
    }
}

$carrito = new Carrito();
$carrito->agregarProducto("Laptop", 800, 1);
$carrito->agregarProducto("Mouse", 20, 2);
$carrito->mostrarDetalleCarrito();
$carrito->quitarProducto("Mouse");
$carrito->mostrarDetalleCarrito();

// ejercicio5
class Personaje {
    public $nombre;
    public $nivel;
    public $puntosVida;
    public $puntosAtaque;

    public function __construct($nombre, $nivel, $puntosVida, $puntosAtaque) {
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->puntosVida = $puntosVida;
        $this->puntosAtaque = $puntosAtaque;
    }

    public function atacar(Personaje $objetivo) {
        $objetivo->puntosVida -= $this->puntosAtaque;
        echo "$this->nombre ataca a $objetivo->nombre y le quita $this->puntosAtaque puntos de vida.\n";
    }

    public function curarse() {
        $this->puntosVida += 10;
        echo "$this->nombre se cura y ahora tiene $this->puntosVida puntos de vida.\n";
    }

    public function subirNivel() {
        $this->nivel += 1;
        $this->puntosAtaque += 5;
        $this->puntosVida += 20;
        echo "$this->nombre ha subido al nivel $this->nivel.\n";
    }

    public function mostrarEstado() {
        echo "Nombre: $this->nombre | Nivel: $this->nivel | Vida: $this->puntosVida | Ataque: $this->puntosAtaque\n";
    }
}

$heroe = new Personaje("Héroe", 1, 50, 10);
$villano = new Personaje("Villano", 1, 50, 8);

$heroe->atacar($villano);
$villano->curarse();
$heroe->subirNivel();
$villano->mostrarEstado();
$heroe->mostrarEstado();
?>