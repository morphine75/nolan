<title>ProLog</title>
<?php
    include("../inc/conexion.php");
    conectar();

    $pedido=$_REQUEST['pedido'];
    $documento=$_REQUEST['documento'];


    $sql="SELECT c.ID_PEDIDO, c.ID_COMPROBANTE, d.DESCRIPCION, c.FECHAFAC, cl . *, p.TOTAL FROM comprobantes c, clientes cl, pedidos p, documentos d WHERE c.ID_CLIENTE = cl.ID_CLIENTE AND c.ID_DOCUMENTO=d.ID_DOCUMENTO AND c.ID_PEDIDO = p.ID_PEDIDO AND c.ID_PEDIDO =".$pedido." AND c.ID_DOCUMENTO =".$documento;
    $res=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    $comprobante=$row['ID_COMPROBANTE'];
    require('../fpdf/fpdf.php');

    $pdf=new FPDF();            
    $pdf->AddPage();
    $pdf->PageNo();
    $pdf->AliasNbPages('{totalPages}');                 

    $pdf->Image('../img/logo_prolog.jpg',10,8,33);

    $pdf->SetY(20);
    $pdf->SetX(10);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(50,10,"ProLog",0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(50,5,"Calle 101 2440,",0,1);
    $pdf->Cell(50,5,"Posadas - Misiones",0,1);

    $pdf->SetFont('Arial','',6);    
    $pdf->SetXY(160,10);                      
    $pdf->SetFillColor(999,999,999);
    $pdf->SetDrawColor(999,999,999);  
    $pdf->Cell(30,4,'Fecha: '.$row['FECHAFAC'].' -  Posadas, Misiones',1,0,'R',1);

    $pdf->SetXY(160,15);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(50,10,"COMPROBANTE: ".$comprobante,0,1);

    $pdf->SetXY(90,15);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(50,10, $row ['DESCRIPCION'],0,1);

    $pdf->SetY(49);
    $pdf->SetX(10);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(50,5,'CLIENTE '.$row["ID_CLIENTE"],0,1);
    $pdf->Cell(50,5,$row["NOM_CLIENTE"].' '.$row["FANTASIA"],0,1);
    $pdf->Cell(50,5,$row["CALLE"].' '.$row["ALTURA"],0,1);
    $pdf->Cell(50,5,'Pedido '.$row["ID_PEDIDO"],0,1);

    $pdf->Ln(); 

    $pdf->SetDrawColor(188,188,188);
    $pdf->Line(0, 45, 210, 45); 

    $pdf->SetXY(10,72);                      
    $pdf->SetFont('Arial','',10);           
    $pdf->SetFillColor(235,235,235);  
    $pdf->Cell(15,7,'Cod',1,0,'L',1);        

    $pdf->SetXY(23,72);                      
    $pdf->SetFont('Arial','',10);           
    $pdf->SetFillColor(235,235,235);   
    $pdf->Cell(100,7,'Articulo','TLRB',0,'L',1);        

    $pdf->SetXY(123,72);                      
    $pdf->SetFont('Arial','',10);           
    $pdf->SetFillColor(235,235,235);  
    $pdf->Cell(40,7,'Cantidad',1,0,'L',1);

    $pdf->SetXY(163,72);                      
    $pdf->SetFont('Arial','',10);           
    $pdf->SetFillColor(235,235,235);  
    $pdf->Cell(40,7,'Total',1,0,'L',1);

    $sql2="SELECT a.ID_ARTICULO, DESCRIPCION, CANT, PRECIO, BONIF from detalle_pedido d, articulos a where d.ID_ARTICULO=a.ID_ARTICULO AND d.ID_PEDIDO=".$pedido;
    $res2=mysqli_query($conn, $sql2);

    $pdf->SetXY(10,79);
    while ($row2=mysqli_fetch_assoc($res2)){
        $pdf->SetX(10);                      
        $pdf->SetFont('Arial','',7);           
        $pdf->SetFillColor(999,999,999);  
        $pdf->Cell(15,7,$row2['ID_ARTICULO'],1,0,'L',1);

        $pdf->SetX(23);                      
        $pdf->SetFont('Arial','',7);           
        $pdf->SetFillColor(999,999,999);  
        $pdf->Cell(100,7,$row2['DESCRIPCION'],1,0,'L',1);

        $pdf->SetX(123);                      
        $pdf->SetFont('Arial','',7);           
        $pdf->SetFillColor(999,999,999);  
        $pdf->Cell(40,7,$row2['CANT'],1,0,'L',1);

        $pdf->SetX(163);                      
        $pdf->SetFont('Arial','',7);           
        $pdf->SetFillColor(999,999,999);  
        $pdf->Cell(40,7,$row2['PRECIO'],1,0,'L',1);
        
        $pdf->Ln();         
    }   

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(153,9,"TOTAL $",1,0,"R");
    $pdf->SetFillColor(235,235,235);
    $pdf->Cell(40,9,$row["TOTAL"],1,1,"R",1);
    ob_end_clean();
   $pdf->Output('COMPROBANTE '.$comprobante,'I');
?>