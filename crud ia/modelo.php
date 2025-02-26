<?php
class Modelo {
    private $archivo = "recetas.json";

    private function leerBD() {
        if (!file_exists($this->archivo)) {
            return ["recetas" => []];
        }
        return json_decode(file_get_contents($this->archivo), true);
    }

    private function guardarBD($data) {
        file_put_contents($this->archivo, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function obtenerRecetas() {
        return $this->leerBD()["recetas"];
    }

    public function agregarReceta($titulo, $ingredientes, $elaboracion) {
        $data = $this->leerBD();
        $id = count($data["recetas"]) + 1;
        $data["recetas"][] = [
            "id" => $id,
            "titulo" => $titulo,
            "ingredientes" => $ingredientes,
            "elaboracion" => $elaboracion
        ];
        $this->guardarBD($data);
    }

    public function eliminarReceta($id) {
        $data = $this->leerBD();
        $data["recetas"] = array_filter($data["recetas"], fn($receta) => $receta["id"] != $id);
        $this->guardarBD($data);
    }
}
?>
