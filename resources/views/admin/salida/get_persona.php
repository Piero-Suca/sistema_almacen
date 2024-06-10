<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salle_bibi3";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cod_persona'])) {
    $cod_persona = $_GET['cod_persona'];

    // Preparar la consulta SQL
    $stmt = $conn->prepare("SELECT nombres, apellidos FROM persona WHERE cod_persona = ?");
    $stmt->bind_param("s", $cod_persona);

    // Ejecutar la consulta
    $stmt->execute();
    $stmt->bind_result($nombres, $apellidos);

    // Verificar si se encontró el registro
    if ($stmt->fetch()) {
        $response = [
            'success' => true,
            'nombres' => $nombres,
            'apellidos' => $apellidos
        ];
    } else {
        $response = ['success' => false];
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    $response = ['success' => false, 'message' => 'cod_persona no proporcionado o método incorrecto'];
}

// Cerrar la conexión
$conn->close();

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
