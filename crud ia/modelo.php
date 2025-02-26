<?php
class IaModel {
    private $puerto = '1234';
    private $url;

    public function __construct() {
        $this->url = "http://localhost:$this->puerto/v1/chat/completions";
    }

    private function obtenerRespuesta($mensaje) {
        $datos = array(
            "model"=> "llama-3.2-1b-instruct",
            "messages"=> 
            array(
                array("role"=> "system", "content"=> "Responde siempre en español"),
                array("role"=> "user", "content"=> $mensaje)
            ),
            "temperature"=> 1,
            "max_tokens"=> 100,
            "stream"=> false
        );

        $jsonDatos = json_encode($datos);
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatos);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonDatos)
        ));

        $respuesta = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error en cURL: ' . curl_error($ch);
            return null;
        } else {
            $data = json_decode($respuesta, true);
            return isset($data['choices'][0]['message']['content']) ? $data['choices'][0]['message']['content'] : 'No se encontró respuesta.';
        }

        curl_close($ch);
    }

    public function obtenerIngredientes($titulo) {
        return $this->obtenerRespuesta("Dime los ingredientes que se usan para hacer $titulo?");
    }

    public function obtenerElaboracion($titulo) {
        return $this->obtenerRespuesta("¿Cómo se elabora $titulo? Responde con una frase.");
    }
}

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
