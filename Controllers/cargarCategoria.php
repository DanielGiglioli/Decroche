<?php

function cargarProductosCategoria(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarCategoriaRopa();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
           if ($f['stock']>=1) {
            $id_producto = $f['id_pro'];
            $foto = substr($f['foto'], 0); // Elimina los primeros seis caracteres de la URL de la foto
            echo '

        <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="rounded position-relative fruite-item">

            <div class="fruite-img">

                <a href="./detalleProducto.php?id='.$f['id_pro'].'">
                    <img src="'.$foto.'" class="img-fluid w-100 rounded-top" alt="" style="height: 260px; object-fit:cover">
                </a>
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Ropa</div>';
            cargarVentasProducto($id_producto);
            echo'
            <div class="p-4 border border-secondary-r border-top-0 rounded-bottom">
                <h4>'.$f['nombre'].'</h4>
                <p>'.$f['descripcion'].'...</p>
                <div class="d-flex justify-content-between flex-lg-wrap">
                


                <form action="" method="post">
                    <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                    <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                    <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                    <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                    <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                    <p class="text-dark fs-5 fw-bold mb-0">'.number_format($f['precio'], 0  ,'', '.').'</p>
                    <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys" ></i > Añadir al carrito</a> 
                </form>


                </div>
            </div>
        </div>
    </div>
                
            ';
           }
        }
    }
}

function cargarProductosCategoriaRopa(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarCategoriaRopa();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
           if ($f['stock']>= 1) {
            $id_producto = $f['id_pro'];
            $foto = substr($f['foto'], 0); // Elimina los primeros seis caracteres de la URL de la foto
            echo '

        <div class="col-md-6 col-lg-6 col-xl-4">
        <div class="rounded position-relative fruite-item">
            <div class="fruite-img">
                <a href="../../detalleProducto.php?id='.$f['id_pro'].'">
                    <img src="../../'.$foto.'" class="img-fluid w-100 rounded-top" alt="" style="height: 260px; object-fit:cover">
                </a>
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Ropa</div>';
            cargarVentasProducto($id_producto);
            echo'
            <div class="p-4 border border-secondary-r border-top-0 rounded-bottom">
                <h4>'.$f['nombre'].'</h4>
                <p>'.$f['descripcion'].'...</p>
                <div class="d-flex justify-content-between flex-lg-wrap">
                


                <form action="" method="post">
                    <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                    <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                    <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                    <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                    <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                    <p class="text-dark fs-5 fw-bold mb-0">'.number_format($f['precio'], 0  ,'', '.').'</p>
                    <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                </form>


                </div>
            </div>
        </div>
    </div>
                
            ';
           }
        }
    }
}

