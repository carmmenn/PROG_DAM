<?php
class Conexion {
    private static $conexion = null;
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $password = 'curso';
    private $base_datos = 'tareas';

    public static function getConnection() {
        if (self::$conexion === null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=localhost;dbname=tareas;charset=utf8",
                    'root',
                    'curso'
                );
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}
?>