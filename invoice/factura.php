

<?php


  require_once("../Models/conexion_db.php");
  require_once("../Models/consultasGlobal.php");


  $id_factura = $_GET['id_factura'];
  $objConsultas = new Consultas();
  $result = $objConsultas->facturaIndividual($id_factura);



  foreach ($result as $f) {
	# Incluyendo librerias necesarias #
	require "./code128.php";

	$pdf = new PDF_Code128('P','mm','Letter');
	$pdf->SetMargins(17,17,17);
	$pdf->AddPage();

	# Logo de la empresa formato png #
	$pdf->Image('../Views/client-side/images/decrochea.png',135,10,70,40,'png');

	# Encabezado y datos de la empresa #
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->SetTextColor(224, 142, 177);
	$pdf->Cell(150, 10, strtoupper("DeCroche"), 0, 0, 'L'); 
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Ln(9);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","RUC: 0000000000"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Bogotá, Colombia"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Teléfono: 320992827"),0,0,'L');

	$pdf->Ln(5);

	$pdf->Cell(150,9,iconv("UTF-8", "ISO-8859-1","Email: soportedecroche@gmail.com"),0,0,'L');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(30,7,iconv("UTF-8", "ISO-8859-1","Fecha de emisión:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(116,7,iconv("UTF-8", "ISO-8859-1",$f['fecha_emision']));
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",strtoupper("Factura Nro.")),0,0,'C');

	$pdf->Ln(7);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(12,7,iconv("UTF-8", "ISO-8859-1","Cajero:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(134,7,iconv("UTF-8", "ISO-8859-1","Daniel Giglioli"),0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",$id_factura),0,0,'C');

	$pdf->Ln(10);

	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(13,7,iconv("UTF-8", "ISO-8859-1","Cliente:"),0,0);
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1",$f['nombre']),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(8,7,iconv("UTF-8", "ISO-8859-1","Doc: "),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(60,7,iconv("UTF-8", "ISO-8859-1",$f['nombre']),0,0,'L');
	$pdf->SetTextColor(39,39,51);
	$pdf->Cell(7,7,iconv("UTF-8", "ISO-8859-1","Tel:"),0,0,'L');
	$pdf->SetTextColor(97,97,97);
	$pdf->Cell(35,7,iconv("UTF-8", "ISO-8859-1",$f['numero_cel']),0,0);
	$pdf->SetTextColor(39,39,51);

	$pdf->Ln(7);


	$pdf->Ln(9);

	# Tabla de productos #
	$pdf->SetFont('Arial','',8);
	$pdf->SetFillColor(23,83,201);
	$pdf->SetDrawColor(23,83,201);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(90,8,iconv("UTF-8", "ISO-8859-1","Descripción"),1,0,'C',true);
	$pdf->Cell(15,8,iconv("UTF-8", "ISO-8859-1","Cant."),1,0,'C',true);
	$pdf->Cell(25,8,iconv("UTF-8", "ISO-8859-1","Precio_un"),1,0,'C',true);
	$pdf->Cell(19,8,iconv("UTF-8", "ISO-8859-1","Desc."),1,0,'C',true);
	$pdf->Cell(32,8,iconv("UTF-8", "ISO-8859-1","Subtotal"),1,0,'C',true);

	$pdf->Ln(8);

	
	$pdf->SetTextColor(39,39,51);

	/*----------  Detalles de la tabla  ----------*/




    foreach ($result as $f) {
        $pdf->Cell(90, 7, iconv("UTF-8", "ISO-8859-1", $f['nombre_producto']), 'L', 0, 'C');
        $pdf->Cell(15, 7, iconv("UTF-8", "ISO-8859-1", $f['cantidad']), 'L', 0, 'C');
        $pdf->Cell(25, 7, iconv("UTF-8", "ISO-8859-1", $f['subtotal']), 'L', 0, 'C');
        $pdf->Cell(19, 7, iconv("UTF-8", "ISO-8859-1", "$0.00 USD"), 'L', 0, 'C');
        $pdf->Cell(32, 7, iconv("UTF-8", "ISO-8859-1", $f['subtotal']), 'LR', 0, 'C');
        $pdf->Ln(7);
    }



	/*----------  Fin Detalles de la tabla  ----------*/


	

	$pdf->SetFont('Arial','B',9);
	
	# Impuestos & totales #





			$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
			$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'T',0,'C');
			$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),'T',0,'C');
			$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1",number_format($f['total'], 0  ,'', '.')),'T',0,'C');
		
			$pdf->Ln(7);
		
			$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","IVA (0%)"),'',0,'C');
			$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","+ $0.00 USD"),'',0,'C');
		
			$pdf->Ln(7);
		
			$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
		
		
			$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),'T',0,'C');
			$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1",number_format($f['total'], 0  ,'', '.')),'T',0,'C');
		
			$pdf->Ln(7);
		
			$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			$pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","TOTAL PAGADO"),'',0,'C');
			$pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1",number_format($f['total'], 0  ,'', '.')),'',0,'C');
		
			// $pdf->Ln(7);
		
			// $pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			// $pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			// $pdf->Cell(32,7,iconv("UTF-8", "ISO-8859-1","CAMBIO"),'',0,'C');
			// $pdf->Cell(34,7,iconv("UTF-8", "ISO-8859-1","$30.00 USD"),'',0,'C');
		
			$pdf->Ln(7);
		
			$pdf->Cell(100,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
			$pdf->Cell(15,7,iconv("UTF-8", "ISO-8859-1",''),'',0,'C');
		
			$pdf->Ln(12);
		
			$pdf->SetFont('Arial','',9);
		
			$pdf->SetTextColor(39,39,51);
			$pdf->MultiCell(0,9,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar esta factura ***"),0,'C',false);
		
			$pdf->Ln(9);

	

	# Codigo de barras #
	$pdf->SetFillColor(39,39,51);
	$pdf->SetDrawColor(23,83,201);
	$pdf->Code128(72,$pdf->GetY(),$f['numero_factura'],70,20);
	$pdf->SetXY(12,$pdf->GetY()+21);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",$f['numero_factura']),0,'C',false);

	# Nombre del archivo PDF #
	$pdf->Output("I","Factura_Nro_1.pdf",true);

}