<?php
error_reporting(E_ALL);

// Ejercicio 1
class Producto {
    private $nombre;
    private $precio;
    private $cantidad;

    public function __construct($nombre, $precio, $cantidad) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }
}

class ProductoImportado extends Producto {
    private $impuestoAdicional;

    public function __construct($nombre, $precio, $cantidad, $impuestoAdicional) {
        parent::__construct($nombre, $precio, $cantidad);
        $this->impuestoAdicional = $impuestoAdicional;
    }

    public function calcularPrecioFinal() {
        return $this->getPrecio() + ($this->getPrecio() * $this->impuestoAdicional / 100);
    }
}

$producto = new Producto("Laptop", 1000, 5);
$productoImportado = new ProductoImportado("Smartphone", 800, 3, 15);

echo "Producto: " . $producto->getNombre() . " - Precio: $" . $producto->getPrecio() . " - Cantidad: " . $producto->getCantidad() . "\n";
echo "Producto Importado: " . $productoImportado->getNombre() . " - Precio Final: $" . $productoImportado->calcularPrecioFinal() . "\n\n";

// Ejercicio 2
class CuentaBancaria {
    private $titular;
    private $saldo;
    private $tipoCuenta;

    public function __construct($titular, $tipoCuenta) {
        $this->titular = $titular;
        $this->saldo = 0;
        $this->tipoCuenta = $tipoCuenta;
    }

    public function depositar($cantidad) {
        $this->saldo += $cantidad;
        echo "Depósito de $cantidad realizado. Nuevo saldo: $this->saldo\n";
    }

    public function retirar($cantidad) {
        if ($this->verificarSaldoSuficiente($cantidad)) {
            $this->saldo -= $cantidad;
            echo "Retiro de $cantidad realizado. Nuevo saldo: $this->saldo\n";
        } else {
            echo "Saldo insuficiente para retirar $cantidad.\n";
        }
    }

    private function verificarSaldoSuficiente($cantidad) {
        return $this->saldo >= $cantidad;
    }
}

$cuenta = new CuentaBancaria("Juan Pérez", "Corriente");
$cuenta->depositar(500);
$cuenta->retirar(200);
$cuenta->retirar(400);

echo "\n";

// Ejercicio 3
class Usuario {
    protected $nombre;
    protected $email;

    public function __construct($nombre, $email) {
        $this->nombre = $nombre;
        $this->email = $email;
    }

    public function mostrarInfo() {
        echo "Usuario: $this->nombre, Email: $this->email\n";
    }
}

class Administrador extends Usuario {
    private $nivelAcceso;

    public function __construct($nombre, $email, $nivelAcceso) {
        parent::__construct($nombre, $email);
        $this->nivelAcceso = $nivelAcceso;
    }

    public function mostrarInfo() {
        parent::mostrarInfo();
        echo "Nivel de Acceso: $this->nivelAcceso\n";
    }
}

$usuario = new Usuario("María López", "maria@example.com");
$admin = new Administrador("Carlos Ruiz", "carlos@example.com", "SuperAdmin");

$usuario->mostrarInfo();
$admin->mostrarInfo();

echo "\n";

// Ejercicio 4
class Vehiculo {
    private $marca;
    private $modelo;

    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function encender() {
        echo "El vehículo $this->marca $this->modelo está encendido.\n";
    }
}

class Coche extends Vehiculo {
    private $combustible;

    public function __construct($marca, $modelo, $combustible) {
        parent::__construct($marca, $modelo);
        $this->combustible = $combustible;
    }

    public function mostrarDetalles() {
        echo "Coche: Marca: $this->marca, Modelo: $this->modelo, Combustible: $this->combustible\n";
    }
}

$coche = new Coche("Toyota", "Corolla", "Gasolina");
$coche->encender();
$coche->mostrarDetalles();

echo "\n";

// Ejercicio 5
class Empleado {
    private $nombre;
    private $sueldo;
    private $puesto;

    public function __construct($nombre, $sueldo, $puesto) {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
        $this->puesto = $puesto;
    }

    public function setSueldo($nuevoSueldo) {
        $this->sueldo = $nuevoSueldo;
    }

    public function getSueldo() {
        return $this->sueldo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPuesto() {
        return $this->puesto;
    }
}

class Manager extends Empleado {
    private $departamento;

    public function __construct($nombre, $sueldo, $puesto, $departamento) {
        parent::__construct($nombre, $sueldo, $puesto);
        $this->departamento = $departamento;
    }

    public function revisarEmpleado(Empleado $empleado) {
        echo "El Manager está revisando al empleado: " . $empleado->getNombre() . ", Puesto: " . $empleado->getPuesto() . "\n";
    }
}

$empleado1 = new Empleado("Pedro Gómez", 3000, "Desarrollador");
$manager = new Manager("Lucía Fernández", 5000, "Gerente", "IT");

$manager->revisarEmpleado($empleado1);
echo "Sueldo antes del aumento: $" . $empleado1->getSueldo() . "\n";
$empleado1->setSueldo(3500);
echo "Sueldo después del aumento: $" . $empleado1->getSueldo() . "\n";

?>