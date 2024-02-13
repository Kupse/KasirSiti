<?php 
$koneksi = mysqli_connect("localhost","root","","upk_kasir_sitipabillah");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>