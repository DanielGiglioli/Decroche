<?php

function cargarProductosCliente(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarProducto();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
            if ($f['stock'] >= 1) {
                $foto = substr($f['foto'], 6); // Elimina los primeros seis caracteres de la URL de la foto
            echo '
            <div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
                        <img src="'.$foto.'"> <!-- Utiliza la variable $foto modificada -->
						<div class="preview-meta">
                            <h5 class="card-title">'.$f['nombre'].'</h5>
                            <a href="detalle-producto.html" class="btn btn-primary">IR</a>
                            
                        </div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">'.$f['nombre'].'</a></h4>
						<p class="price">'.number_format($f['precio'], 0  ,'', '.').'</p>
					</div>
				</div>
			</div>
            ';
            }
        }
    }
}

function cargarProductosCliente2(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarProducto();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
            if ($f['stock']>= 1) {
                $foto = substr($f['foto'], 6);
            // Elimina los primeros seis caracteres de la URL de la foto
            if($f['estado'] == "Inactivo"){

            }else{
                $id_producto = $f['id_pro'];

                echo '
                
                <div class="col-md-6 col-lg-6 col-xl-3" style="margin-bottom:30px">
                <div class="text-center">
                <a href="./Views/extras/detalleProducto.php?id=' . $f['id_pro'] . '"><img src="'.$foto.'" class="img-fluid rounded" alt="" style="height: 200px; object-fit:cover"></a>
                    <div class="py-2">
                        <a href="./Views/extras/detalleProducto.php?id=' . $f['id_pro'] . '" class="h5">'.$f['nombre'].'</a>';
                        mostrarCalificacionIndex($id_producto);
                        echo'
                        <h4 class="mb-3">'.number_format($f['precio'], 0  ,'', '.').' $</h4>
                        <a href="./Views/extras/detalleProducto.php?id=' . $f['id_pro'] . '" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Ver detalles</a>
                    </div>
                </div>
            </div>';
            }
            }
        
            
                
        }
    }

    
}

function mostrarCalificacionIndex($id_producto){
    $objConsultas = new Consultas();
    $result = $objConsultas->mostrarCalificacionIndex($id_producto);

    if(!isset($result)){
    } else {
        foreach ($result as $f) {
            $cantidad_estrellas = $f['suma_calificaciones'];
            $votos = $f['cantidad_votos'];

            
           if($votos == 0){
            
            echo'
                <div class="d-flex my-3 justify-content-center">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star "></i>
                </div>
                ';
           }else{
            $total = $cantidad_estrellas / $votos;
            if($total >= 4.5){
                echo '
                <div class="d-flex my-3 justify-content-center">
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                </div>
                    ';
            } else if($total >= 4 && $total < 4.5){
                echo '
                <div class="d-flex my-3 justify-content-center">
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star "></i>
                </div>
                    ';
            } else if($total >= 3 && $total < 3.9){
                echo '
                <div class="d-flex my-3 justify-content-center">
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                    ';
            } else if($total >= 1.5 && $total < 2.9){
                echo '
                <div class="d-flex my-3 justify-content-center">
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                ';
            } else {
                echo '
                <div class="d-flex my-3 justify-content-center">
                    <i class="fa fa-star text-secondary"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                    ';
            }
           }
           
            
        }
    }
}
?>



