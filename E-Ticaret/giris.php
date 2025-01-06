<body bgcolor="#e0e0e0">
<center>KULLANICI GİRİŞ SAYFASI<BR><BR><table width="600">
<form action="" method="post">
<tr>
<td>Kullanıcı adı:</td>
<td><input type="text" name="kadi"></td>
</tr>
<tr>
<td>Şifre:</td>
<td><input type="password" name="parola"></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="Giriş Yap" name="giris">
</td>
</tr>
</form>
</table></center>
</body>
<?php
if(isset($_POST['giris']))
{
	
	$kullanici_adi=$_POST['kadi'];
	$sifre=$_POST['parola'];
	
	$list = new PDO("mysql:host=localhost;dbname=oturum", 'root',''); //bağlantı kodu
	
	$listele= $list-> query("SELECT * FROM kullanici");
	while ($row = $listele->fetch()) {
		
		if ($kullanici_adi==$row['kullaniciAdi'] && $sifre==$row['sifre'])
		{   
			session_start();  //oturumu başlat
			
			$_SESSION["kullaniciadi"] = $row['kullaniciAdi'];
			$_SESSION["kullanicisifresi"] = $row['sifre'];
			$_SESSION["tur"]=$row['kullanici_turu'];
			$_SESSION["id"]=$row['kullanici_id'];
			
			
			if($_SESSION["tur"]=='admin')
				header('location: admin.php');
			elseif($_SESSION["tur"]=='kullanici')
				header('location: kullanici.php');
	    }
	}
}
?>