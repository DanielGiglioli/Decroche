<?php   
function generarDetalle(){
    //capturamos en variables enviados desde el formulario a traves del metodo post y los nombres de los campos
    
        $id_producto = $_GET['id'];
    
    
     // creamos el objeto apartir de la clase consultas para enviar los datos a una funcion en especifico
        $objConsultas = new Consultas();
        $result = $objConsultas->generarDetalle($id_producto);
    
        if(!isset($result)){
            echo "<h2>No hay productos registrados</h2>";
        } else {
            foreach ($result as $f) {
                $foto = !empty($f['foto']) ? htmlspecialchars($f['foto']) : null;
                $foto2 = !empty($f['foto2']) ? htmlspecialchars($f['foto2']) : null;
                $foto3 = !empty($f['foto3']) ? htmlspecialchars($f['foto3']) : null;

                $fotoCount = 0;
                if ($foto) $fotoCount++;
                if ($foto2) $fotoCount++;
                if ($foto3) $fotoCount++;
                
                echo '
    
                <div class="row g-4">
                                <div class="col-lg-6">

                                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner border rounded">';

                                    if ($foto) {
                                        echo '
                                        
                                        <div class="carousel-item active ">
                                                <img src="'.$foto.'" class="d-block w-100 imagen-p" alt="Producto"  >
                                              </div>';
                                    }
                                    if ($foto2) {
                                        echo '<div class="carousel-item">
                                                <img src="'.$foto2.'" class="d-block w-100 imagen-p" alt="Producto" >
                                              </div>';
                                    }
                                    if ($foto3) {
                                        echo '<div class="carousel-item">
                                                <img src="'.$foto3.'" class="d-block w-100 imagen-p" alt="Producto"  >
                                              </div>';
                                    }
                                    echo '

                                    </div>
                                    ';
                                    if ($fotoCount > 1) {
                                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                  <span class="visually-hidden">Previous</span>
                                              </button>
                                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                  <span class="visually-hidden">Next</span>
                                              </button>';
                                    }
                                echo'
                                  </div>



                        
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="fw-bold mb-3">'.$f['nombre'].'</h4>
                                    <p class="mb-3">Categoria:'.$f['categoria'].'</p>
                                    <h5 class="fw-bold mb-3">'.number_format($f['precio'], 0  ,'', '.').' $</h5>
                                    <h6 class="fw-bold mb-3"><strong>'.$f['stock'].'</strong> cantidades disponibles</h6>';
                                    


                                mostrarCalificacion();
                                echo '
                                    
                                    <p class="mb-4">'.$f['descripcion'].'</p>

                                    <p class="mb-4">Vendido por: <strong>'.$f['proveedor'].'</strong></p>';

                                    
                                    if ($f['stock'] >= 1) {
                                        echo '<form action="" method="post">
                                        <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                                        <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                                        <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                                        <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                                        <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                                        <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys" ></i > Añadir al carrito</a> 
                                    </form>';
                                    }
                                echo'
                                    
                                </div>
                </div>
                
                ';
            }
        }
}

function mostrarCalificacion(){
    $id_producto = $_GET['id'];
    $objConsultas = new Consultas();
    $result = $objConsultas->mostrarCalificacion($id_producto);

    if(!isset($result)){
    } else {
        foreach ($result as $f) {
            $cantidad_estrellas = $f['suma_calificaciones'];
            $votos = $f['cantidad_votos'];

            
           if($votos == 0){
            echo'<i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star "></i>';
           }else{
            $total = $cantidad_estrellas / $votos;
            if($total >= 4.5){
                echo '<i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>';
            } else if($total >= 4 && $total < 4.5){
                echo '<i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star "></i>';
            } else if($total >= 3 && $total < 3.9){
                echo '<i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';
            } else if($total >= 1.5 && $total < 2.9){
                echo '<i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';
            } else {
                echo '<i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>';
            }
           }
           
            
        }
    }
}
// importamos las dependencias

?>