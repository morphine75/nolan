<?php
	include("../../inc/conexion.php");
	conectar();

	$movil=$_REQUEST['id_movil'];
	$nom_movil=$_REQUEST['nom_movil'];

	$sql="SELECT sum(a.PESO*dp.CANT) as PESO, sum(p.TOTAL) as TOTAL , floor(sum(CANT/CANTXCAJA)) as BULTOS, sum(CANT mod CANTXCAJA) as UNIDADES, a.ID_ARTICULO, a.DESCRIPCION from distribucion d, moviles m, detalle_pedido dp, articulos a, pedidos p where m.ID_MOVIL=d.ID_MOVIL and dp.ID_PEDIDO=d.ID_PEDIDO and a.ID_ARTICULO=dp.ID_ARTICULO and dp.ID_PEDIDO=p.ID_PEDIDO AND d.ID_MOVIL=".$movil." group by a.ID_ARTICULO";
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
	$pdf->SetXY(110,25);                      
	$pdf->SetFillColor(999,999,999);
	$pdf->SetDrawColor(999,999,999);  
	$pdf->Cell(30,4,'COMPOSICION DE CARGA',1,0,'R',1);

	$pdf->SetFont('Arial','B',14); 
	$pdf->SetXY(85,32);                      
	$pdf->SetFillColor(999,999,999);
	$pdf->SetDrawColor(999,999,999);  
	$pdf->Cell(30,4,$nom_movil,1,0,'R',1);

	$pdf->Ln();	

	$pdf->SetDrawColor(188,188,188);
	$pdf->Line(0, 45, 210, 45);	

	$pdf->SetXY(8,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(15,7,'ID',1,0,'L',1);		

	$pdf->SetXY(23,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);   
	$pdf->Cell(100,7,'Articulo','TLRB',0,'L',1);		

	$pdf->SetXY(123,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(40,7,'Bultos',1,0,'L',1);

	$pdf->SetXY(163,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(40,7,'Unidades',1,0,'L',1);

	$pdf->SetXY(8,57);
	while ($row=mysqli_fetch_assoc($res)){
		$pdf->SetX(8);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(15,7,$row['ID_ARTICULO'],1,0,'L',1);

		$pdf->SetX(23);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(100,7,$row['DESCRIPCION'],1,0,'L',1);

		$pdf->SetX(123);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(40,7,$row['BULTOS'],1,0,'L',1);

		$pdf->SetX(163);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(40,7,$row['UNIDADES'],1,0,'L',1);
		
		$pdf->Ln();			
	}	

	$pdf->AddPage();	

	$sql="SELECT p.ID_CLIENTE, c.NOM_CLIENTE, p.TOTAL, p.ID_PEDIDO FROM pedidos p, clientes c, distribucion d where c.ID_CLIENTE=p.ID_CLIENTE and p.ID_PEDIDO=d.ID_PEDIDO and d.ID_MOVIL=".$movil." and p.PROCESADO=0
		union ALL
		SELECT p.ID_CLIENTE, c.NOM_CLIENTE, p.TOTAL, p.ID_PEDIDO FROM pedidos p, comprobantes co, clientes c, distribucion d where c.ID_CLIENTE=p.ID_CLIENTE and p.ID_PEDIDO=d.ID_PEDIDO and co.ID_PEDIDO=p.ID_PEDIDO and d.ID_MOVIL=".$movil." and p.PROCESADO=1";

	$res=mysqli_query($conn, $sql);		

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
	$pdf->Cell(30,4,'LISTADO DE PEDIDOS A ENTREGAR',1,0,'R',1);

	$pdf->SetFont('Arial','B',14); 
	$pdf->SetXY(85,32);                      
	$pdf->SetFillColor(999,999,999);
	$pdf->SetDrawColor(999,999,999);  
	$pdf->Cell(30,4,$nom_movil,1,0,'R',1);

	$pdf->Ln();	

	$pdf->SetDrawColor(188,188,188);
	$pdf->Line(0, 45, 210, 45);		

	$pdf->SetXY(8,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(15,7,'ID',1,0,'L',1);		

	$pdf->SetXY(23,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);   
	$pdf->Cell(40,7,'Id.Cliente','TLRB',0,'L',1);		

	$pdf->SetXY(63,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(100,7,'Cliente',1,0,'L',1);

	$pdf->SetXY(163,50);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(40,7,'Total',1,0,'L',1);	


	$pdf->SetXY(8,57);
	$total=0;
	while ($row=mysqli_fetch_assoc($res)){
		$pdf->SetX(8);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(15,7,$row['ID_PEDIDO'],1,0,'L',1);

		$pdf->SetX(23);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(40,7,$row['ID_CLIENTE'],1,0,'L',1);

		$pdf->SetX(63);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(100,7,$row['NOM_CLIENTE'],1,0,'L',1);

		$pdf->SetX(163);                      
		$pdf->SetFont('Arial','',7);           
		$pdf->SetFillColor(999,999,999);  
		$pdf->Cell(40,7,'$ '.$row['TOTAL'],1,0,'L',1);
		$total=$total+$row['TOTAL'];
		
		$pdf->Ln();			
	}

	$pdf->SetX(8);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(15,7,'',1,0,'L',1);

	$pdf->SetX(23);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(40,7,'',1,0,'L',1);

	$pdf->SetX(63);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(100,7,'TOTAL',1,0,'L',1);

	$pdf->SetX(163);                      
	$pdf->SetFont('Arial','',10);           
	$pdf->SetFillColor(235,235,235);  
	$pdf->Cell(40,7,'$ '.$total,1,0,'C',1);

	ob_end_clean();
	$pdf->Output();	
?>