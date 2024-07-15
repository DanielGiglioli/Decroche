<?php 

    class ConsultasAdmin{

        public function registrarUser($identificacion,$nombres,$apellidos,$email,$claveMD,$rol,$estado,$telefono,$fecha_creacion,$rutaFoto){

                //Creamos el objeto de la clase conexion
                $objConexion = new Conexion();
                $conexion = $objConexion->get_conexion();
        
                
                
                
                //Guardamos la variable en la consulta MSQL a ejecutar
                $insertar = "INSERT INTO users(documento,nombres,apellidos,email,clave,rol,estado,telefono,fecha_creacion,foto) VALUES(:identificacion,:nombres,:apellidos,:email,:clave,:rol,:estado,:telefono,:fecha_creacion,:foto)";


        
                $result = $conexion->prepare($insertar);
        
                $result->bindParam(':identificacion',$identificacion);
                $result->bindParam(':nombres',$nombres);
                $result->bindParam(':apellidos',$apellidos);
                $result->bindParam(':email',$email);
                $result->bindParam(':clave',$claveMD);
                $result->bindParam(':rol',$rol);
                $result->bindParam(':estado',$estado);
                $result->bindParam(':telefono',$telefono);
                $result->bindParam(':fecha_creacion',$fecha_creacion);
                $result->bindParam(':foto',$rutaFoto);
        
                $result->execute();
        
                echo '<script>alert("Registro Exitoso")</script>';
                echo '<script> location.href="../../Views/administrador/registrarUser.php" </script>';
        
        
            }

        public function consultarUsers(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM users ORDER BY id";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }

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

        public function facturasUser($id_usuario){

            $f = null;
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $consultar = "SELECT f.id_factura, f.nombre , f.fecha_emision, f.total, p.nombre AS nombre_producto, d.cantidad, d.subtotal, tp.direccion_facturacion, tp.correo, tp.numero_cel, tp.ciudad, p.foto
            FROM factura f 
            INNER JOIN detalle_factura d ON f.id_factura = d.id_factura
            INNER JOIN products p ON d.id_producto = p.id_pro 
            INNER JOIN detalles_envio tp ON f.id_factura = tp.id_factura WHERE f.id_usuario = :id_usuario;";
        
            $result = $conexion->prepare($consultar);
        
            $result->bindParam(':id_usuario', $id_usuario);
        
            $result->execute();
        
            if ($result->rowCount() > 0) {
                while ($resultado = $result->fetch()) {
                    $f[] = $resultado;
                }
                return $f;
            }
            return null; // Retornar null si no hay resultados
        }
        
        public function crearFactura($id_factura){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT f.id_factura, f.nombre , f.fecha_emision,f.numero_factura , f.total, p.nombre AS nombre_producto, d.cantidad, d.subtotal,tp.direccion_facturacion, tp.correo, tp.numero_cel,  tp.ciudad
            FROM factura f 
            INNER JOIN detalle_factura d ON f.id_factura = d.id_factura
            INNER JOIN products p ON d.id_producto = p.id_pro 
            INNER JOIN detalles_envio tp ON f.id_factura = tp.id_factura WHERE f.id_factura = :id_factura;";

            $result = $conexion->prepare($consultar);

            $result->bindParam(':id_factura',$id_factura);

            $result->execute();


            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }
        public function productosFactura($id_factura){

            $f = null;
        
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            $consultar = "SELECT f.id_factura, f.total, p.nombre AS nombre_producto, d.cantidad, d.subtotal FROM factura f INNER JOIN detalle_factura d ON f.id_factura = d.id_factura INNER JOIN products p ON d.id_producto = p.id_pro where f.id_factura = :id_factura";
        
            $productos = $conexion->prepare($consultar);
        
            $productos->bindParam(':id_factura', $id_factura);
        
            $productos->execute();
        
            if ($productos->rowCount() > 0) {
                while ($resultado = $productos->fetch()) {
                    $f[] = $resultado;
                }
                return $f;
            }
            return null;
        }
        
        

        public function foto($id){

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
       
        

        public function eliminarUser($id){
            $objconexion = new conexion ();
            $conexion = $objconexion -> get_conexion();

            $eliminar = "DELETE FROM users WHERE id=:id";
            $result = $conexion ->prepare($eliminar);

            $result->bindParam(':id', $id); 

            $result->execute();

            echo "<script> alert('Producto Eliminado exitosamente')</script>";
            echo "<script> location.href='../../Views/administrador/verUsers.php'</script>";
        }

        public function modificarUser($identificacion,$nombres,$apellidos,$email,$claveMD,$rol,$estado,$telefono,$fecha_creacion,$rutaFoto){
            $objconexion = new conexion();
            $conexion = $objconexion->get_conexion();

            $actualizar = "UPDATE users SET nombres=:nombre, categoria=:categoria, cantidad=:cantidad, precio=:precio, descripcion=:descripcion, estado=:estado WHERE codigo=:codigo";

            $result= $conexion-> prepare($actualizar);
            $result ->bindParam(":codigo", $cod);
            $result ->bindParam(":nombre", $nombre);
            $result ->bindParam(":categoria", $categoria);
            $result ->bindParam(":cantidad", $cantidad);
            $result ->bindParam(":descripcion", $descripcion);
            $result ->bindParam(":precio", $precio);
            $result ->bindParam(":estado", $estado);

            $result->execute();

            echo "<script> alert('Producto actualizado con exito')</script>";
            echo "<script> location.href='../Views/consultar-productos.php'</script>";
        }

        public function registrarProduct($nombre, $categoria, $precio, $proveedor, $rutaFoto, $rutaFoto2, $rutaFoto3 ,$fecha_creacion, $estado, $id_vendedor) {
            // Creamos el objeto de la clase conexion
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
        
            // Guardamos la variable en la consulta SQL a ejecutar
            $insertar = "INSERT INTO products (nombre, categoria, precio, proveedor, foto, fecha_creacion, estado, id_vendedor, foto2, foto3) 
                         VALUES (:nombre, :categoria, :precio, :proveedor, :foto, :fecha_creacion, :estado, :id_vendedor, :foto2, :foto3)";
        
            $result = $conexion->prepare($insertar);
        
            $result->bindParam(':nombre', $nombre);
            $result->bindParam(':categoria', $categoria);
            $result->bindParam(':precio', $precio);
            $result->bindParam(':proveedor', $proveedor);
            $result->bindParam(':foto', $rutaFoto);
            $result->bindParam(':foto2', $rutaFoto2);
            $result->bindParam(':foto3', $rutaFoto3);
            $result->bindParam(':fecha_creacion', $fecha_creacion);
            $result->bindParam(':estado', $estado);
            $result->bindParam(':id_vendedor', $id_vendedor);
        
            $result->execute();
        
            echo '<script>alert("Registro Exitoso")</script>';
            echo '<script>location.href="../../Views/administrador/registrarProduct.php"</script>';
        }

        public function consultarProduct(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM products ORDER BY id_pro";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }
        public function consultarProductMini(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT count(*) as total FROM products ";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }
        public function constularVentasMini(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT count(*) as total FROM factura ";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }
        public function constularUsersMini(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT count(*) as total FROM users ";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }

        public function consultarRueda(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT COUNT(detalle_factura.id_producto) as ventas, products.nombre
            FROM detalle_factura
            INNER JOIN products ON detalle_factura.id_producto = products.id_pro
            GROUP BY detalle_factura.id_producto, products.nombre
            HAVING COUNT(detalle_factura.id_producto) > 10;";

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
            echo "<script> location.href='../../Views/administrador/verProduct.php'</script>";
        }

        public function cargarProveedor(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT nombres FROM users where rol = 'Proveedor' ";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;
            }return $f;

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
            echo '<script> location.href="../../Views/administrador/profile.php "</script>';
                // Redireccionar al usuario a la página de visualización de usuarios después de la edición

            
        }

        public function modificarUsers2($id, $nombres, $apellidos, $email, $telefono) {

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
            echo '<script> location.href="../../Views/user/profileUser.php"</script>';
                // Redireccionar al usuario a la página de visualización de usuarios después de la edición

            
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
            echo '<script> location.href="../../Views/administrador/profile.php "</script>';

            }else{
                echo "<script>alert('Las contraseñas no coinciden');</script>";
            echo '<script> location.href="../../Views/administrador/profile.php "</script>';
            }
            
    
    
        }
        public function cambiarClaveUsers($id, $newClave, $claveCrip){

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
            echo '<script> location.href="../../Views/user/profileUser.php "</script>';

            }else{
                echo "<script>alert('Las contraseñas no coinciden');</script>";
            echo '<script> location.href="../../Views/user/profileUser.php "</script>';
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
            echo '<script> location.href="../../Views/administrador/profile.php "</script>';
                // Redireccionar al usuario a la página de visualización de usuarios después de la edición

            
        }
        public function cambiarFotoUser($id, $foto) {

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
            echo '<script> location.href="../../Views/user/profileUser.php"</script>';
                // Redireccionar al usuario a la página de visualización de usuarios después de la edición

            
        }

        public function consultarPqr(){

            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT * FROM pqr_servicios ORDER BY fecha";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

        }
        

        public function editarPqr($id_servicios){

    
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
    
            $consultar = "SELECT * FROM pqr_servicios WHERE id_servicios = :id_servicios";
    
            $result = $conexion->prepare($consultar);
            $result-> bindParam('id_servicios', $id_servicios);
    
            $result->execute();
    
            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato
    
            if ($result->rowCount() > 0) {
                // Obtener los detalles de la consulta como un objeto asociativo
                $datos = $result->fetch(PDO::FETCH_ASSOC);
                // Convertir los datos a JSON y enviarlos
                echo json_encode($datos);
            } else {
                echo 'fallo';
            }
    
        }
        public function editarProducto($id_pro){

    
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
    
            $consultar = "SELECT * FROM products WHERE id_pro = :id_pro";
    
            $result = $conexion->prepare($consultar);
            $result-> bindParam('id_pro', $id_pro);
    
            $result->execute();
    
            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato
    
            if ($result->rowCount() > 0) {
                // Obtener los detalles de la consulta como un objeto asociativo
                $datos = $result->fetch(PDO::FETCH_ASSOC);
                // Convertir los datos a JSON y enviarlos
                echo json_encode($datos);
            } else {
                echo 'fallo';
            }
    
        }

        public function editarUsuario($id){

    
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
    
            $consultar = "SELECT * FROM users WHERE id = :id";
    
            $result = $conexion->prepare($consultar);
            $result-> bindParam('id', $id);
    
            $result->execute();
    
            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato
    
            if ($result->rowCount() > 0) {
                // Obtener los detalles de la consulta como un objeto asociativo
                $datos = $result->fetch(PDO::FETCH_ASSOC);
                // Convertir los datos a JSON y enviarlos
                echo json_encode($datos);
            } else {
                echo 'fallo';
            }
    
        }


        public function actualizarPqr($num_servicio, $estado, $respuesta){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $actualizar= "UPDATE pqr_servicios SET estado = :estado, respuesta = :respuesta WHERE num_servicio=:num_servicio";
            
            $result= $conexion-> prepare($actualizar);
            $result ->bindParam(":num_servicio", $num_servicio);
            $result ->bindParam(":estado", $estado);
            $result ->bindParam(":respuesta", $respuesta);

            $result->execute();
    
            echo 'exito';
   
       }
       public function actualizarProducto($id_pro, $nombre, $estado, $categoria, $precio, $proveedor ){

        $objConexion = new Conexion();
        $conexion = $objConexion->get_conexion();

        $actualizar= "UPDATE products SET nombre=:nombre, estado = :estado, categoria = :categoria, precio = :precio, proveedor=:proveedor WHERE id_pro=:id_pro";
        
        $result= $conexion-> prepare($actualizar);
        $result ->bindParam(":id_pro", $id_pro);
        $result ->bindParam(":nombre", $nombre);
        $result ->bindParam(":estado", $estado);
        $result ->bindParam(":categoria", $categoria);
        $result ->bindParam(":precio", $precio);
        $result ->bindParam(":proveedor", $proveedor);

        $result->execute();

        echo 'exito';

    }

   public function actualizarUsuario($id,$rol, $nombres,$apellidos, $email,$telefono,$estado){

    $objConexion = new Conexion();
    $conexion = $objConexion->get_conexion();

    $actualizar= "UPDATE users SET rol=:rol,nombres=:nombres,apellidos =:apellidos, email=:email,telefono=:telefono,estado = :estado WHERE id=:id";
    
    $result= $conexion-> prepare($actualizar);
    $result ->bindParam(":id", $id);
    $result ->bindParam(":rol", $rol);
    $result ->bindParam(":nombres", $nombres);
    $result ->bindParam(":apellidos", $apellidos);
    $result ->bindParam(":email", $email);
    $result ->bindParam(":telefono", $telefono);
    $result ->bindParam(":estado", $estado);

    $result->execute();

    echo 'exito';

}


       public function consultarCompra(){



            $f = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $consultar = "SELECT f.id_factura, f.nombre , f.fecha_emision, f.total, p.nombre AS nombre_producto, d.cantidad, d.subtotal, tp.direccion_facturacion, tp.correo, tp.numero_cel, tp.ciudad
            FROM factura f 
            LEFT JOIN detalle_factura d ON f.id_factura = d.id_factura
            LEFT JOIN products p ON d.id_producto = p.id_pro 
            LEFT JOIN detalles_envio tp ON f.id_factura = tp.id_factura ORDER BY f.fecha_emision";

            $result = $conexion->prepare($consultar);

            $result->execute();

            //Al hacer una consulta para mostrar informacion necesitamos convertir el resultado en un arreglo para poder segmentar dato por dato

            while ($resultado = $result->fetch()) {
                $f[]= $resultado;


            }return $f;

    }
        
        
    }






?>