function cargarProductosCategoriaLana(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarCategoriaLana();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
            if ($f['stock']>= 1) {
                $id_producto = $f['id_pro'];
                $foto = substr($f['foto'], 0); // Elimina los primeros seis caracteres de la URL de la foto
                echo '
    
            <div class="col-md-6 col-lg-6 col-xl-4">
            <div class="rounded position-relative fruite-item">
                <div class="fruite-img">
                    <a href="../../detalleProducto.php?id='.$f['id_pro'].'">
                        <img src="../../'.$foto.'" class="img-fluid w-100 rounded-top" alt="" style="height: 260px; object-fit:cover">
                    </a>
                </div>
                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Lana</div>';
                cargarVentasProducto($id_producto);
    
                echo'
                <div class="p-4 border border-secondary-r border-top-0 rounded-bottom">
                    <h4>'.$f['nombre'].'</h4>
                    <p>'.$f['descripcion'].'...</p>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                    
                    
                    
                    <form action="" method="post">
                        <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                        <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                        <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                        <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                        <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                        <p class="text-dark fs-5 fw-bold mb-0">'.number_format($f['precio'], 0  ,'', '.').'</p>
                        <button type="submit" name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                        </form>
                        
                        
                        </div>
                        
                </div>
            </div>
        </div>
                    
                ';
            }
        }
    }
}
function cargarProductosCategoriaCostura(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarCategoriaCostura();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
            if ($f['stock'] >= 1) {
                $id_producto = $f['id_pro'];
                $foto = substr($f['foto'], 0); // Elimina los primeros seis caracteres de la URL de la foto
                    echo '

                <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative fruite-item">
                    <div class="fruite-img">
                        <a href="../../detalleProducto.php?id='.$f['id_pro'].'">
                            <img src="../../'.$foto.'" class="img-fluid w-100 rounded-top" alt="" style="height: 260px; object-fit:cover">
                        </a>
                    </div>
                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Costura</div>';
                    cargarVentasProducto($id_producto);
                    echo'
                    <div class="p-4 border border-secondary-r border-top-0 rounded-bottom">
                        <h4>'.$f['nombre'].'</h4>
                        <p>'.$f['descripcion'].'...</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                        


                        <form action="" method="post">
                            <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                            <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                            <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                            <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                            <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                            <p class="text-dark fs-5 fw-bold mb-0">'.number_format($f['precio'], 0  ,'', '.').'</p>
                            <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                        </form>


                        </div>
                    </div>
                </div>
            </div>
                        
                    ';
            }
        }
    }
}
function cargarProductosCategoriaPatrones(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarCategoriaPatrones();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
            if ($f['stock'] >= 1) {
                $id_producto = $f['id_pro'];
                $foto = substr($f['foto'], 0); // Elimina los primeros seis caracteres de la URL de la foto
                echo '

                    <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <a href="../../detalleProducto.php?id='.$f['id_pro'].'">
                                <img src="../../'.$foto.'" class="img-fluid w-100 rounded-top" alt="" style="height: 260px; object-fit:cover">
                            </a>
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Patrones</div>';
                        cargarVentasProducto($id_producto);
                        echo'
                        <div class="p-4 border border-secondary-r border-top-0 rounded-bottom">
                            <h4>'.$f['nombre'].'</h4>
                            <p>'.$f['descripcion'].'...</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                            


                            <form action="" method="post">
                                <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                                <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                                <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                                <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                                <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                                <p class="text-dark fs-5 fw-bold mb-0">'.number_format($f['precio'], 0  ,'', '.').'</p>
                                <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                            </form>


                            </div>
                        </div>
                    </div>
                </div>
                            
                        ';
            }
        }
    }
}

function cargarBarraProductos(){
    $objConsultas = new Consultas();
    $result = $objConsultas->consultarProducto();

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
            if ($f['stock'] >= 1) {
                $id_producto = $f['id_pro'];

                $foto = substr($f['foto'], 0); // Elimina los primeros seis caracteres de la URL de la foto
                echo '<div class="border border-primary rounded position-relative vesitable-item">
                <div class="vesitable-img">
                    <a href="./detalleProducto.php?id='.$f['id_pro'].'">
                        <img src="'.$foto.'" class="img-fluid w-100 rounded-top" alt="" style="height: 150px; object-fit:cover">
                    </a>
                </div>
                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">'.$f['categoria'].'</div>
                <div class="p-4 pb-0 rounded-bottom">
                    <h4>'.$f['nombre'].'</h4>
                    <p>Descripcion</p>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                    <form action="" method="post">
                        <input type="hidden" name="id_pro" value="'.openssl_encrypt($f['id_pro'], COD, KEY).'">
                        <input type="hidden" name="precio" value="'.openssl_encrypt($f['precio'], COD, KEY).'">
                        <input type="hidden" name="nombre" value="'.openssl_encrypt($f['nombre'], COD, KEY).'">
                        <input type="hidden" name="stock" value="'.openssl_encrypt($f['stock'], COD, KEY).'">
                        <input type="hidden" name="cantidad" value="'.openssl_encrypt(1, COD, KEY).'">
                        <p class="text-dark fs-5 fw-bold mb-0">$'.number_format($f['precio'], 0  ,'', '.').'</p>
                        <button type="submit"  name="accion" value="agregar" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primarys"></i> Añadir al carrito</a>   
                    </form>
                        
                    </div>
                    </div>
                </div>
                
                
                
                ';
            }
        }
    }
}


function cargarVentasProducto($id_producto){

    $objConsultas = new Consultas();
    $result = $objConsultas->consultarVentasProducto($id_producto);

    if(!isset($result)){
        echo "<h2>No hay productos registrados</h2>";
    } else {
        foreach ($result as $f) {
             // Elimina los primeros seis caracteres de la URL de la foto
            echo '
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="right: 10px; top: 47%;">'.$f['cantidad_ventas'].' ventas</div>
            ';
        }
    }

}
?>
