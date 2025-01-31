<?php
require_once 'db.php';

class User {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConnection();
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data) {
        $query = "INSERT INTO users (name, email, age, base_plan, subscription_duration) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['age'],
            $data['base_plan'],
            $data['subscription_duration']
        ]);
        return $this->conexion->lastInsertId();
    }

    public function updateUser($id, $data) {
        $query = "UPDATE users SET name = ?, email = ?, age = ?, base_plan = ?, subscription_duration = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['age'],
            $data['base_plan'],
            $data['subscription_duration'],
            $id
        ]);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$id]);
    }
}
?>