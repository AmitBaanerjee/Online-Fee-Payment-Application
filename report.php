<?php
    ob_start();
    //include 'connect.php';    
    require("fpdf181/fpdf.php");
    
    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->image("image.png",60,20,80,30);
	
	
    
    $pdf->sety(60);
	$pdf->SetFont('Helvetica','',24);
	
	$text = 'Transaction id: ';
	$pdf->Cell(10);
	$pdf->Cell(40,20,$text,0,1,'L');
	
	$text = 'Name   : ';
	$pdf->Cell(10);
	$pdf->Cell(40,20,$text,0,1,'L');
	
	/*$text = $username;
	$pdf->SetFontSize(24);
	$pdf->Cell(150,20,$text,0,1,'L');
	*/
	$text = 'Roll No.: ';
	$pdf->Cell(10);
	$pdf->Cell(40,20,$text,0,1,'L');
	
	/*$text = $text = $number;
	$pdf->SetFontSize(24);
	$pdf->Cell(150,20,$text,0,1,'L');
	*/
	
	$text = 'Type   : ';
	$pdf->Cell(10);
	$pdf->Cell(40,20,$text,0,1,'L');
	
	$text = 'Amount   : ';
	$pdf->Cell(10);
	$pdf->Cell(40,20,$text,0,1,'L');
	
	/*$text = $marks;
	$pdf->SetFontSize(24);
	$pdf->Cell(150,20,$text,0,1,'L');
	*/
	
	
    

    $pdf->output('.pdf',"D");
        
?>