<p align="right"><a href="favoriler.php"> Favoriler </a> <br><a href="cikis.php"> Oturumu Kapat </a></p>
<?php
session_start();
if($_SESSION["tur"]=='kullanici')
{
	$list = new PDO("mysql:host=localhost;dbname=oturum", 'root',''); 
	$urunler= $list-> query("SELECT * FROM urun");
	while ($tekurun = $urunler->fetch()) {
		
		$urunid=$tekurun['urun_id'];
		$serino=$tekurun['serino'];
		$ad=$tekurun['ad'];
		$adet=$tekurun['adet'];
		$fotograf=$tekurun['fotograf'];
		echo "
		<center>
		<table width='600' height='200' border='0'>
		
		<tr>
		<td>
		<img src='$fotograf' width='150' height='150'>
		</td>
		
		
		
		<td>
		<b>Serino:</b> $serino <br>
		<b>Adı:</b> $ad <br>
		<b>Adet:</b> $adet <br>
		
		<a href='favoriler.php?id=$urunid'>
					<img src='begen.png' width='25' height='25'>
		</a>
		</td>
		
		
		</tr>
		
		</table>
		</center>
		";
	}
}
else
{
	header('location: giris.php');
}
?>