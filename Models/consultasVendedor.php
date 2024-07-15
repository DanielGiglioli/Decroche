<?php
class ConsultasVendedor{


    public function perfilUser($id){

        $f = null;

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $consultar = "SELECT * FROM users WHERE id=:id";

        $result = $conexion->prepare($consultar);

        $result->bindParam(':id',$id);

        $result->execute();

        //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

        while ($resultado = $result->fetch()) {
            $f[]= $resultado;


        }return $f;

    }






    public function consultarProduct(){
        $id = $_SESSION['id'];
        $f = null;

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $consultar = "SELECT * FROM products where id_vendedor = $id";

        $result = $conexion->prepare($consultar);

        $result->execute();

        //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

        while ($resultado = $result->fetch()) {
            $f[]= $resultado;


        }return $f;

    }
    
    







    public function cambiarClave($id, $newClave, $claveCrip){

        //Creamos el objeto de la clase conexion
        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();


        $consultar= "SELECT * FROM users WHERE id=:id";
        $result = $conexion->prepare($consultar);
        $result->bindParam(':id',$id);
        $result->execute();

        $f = $result->fetch();

        if ($claveCrip == $f['clave']) {
            $actualizarPass = "UPDATE users SET clave=:newClave WHERE id=:id";
            $result = $conexion->prepare($actualizarPass);
            $result->bindParam(':id', $id);
            $result->bindParam(':newClave', $newClave);
            $result->execute();

        echo "<script>alert('Contraseña editada correctamente');</script>";
        echo '<script> location.href="../../Views/vendedor/profile.php "</script>';

        }else{
            echo "<script>alert('Las contraseñas no coinciden');</script>";
        echo '<script> location.href="../../Views/vendedor/profile.php "</script>';
        }
        


    }


    public function cambiarFoto($id, $foto) {

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();
    
        // Preparar la consulta SQL con parámetros vinculados
        $actualizarUser = "UPDATE users SET foto=:foto WHERE id = :id";
        $result = $conexion->prepare($actualizarUser);
        $result->bindParam(':id', $id);
        $result->bindParam(':foto', $foto);
        $result->execute();
    
            // La consulta se ejecutó correctamente, mostrar mensaje de éxito
        echo "<script>alert('Se edito tu foto exitosamente');</script>";
        echo '<script> location.href="../../Views/vendedor/profile.php "</script>';
            // Redireccionar al usuario a la página de visualización de usuarios después de la edición

        
    }

    public function modificarUsers($id, $nombres, $apellidos, $email, $telefono) {

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();
    
        // Preparar la consulta SQL con parámetros vinculados
        $actualizarUser = "UPDATE users SET  nombres=:nombres, apellidos=:apellidos, email=:email, telefono=:telefono WHERE id = :id";
        $result = $conexion->prepare($actualizarUser);
        $result->bindParam(':id', $id);
        $result->bindParam(':nombres', $nombres);
        $result->bindParam(':apellidos', $apellidos);
        $result->bindParam(':email', $email);
        $result->bindParam(':telefono', $telefono);
        $result->execute();
    
            // La consulta se ejecutó correctamente, mostrar mensaje de éxito
        echo "<script>alert('Usuario editado correctamente');</script>";
        echo '<script> location.href="../../Views/vendedor/profile.php "</script>';
            // Redireccionar al usuario a la página de visualización de usuarios después de la edición

        
    }

    public function registrarProduct($nombre, $categoria, $precio, $proveedor, $rutaFoto,$rutaFoto2, $rutaFoto3, $fecha_creacion,$estado, $id_vendedor, $stock){
        //Creamos el objeto de la clase conexion
        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        
        
        
        //Guardamos la variable en la consulta MSQL a ejecutar
        $insertar = "INSERT INTO products(nombre,categoria,precio,proveedor,foto,fecha_creacion,estado, id_vendedor, foto2, foto3, stock) VALUES(:nombre,:categoria,:precio,:proveedor,:foto,:fecha_creacion,:estado,:id_vendedor, :foto2, :foto3, :stock)";



        $result = $conexion->prepare($insertar);

        $result->bindParam(':nombre',$nombre);
        $result->bindParam(':categoria',$categoria);
        $result->bindParam(':precio',$precio);
        $result->bindParam(':proveedor',$proveedor);
        $result->bindParam(':foto',$rutaFoto);
        $result->bindParam(':foto2',$rutaFoto2);
        $result->bindParam(':foto3',$rutaFoto3);
        $result->bindParam(':fecha_creacion',$fecha_creacion);
        $result->bindParam(':estado',$estado);
        $result->bindParam(':stock',$stock);
        $result->bindParam(':id_vendedor',$id_vendedor);

        $result->execute();

        echo '<script>alert("Registro Exitoso")</script>';
        echo '<script> location.href="../../Views/vendedor/registrarProduct.php" </script>';


    }
    public function cargarProveedor(){
        $id = $_SESSION['id'];
        $f = null;

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $consultar = "SELECT nombres FROM users where id = $id AND rol = 'Vendedor' ";

        $result = $conexion->prepare($consultar);

        $result->execute();

        //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

        while ($resultado = $result->fetch()) {
            $f[]= $resultado;
        }return $f;

    }
    
    public function eliminarProduct($id_pro){
        $objconexion = new conexion ();
        $conexion = $objconexion -> get_conexion();


        $eliminarDetalles = "DELETE FROM detalles_pedido WHERE id_pro = :id_pro";
        $resultDetalles = $conexion->prepare($eliminarDetalles);
        $resultDetalles->bindParam(':id_pro', $id_pro);
        $resultDetalles->execute();

        // Ahora eliminar el producto
        $eliminarProducto = "DELETE FROM products WHERE id_pro = :id_pro";
        $resultProducto = $conexion->prepare($eliminarProducto);
        $resultProducto->bindParam(':id_pro', $id_pro);
        $resultProducto->execute();





        echo "<script> alert('Producto Eliminado exitosamente')</script>";
        echo "<script> location.href='../../Views/vendedor/verProduct.php'</script>";
    }
    public function valorTotalProducto($id_vendedor){

        $f = null;

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $consultar = "SELECT COUNT(id_producto) as ventas, products.nombre, SUM(detalle_factura.id_producto + products.precio) as total_vendido, products.categoria, products.precio  FROM detalle_factura inner join products on detalle_factura.id_producto = products.id_pro where products.id_vendedor = :id_vendedor GROUP by detalle_factura.id_producto ";

        $result = $conexion->prepare($consultar);

        $result->bindParam(':id_vendedor',$id_vendedor);

        $result->execute();

        //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

        while ($resultado = $result->fetch()) {
            $f[]= $resultado;


        }return $f;

    }

    public function actualizarProducto($id_pro, $nombre, $estado, $categoria, $precio, $proveedor, $stock ){

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $actualizar= "UPDATE products SET nombre=:nombre, estado = :estado, categoria = :categoria, precio = :precio, proveedor=:proveedor, stock=:stock WHERE id_pro=:id_pro";
        
        $result= $conexion-> prepare($actualizar);
        $result ->bindParam(":id_pro", $id_pro);
        $result ->bindParam(":nombre", $nombre);
        $result ->bindParam(":estado", $estado);
        $result ->bindParam(":categoria", $categoria);
        $result ->bindParam(":precio", $precio);
        $result ->bindParam(":proveedor", $proveedor);
        $result ->bindParam(":stock", $stock);

        $result->execute();

        echo 'exito';
    }
    
}
?>