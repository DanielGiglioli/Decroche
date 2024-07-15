

<script>
    function swalerror(text) {

        Swal.fire({
            html: `
            
                <div style="display: block; flex-direction: column; align-items: center;">
                <img src="https://i.pinimg.com/originals/95/e9/93/95e993a63883b014107a4806880ed970.gif" style="width: 100%; max-height: 150px;"  />
                <h2 style="color:#f27474;">Error</h2>
                <p style="color:#000;">${text}</p>
                </div>
            `,
            position: 'top',
            toast: true,
            showConfirmButton: false,
            timer: 2500,
            customClass: {
            popup: 'custom-error' 
        }
        });
    }

    function swalsucces(text) {

        Swal.fire({


            html: `
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <img src="https://raw.githubusercontent.com/chechojgb/images/main/compra2.gif" style="width: 150; height: 100"  />
                    <p>${text}</p>
                </div>
            `,
            position: 'top',
            toast: true,
            showConfirmButton: false,
            timer: 3000,
            customClass: {
            popup: 'custom-swalsucces' // Aquí se agrega la clase personalizada
        }
            
        });
    }


</script>

    <?php

    session_start();

    $mensaje="";

    if(isset($_POST["accion"])){
        switch($_POST["accion"]){
            case "agregar":
                if(is_numeric(openssl_decrypt($_POST["id_pro"], COD,KEY))){
                    $id_pro = openssl_decrypt($_POST["id_pro"], COD,KEY);
                    $mensaje.= "Id correcto: ".$id_pro."<br/>";
                }else{
                    $mensaje.= "El id no es correcto".$id_pro;
                }

                if(is_string(openssl_decrypt($_POST["nombre"], COD,KEY))){
                $nombre = openssl_decrypt($_POST["nombre"], COD,KEY);
                $mensaje.= "El nombre es correcto: ".$nombre."<br/>";
                }else{$mensaje.= "El nombre no es correcto:".$nombre ."<br/>"; break;}

                if(is_numeric(openssl_decrypt($_POST["precio"], COD,KEY))){
                        $precio = openssl_decrypt($_POST["precio"], COD,KEY);
                        $mensaje.= "El precio es correcto: ".$precio."<br/>";
                }else{$mensaje.= "El precio no es correcto"."<br/>";break;}

                if(is_numeric(openssl_decrypt($_POST["cantidad"], COD,KEY))){
                    $cantidad = openssl_decrypt($_POST["cantidad"], COD,KEY);
                    $mensaje.= "La cantidad es correcta: ".$cantidad."<br/>";
                }else{$mensaje.= "La cantidad no es correcta"."<br/>"; break;}
                if(is_numeric(openssl_decrypt($_POST["stock"], COD,KEY))){
                    $stock = openssl_decrypt($_POST["stock"], COD,KEY);
                    $mensaje.= "El stock es correcta: ".$cantidad."<br/>";
                }else{$mensaje.= "La cantidad no es correcta"."<br/>"; break;}
                

                if(!isset($_SESSION['carrito'])){
                    $producto=array(
                        'id_pro' =>$id_pro,
                        'nombre'=>$nombre,
                        'precio'=>$precio,
                        'cantidad'=>$cantidad,
                        'stock'=>$stock
                    );
                    $_SESSION['carrito'][0]=$producto;
                    echo '<script>
                        swalsucces("Producto agregado al carrito");</script>';
                }else{

                    $idProductos=array_column($_SESSION['carrito'],"id_pro");

                    if(in_array($id_pro,$idProductos)){
                        echo '<script>
                        swalerror("El producto ya ha sido seleccionado");</script>';
                    }else{

                    
            
                    $numeroProductos = count($_SESSION['carrito']);
                    $producto=array(
                        'id_pro' =>$id_pro,
                        'nombre'=>$nombre,
                        'precio'=>$precio,
                        'cantidad'=>$cantidad,
                        'stock'=>$stock
                    );
                    $_SESSION['carrito'][$numeroProductos]=$producto;
                    echo '<script>
                        swalsucces("Producto agregado al carrito");</script>';
                    }
                }
                // $mensaje = print_r($_SESSION, true);
                
            break;

            case "eliminar":
                if(is_numeric(openssl_decrypt($_POST["id_pro"], COD,KEY))){
                    $id_pro = openssl_decrypt($_POST["id_pro"], COD,KEY);
                    
                    foreach ($_SESSION['carrito'] as $indice=>$producto) {
                        if($producto['id_pro']==$id_pro){
                            unset($_SESSION['carrito'][$indice]);
                            $_SESSION['carrito']=array_values($_SESSION["carrito"]); 
                        }
                    }
                }else{
                    $mensaje.= "El id no es correcto".$id_pro;
                }
            break;

            case "sumar":
                if (is_numeric(openssl_decrypt($_POST["id_pro"], COD, KEY))) {
                    $id_pro = openssl_decrypt($_POST["id_pro"], COD, KEY);
            
                    foreach ($_SESSION['carrito'] as $indice => &$producto) {
                        if ($producto['id_pro'] == $id_pro) {
                            if($producto['cantidad'] < $producto['stock']){
                                $producto['cantidad']++; 
                                //no contar mas si llega a 20
                            }
                        }
                    }
                } else {
                    $mensaje .= "El id no es correcto" . $id_pro;
                }
                break;
            
            case "restar":
                if (is_numeric(openssl_decrypt($_POST["id_pro"], COD, KEY))) {
                    $id_pro = openssl_decrypt($_POST["id_pro"], COD, KEY);
            
                    foreach ($_SESSION['carrito'] as $indice => &$producto) {
                        if ($producto['id_pro'] == $id_pro) {
                            if ($producto['cantidad'] > 1) {
                                $producto['cantidad']--; // Disminuir la cantidad si es mayor que 1
                            }
                        }
                    }
                } else {
                    $mensaje .= "El id no es correcto" . $id_pro;
                }
            break;


        }
    }

?>

