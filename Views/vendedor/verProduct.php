<?php
    require_once("../../Models/conexion_db.php");
    require_once("../../Models/consultasVendedor.php");
    require_once("../../Controllers/Administrador/mostrarProducts.php");
    require_once("../../Models/seguridadAdmin.php");
    require_once("../../Controllers/Administrador/mostrarPerfil.php");
    require_once("../../Controllers/Vendedor/mostrarProducts.php");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver Productos : VENDEDOR</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <div class="card">
                                <div class="card-title">
                                    <h1>GESTIONAR PRODUCTOS - VENDEDOR<h1>
                                            <h4>Selecciona la acción que deseas realizar con la información de cada
                                                producto (editar/eliminar)</h4>
                                            <br><br><br>
                                </div>
                                <div class="card-body">
                                    <div class="basic-elements">
                                        <div class="table-responsive" id="scrollHere">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr style="background: #e08eb1;" class="center-div-bar">
                                                        <th style="color:#fff;" >Foto</th>
                                                        <th style="color:#fff;">Nombre</th>
                                                        <th style="color:#fff;">Categoría</th>
                                                        <th style="color:#fff;">Precio</th>
                                                        <th style="color:#fff;">Vendedor</th>
                                                        <th style="color:#fff;">Estado</th>
                                                        <th style="color:#fff;">Editar</th>
                                                        <th style="color:#fff; text-align: center;">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    cargarProductosVendedor();
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>


        <div id="formularioEdicion" >
            <form id="form_editar_servicios" method="post">
                <table class="table table-bordered table-hover form-edit" style="border: 8px solid #dee2e6;">
                    <thead style="display: none;">
                        <tr>
                            <th colspan="2">Editar Usuario <span id="nombreUsuario"></span></th>
                        </tr>
                    </thead>
                    <tbody class="form-edit">
                        <tr>
                            <h2 colspan="2" style="text-align: center; margin: 30px 0 50px;">Editar producto <span id="nombreUsuario"></span></h2>
                        </tr>
                        <tr>
                            <input type="hidden" id="id_pro" name="id_pro">
                        </tr>
                        <tr>
                            <td><label for="nombres">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre"></td>
                        </tr>
                        <tr>
                            <td><label for="categoria">Categoría:</label></td>
                            <td><input type="text" id="categoria" name="categoria"></td>
                        </tr>
                        <tr>
                            <td><label for="precio">Precio:</label></td>
                            <td><input type="text" id="precio" name="precio"></td>
                        </tr>
                        <tr>
                            <td><label for="proveedor">Proveedor:</label></td>
                            <td><input type="text" id="proveedor" name="proveedor"></td>
                        </tr>
                        <tr>
                            <td><label for="stock">cantidad disponible:</label></td>
                            <td><input type="text" id="stock" name="stock"></td>
                        </tr>

                        <tr>
                            <td><label for="estado">Estado:</label></td>
                            <td><select class=""  name="estado" id="estado" style="width: -webkit-fill-available; padding: 10px;" id="detalle">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Agrega otros campos del formulario de edición aquí -->
                <button type="submit" style="margin: 30px  45%; height: 50px; font-size: 17px;"  class="btn btn-pink">Guardar Cambios</button>
            </form>
        </div>




        </section>

    </div>
    </div>
    </div>

    <script>
    function scrollToEnd() {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }
</script>




    
<script src="./script.js"></script>

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

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<!-- <script>
    $(document).ready(function() {
$('#bootstrap-data-table-export').DataTable({
    dom: 'l<"toolbar">frtip', 
    buttons: [] 
});



});
</script> -->

<script>
$(document).ready(function() {
$('#bootstrap-data-table-export').DataTable({
    dom: 'l<"toolbar">frtip', // 'l' para el selector de entradas por página
    buttons: [], // Esto elimina todos los botones de exportación
    language: {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ entradas",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando   _START_ de _END_  de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 entradas",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ entradas)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "  Siguiente",
            "sPrevious": "Anterior  "
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});

// Agregar un contenedor personalizado para el selector de entradas por página
});
</script>
</body>

</html>