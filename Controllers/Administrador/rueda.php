<?php
function cargarRueda(){
    $objConsultas = new ConsultasAdmin();
    $result = $objConsultas->consultarRueda();

    if (!isset($result)) {
        echo "<h2>No hay productos registrados</h2>";
    } else {
        $data = array(); // Inicializar el arreglo de datos
        foreach ($result as $f) {
            $color = '#' . substr(md5($f["nombre"]), 0, 6); // Generar un color único basado en el nombre del producto
            $data[] = array(
                "value" => $f["ventas"],
                "label" => $f["nombre"],
                "color" => $color // Asignar un color único al producto
            );
        }
        return $data; // Devolver los datos
    }
}
$datosProductos = cargarRueda();

?>

<script>
    // Define una variable global en JavaScript para almacenar los datos obtenidos en PHP
    var datosProductos = <?php echo json_encode($datosProductos); ?>;
</script>