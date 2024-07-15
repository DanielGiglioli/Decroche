<?php
// Incluir el archivo que contiene la función get_conexion() si está en otro archivo
// include 'ruta/a/tu/funcion/get_conexion.php';

// Esta función debería estar definida en algún lugar del código para obtener la instancia de conexión a la base de datos
function get_conexion(){
    $user = "root";
    $pass = "";
    $host = "localhost";
    $dbname = "decroche";

    $conexion = new PDO("mysql:host=$host;dbname=$dbname;",$user, $pass);
    return $conexion;
}

header('Content-Type: application/json'); // Establecer el encabezado para indicar que la respuesta es JSON

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar si se proporciona un ID de usuario en la solicitud GET
    if(isset($_GET['id'])) {
        // Obtener el ID de usuario de la solicitud GET
        $userId = $_GET['id'];
        
        // Obtener los datos del formulario
        $rol = $_GET['rol'];
        $nombres = $_GET['nombres'];
        $apellidos = $_GET['apellidos'];
        $email = $_GET['email'];
        $telefono = $_GET['telefono'];
        $estado = $_GET['estado'];
        
        // Obtener otros campos del formulario de manera similar

        try {
            // Obtener una conexión a la base de datos
            $conexion = get_conexion();

            // Preparar la consulta para actualizar los detalles del usuario por su ID
            $consulta = $conexion->prepare("UPDATE users SET rol = :rol, nombres = :nombres, apellidos = :apellidos, email = :email, telefono = :telefono, estado = :estado WHERE id = :id");


            // Asignar los valores de los campos a la consulta

            // Asignar los valores de los campos a la consulta
            $consulta->bindParam(':id', $userId, PDO::PARAM_INT);
            $consulta->bindParam(':rol', $rol, PDO::PARAM_STR);
            $consulta->bindParam(':nombres', $nombres, PDO::PARAM_STR);
            $consulta->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $consulta->bindParam(':email', $email, PDO::PARAM_STR);
            $consulta->bindParam(':telefono', $telefono, PDO::PARAM_INT);
            $consulta->bindParam(':estado', $estado, PDO::PARAM_STR);
            // Ejecutar la consulta
            $consulta->execute();

            // Envía una respuesta JSON indicando el éxito del proceso
            echo json_encode(array("success" => true, "message" => "Cambios guardados exitosamente"));
        } catch(PDOException $e) {
            // Si ocurre un error durante la consulta, envía una respuesta JSON con el mensaje de error
            echo json_encode(array("success" => false, "message" => "Error al guardar cambios en la base de datos: " . $e->getMessage()));
        }
    } else {
        // Si no se proporciona un ID de usuario en la solicitud GET, devuelve un mensaje de error
        echo json_encode(array("success" => false, "message" => "ID de usuario no especificado"));
    }
} else {
    // Si la solicitud no es de tipo GET, devuelve un mensaje de error
    echo json_encode(array("success" => false, "message" => "La solicitud no es de tipo GET"));
}
?>
