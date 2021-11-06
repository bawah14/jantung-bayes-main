<?php
$host="localhost";
$user="root";
$pass="";
$dbName="jantung_bayes";
$koneksi=mysqli_connect($host,$user,$pass,$dbName);
if(!$koneksi){
	echo"<center><font color='#ff0000'>Koneksi Gagal</font></center>";
	}
?>