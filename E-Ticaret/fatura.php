<?php

require('fpdf.php'); 
$pdf=new FPDF();   
$pdf->AddPage();  
$pdf->SetFont('Arial','',12);

$toplamfiyat=0;
$y1=10;
$y2=10;

$pdf->Cell(180,10,"Fatura Bilgileriniz",0,1,'C');
$pdf->Ln(8);
session_start();
$list = new PDO("mysql:host=localhost;dbname=oturum", 'root',''); 
	$kullanici_id=$_SESSION["id"];
$idler=$list->query("SELECT * FROM sepet WHERE kullanici_id=$kullanici_id");
	while ($fav_id = $idler->fetch()) {
		$urunid=$fav_id['urun_id'];
		$favoriler=$list->query("SELECT * FROM urun WHERE urun_id=$urunid");
		while ($tekurun = $favoriler->fetch()) {
				$urunid=$tekurun['urun_id'];
				$serino=$tekurun['serino'];
				$ad=$tekurun['ad'];
				$fiyat=$tekurun['fiyat'];
				$adetler=$list->query("SELECT * FROM sepet WHERE urun_id=$urunid AND kullanici_id=$kullanici_id");
				while ($sepettekiurun = $adetler->fetch()) {
					$adet=$sepettekiurun['adet'];
					$tfiyat=$adet*$fiyat;
				}
				$pdf->Ln(8);
				$pdf->Cell(40,10,"Serino: ".$serino); 
				$pdf->Ln(8);
				$pdf->Cell(40,10,"Ad: ".$ad);
				$pdf->Ln(8);
				$pdf->Cell(40,10,"Adet: ".$adet);
				$pdf->Ln(8);
				$pdf->Cell(40,10,"Fiyat: ".$tfiyat ." TL");
				$pdf->Ln(8);
				
				$toplamfiyat=$toplamfiyat+$tfiyat;

				
			}
		$pdf->line(10,$y1,200,$y2);
		$y1=$y1+60;
		$y2=$y2+60;
	}
		$pdf->Ln(8);
		$pdf->Cell(60,10,"Toplam Fiyat: ".$toplamfiyat ." TL",1,1,'L');
$pdf->Output(); 
?>