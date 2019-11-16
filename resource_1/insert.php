<?php 
require_once("proses.php");

$jenis 		= $_POST['jenis'];
$jumlah 	= $_POST['jumlah'];
$kondisi 	= $_POST['kondisi'];
$alamat 	= $_POST['alamat'];
$kontak 	= $_POST['kontak'];

$image 	= addslashes($_FILES['image']['tmp_name']);
$name 	= addslashes($_FILES['image']['tmp_name']);
$image 	= file_get_contents($image);
$image	= base64_encode($image);

$SQL = "INSERT into tbl_donasi (jenis_donasi,jumlah_donasi,kondisi_donasi,alamat_donasi,kontak_donasi,gambar_donasi) values('$jenis','$jumlah','$kondisi','$alamat','$kontak','$image')";
//echo "$SQL";
if (mysqli_query($con, $SQL)) {
	echo "Sukses";
	echo '<a href="display.php">DISPLAY</a>';
}
else{
	echo "<br>Gagal ini";
 }
 ?>
