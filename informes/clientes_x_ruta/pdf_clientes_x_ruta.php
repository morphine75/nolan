<?php
ob_start();
?>
<title>Informe</title>
<body>
	<?php
	include("../../inc/conexion.php");
	conectar();

	$id_ruta=$_REQUEST['ruta'];

	$sql="SELECT c.ID_CLIENTE, NOM_CLIENTE, FANTASIA, CUIT, CALLE, ALTURA from cli_x_ruta r, clientes c where c.ID_CLIENTE=r.ID_CLIENTE and r.ID_RUTA=".$id_ruta;
	$res=mysqli_query($conn, $sql);

	require('../../fpdf/fpdf.php');
	$pdf=new FPDF();            
	$pdf->AddPage();
	$pdf->PageNo();
	$pdf->AliasNbPages('{totalPages}');                 

	$pdf->Image('../../img/logo_nolan.jpg',15,8,33);

	$pdf->SetFont('Arial','',6); 	
	$pdf->SetXY(160,10);                      
	$pdf->SetFillColor(999,999,999);
	$pdf->SetDrawColor(999,999,999);  
	$pdf->Cell(30,4,date('d/m/Y').' -  Posadas, Misiones',1,0,'R',1);

	$pdf->SetFont('Arial','B',14); 
	$pdf->SetXY(120,25);                      
	$pdf->SetFillColor(999,999,999);
	$pdf->SetDrawColor(999,999,999);  
	$pdf->Cell(30,4,'INFORME DE CLIENTES POR RUTA',1,0,'R',1);

	$pdf->SetDrawColor(188,188,188);
	$pdf->Line(0, 35, 210, 35);	

	$pdf->SetXY(3,40);                      
	$pdf->SetFont('Arial','',7);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(10,4,'ID',1,0,'L',1);		

	$pdf->SetXY(13,40);                      
	$pdf->SetFont('Arial','',7);           
	$pdf->SetFillColor(235,235,235);   
	$pdf->Cell(60,4,'Cliente','TLRB',0,'L',1);		

	$pdf->SetXY(73,40);                      
	$pdf->SetFont('Arial','',7);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(60,4,'Fantasia',1,0,'L',1);

	$pdf->SetXY(133,40);                      
	$pdf->SetFont('Arial','',7);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(25,4,'CUIT',1,0,'L',1);

	$pdf->SetXY(158,40);                      
	$pdf->SetFont('Arial','',7);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(50,4,'Domicilio',1,0,'L',1);

	$pdf->SetXY(3,44);
	while ($row=mysqli_fetch_assoc($res)){
		$pdf->SetX(3);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(30,4,$row['ID_CLIENTE'],1,0,'L',1);

		$pdf->SetX(13);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(60,4,$row['NOM_CLIENTE'],1,0,'L',1);

		$pdf->SetX(73);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(60,4,$row['FANTASIA'],1,0,'L',1);

		$pdf->SetX(133);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(25,4,$row['CUIT'],1,0,'L',1);

		$pdf->SetX(158);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(50,4,$row['CALLE']." ".$row['ALTURA'],1,0,'L',1);
		
		$pdf->Ln();		
	}	

	$pdf->SetFont('Arial','',6); 
	$pdf->SetXY(10,271); 	
	$pdf->Cell(190, 5, "Pagina " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R',1);	



	ob_end_clean();
	$pdf->Output();
	?>
</body>
</html>