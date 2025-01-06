<a href="cikis.php"> Oturumu Kapat </a>
<?php
session_start();
if($_SESSION["tur"]=='admin')
{
	echo "
	<form action='' method='post'>
	Ürün Seri No: <input type='text' name='serino'><br>
	Ürün Adı:<input type='text' name='ad'><br>
	Adet: <input type='text' name='adet'><br>
	Fotoğraf: <input type='file' name='resim'><br>
	<input type='submit' name='urunkaydet' value='Ürünü Kaydet'><br>
	</form>
	";
	if(isset($_POST['urunkaydet']))
	{
		$s=$_POST['serino'];
		$a=$_POST['ad'];
		$adet=$_POST['adet'];
		$f=$_POST['resim'];
		$list = new PDO("mysql:host=localhost;dbname=oturum", 'root',''); 
		$ekle=$list->exec("INSERT INTO urun (serino,ad,adet,fotograf) VALUES ('$s','$a','$adet','$f')");
		if($ekle)
			echo "Kayıt başarılı";
	}
}
else
{
	header('location: giris.php');
}
?>