<a href="cikis.php"> Oturumu Kapat </a>
<?php
session_start();
if($_SESSION["tur"]=='kullanici')
{	$list = new PDO("mysql:host=localhost;dbname=oturum", 'root',''); 
	
	$kullanici_id=$_SESSION["id"];
	
	
	
	if(isset($_GET['id'])) 
	{
		$gelen_id=$_GET['id'];
		
		$tekrar=0;
		$idler=$list->query("SELECT * FROM favori WHERE kullanici_id=$kullanici_id");
		while ($fav_id = $idler->fetch()) {
			$urunid=$fav_id['urun_id'];
			
			if($gelen_id==$urunid)
				$tekrar=1;	
		}
		
		if($tekrar==0)
			$ekle=$list->exec("INSERT INTO favori (kullanici_id, urun_id) VALUES ('$kullanici_id','$gelen_id')");
		else
			echo " 
				<script type='text/javascript'>  
				
				alert('Eklemek istediğiniz ürün daha önce favorilere eklenmiştir.'); 
				
				</script> 
			";
	}
	
	
	
	$idler=$list->query("SELECT * FROM favori WHERE kullanici_id=$kullanici_id");
	
	while ($fav_id = $idler->fetch()) {
		$urunid=$fav_id['urun_id'];
		$favoriler=$list->query("SELECT * FROM urun WHERE urun_id=$urunid");
		
		while ($tekurun = $favoriler->fetch()) {
			
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
		
		<a href='favoriler.php?silinecek_id=$urunid'>
					Favorilerimden Çıkar
		</a>
		</td>
		</tr>
		</table>
		</center>
		";
		}
	}
	
	if(isset($_GET['silinecek_id']))
	{
		$s_id= $_GET['silinecek_id'];
		$silindi=$list->exec("DELETE FROM favori WHERE urun_id='$s_id' AND kullanici_id='$kullanici_id'");
		if($silindi)
		{
			header('location: favoriler.php');
		}
	}
}
else
{
	header('location: giris.php');
}