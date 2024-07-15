<?php
    require_once("../../Models/conexion_db.php");
    require_once("../../Models/consultasAdmin.php");
    require_once("../../Controllers/Vendedor/mostrarProveedor.php");
    require_once("../../Models/consultasVendedor.php");
    require_once("../../Models/seguridadAdmin.php");
    require_once("../../Controllers/Administrador/mostrarPerfil.php");
    require_once("../../Models/consultasGlobal.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Producto : VENDEDOR</title>
    <link rel="shortcut icon" type="image/x-icon" href="../client-side/images/icono_decroche.jpeg" />
    <!-- Styles -->
    <link href="../dashboard/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="../dashboard/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="../dashboard/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../dashboard/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../dashboard/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="../dashboard/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../dashboard/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="../dashboard/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../dashboard/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../dashboard/css/lib/helper.css" rel="stylesheet">
    <link href="../dashboard/css/style.css" rel="stylesheet">
</head>

<body>

<?php
            include("menu.php");
        ?>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <section id="main-content">
                    
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card" style="border: 1px solid #c96691; border-radius: 2%;">
                                <div class="card-title">
                                <h1 style="font-family: 'Teko', sans-serif;">REGISTRAR PRODUCTOS<h1>
                                    <h4 >Completa los campos para agregar productos al inventario</h4>
                                    
                                </div>
                                <div class="card-body">
                                    
                            <form action="../../Controllers/Vendedor/registroProducto.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="row">
                                <!-- <form action="../../Controllers/Administrador/registroProducto.php" method="POST"> -->
                                <div class="form-group col-md-6">   
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" placeholder="Ej: lanero" name="nombre"> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Precio</label>
                                    <input type="number" class="form-control" placeholder="Ej: 12.400" name="precio">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Stock disponible:</label>
                                    <input type="number" class="form-control"  name="stock">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Categoria</label>
                                    <select name="categoria" id="" class="form-control">
                                        <option value="ropa" >Seleccione una opcion</option>
                                        <option value="ropa">Ropa</option>
                                      ion value="lanas">Lanas</option>
                                        <option value="articulos">Articulos de costura</option>
                                        <option value="patrones">Patrones</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Proveedor</label>
                                    <select name="proveedor" id="" class="form-control">
                                        <tbody></tbody>
                                        <option>Seleccione una opcion</option>
                                            <?php
                                                   cargarVendedor();
                                            ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6"">
                                    <label>Foto:</label>
                                    <input type="file" class="form-control" id="foto"   name="foto" placeholder="Ej:SergioOrtiz.03" accept=".png,.jpg">
                                </div>
                                <div class="form-group col-md-6"">
                                    <label>Foto 2 :</label>
                                    <input type="file" class="form-control" id="foto2"   name="foto2" placeholder="Ej:SergioOrtiz.03" accept=".png,.jpg">
                                </div>
                                <div class="form-group col-md-6"">
                                    <label>Foto 3:</label>
                                    <input type="file" class="form-control" id="foto3"   name="foto3" placeholder="Ej:SergioOrtiz.03" accept=".png,.jpg">
                                </div>
                                <div class="form-group col-md-6"">
                                    <label>Estado</label>
                                    <select name="estado" id="" class="form-control">
                                        <option>Seleccione una opcion</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Bloqueado">Bloqueado</option>
                                        <option value="promocion">promocion</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" style="background: #c96691; color: #fff; margin-left: 45%; height:50px; font-size: 17px;">Registrar producto</button>
                            </form>
                            </div>
                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                </section>
            </div>
        </div>
    </div>

  <!-- jquery vendor -->
  <script src="../dashboard/js/lib/jquery.min.js"></script>
    <script src="../dashboard/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../dashboard/js/lib/menubar/sidebar.js"></script>
    <script src="../dashboard/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="../dashboard/js/lib/bootstrap.min.js"></script>
    <script src="../dashboard/js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="../dashboard/js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="../dashboard/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <script src="../dashboard/js/lib/calendar-2/pignose.init.js"></script>


    <script src="../dashboard/js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="../dashboard/js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="../dashboard/js/lib/chartist/chartist.min.js"></script>
    <script src="../dashboard/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="../dashboard/js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="../dashboard/js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="../dashboard/js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->

</body>

</html>