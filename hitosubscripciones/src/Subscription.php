<?php
require_once 'db.php';

class Subscription {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConnection();
    }

    public function create($userId, $packages) {
        // Fetch user details
        $stmt = $this->conexion->prepare("SELECT age, base_plan FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['age'] < 18 && $user['base_plan'] === 'Premium' && count($packages) === 3) {
            throw new Exception("Los usuarios menores de 18 años no pueden contratar los tres paquetes con el plan Premium.");
        }

        if ($packages) {
            foreach ($packages as $package) {
                if (!in_array($package, ['Deporte', 'Cine', 'Infantil'])) {
                    throw new Exception("Paquete '$package' no válido.");
                }
                $stmt = $this->conexion->prepare("INSERT INTO user_packages (user_id, package) VALUES (?, ?)");
                $stmt->execute([$userId, $package]);
            }
        }
    }

    public function delete($userId) {
        $stmt = $this->conexion->prepare("DELETE FROM user_packages WHERE user_id = ?");
        $stmt->execute([$userId]);
    }

    public function getPackages($userId) {
        $stmt = $this->conexion->prepare("SELECT package FROM user_packages WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function removePackage($userId, $package) {
        $stmt = $this->conexion->prepare("DELETE FROM user_packages WHERE user_id = ? AND package = ?");
        $stmt->execute([$userId, $package]);
    }

    public function getPackageByName($userId, $package) {
        $stmt = $this->conexion->prepare("SELECT package FROM user_packages WHERE user_id = ? AND package = ?");
        $stmt->execute([$userId, $package]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
}
?>