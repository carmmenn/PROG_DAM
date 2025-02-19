<?php
$titulo = $_GET['titulo'] ?? '';

// 1. Configuración: Definimos el puerto y construimos la URL local.
// Dado que LM Studio se ejecuta en local, usamos 'localhost'.
// Asegúrate de que LM Studio esté corriendo en el puerto 8000.
$puerto = '1234';
$url = "http://localhost:$puerto/v1/chat/completions";  // Asegúrate de que este endpoint coincide con el expuesto por LM Studio.

// 2. Preparar los datos a enviar.
// Creamos un array con la información que queremos enviar al modelo.
// En este ejemplo, enviamos un mensaje (prompt) y configuramos un parámetro como el número máximo de tokens.

$datos = array(
    "model"=> "llama-3.2-1b-instruct",
    "messages"=> 
    array(
        array("role"=> "system", "content"=> "Responde siempre en español"),
        array("role"=> "user", "content"=> "Dime un ingrediente que se usa para hacer $titulo?"),
        array("role"=> "user", "content"=> "¿Cómo se elabora $titulo? Responde con una frase.")
    ),
    "temperature"=> 1,
    "max_tokens"=> 100,
    "stream"=> false
);

// Convertir el array a formato JSON.
$jsonDatos = json_encode($datos);

// 3. Inicializar cURL para preparar la petición.
$ch = curl_init($url);

// 4. Configurar cURL:
// - Establecemos que usaremos el método POST.
// - Indicamos que la respuesta se guarde en una variable en lugar de mostrarse directamente.
// - Enviamos el cuerpo de la petición con nuestros datos en formato JSON.
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatos);

// 5. Configurar las cabeceras HTTP necesarias.
// Es fundamental indicar que el contenido enviado es de tipo JSON.
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonDatos)
));

// 6. Ejecutar la petición y capturar la respuesta del servidor.
$respuesta = curl_exec($ch);

// 7. Comprobar si se produjo algún error en la comunicación.
if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
} else {
    // Decodificamos el JSON
    $data = json_decode($respuesta, true);

    // Accedemos al contenido del mensaje
    $ingredientes = isset($data['choices'][0]['message']['content']) ? $data['choices'][0]['message']['content'] : 'No se encontraron ingredientes.';
    $elaboracion = isset($data['choices'][1]['message']['content']) ? $data['choices'][1]['message']['content'] : 'No se encontró la elaboración.';

    // Mostramos el mensaje
    echo json_encode(["ingredientes" => $ingredientes, "elaboracion" => $elaboracion]);
}

// 8. Cerrar la sesión cURL para liberar recursos.
curl_close($ch);
?>
