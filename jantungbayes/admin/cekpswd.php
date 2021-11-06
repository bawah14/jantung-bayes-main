<?php
session_start();
include "../koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];

if (trim($username)=="") {
	///include "login2.php"; 
	echo "<div align=center><b>Nama Belum diisi !!</b><br>";
	echo "Harap diisi terlebih dahulu</div>";
	exit;
}
elseif (trim($password)=="") {
	//include "login3.php"; 
	echo "<div align=center><b>Password Belum diisi !!</b><br>";
	echo "Harap diisi terlebih dahulu</div>";
	exit;
}
$passwordhash = md5($password);  // mengenkripsikannya untuk dicocokan dengan database
$perintahnya = "select username, password from login where username = '$username' and PASSWORD = '$password'";
$jalankanperintahnya = mysqli_query($koneksi,$perintahnya);
$ada_apa_enggak = mysqli_num_rows($jalankanperintahnya);
if ($ada_apa_enggak >= 1 )
{
		$_SESSION['user_forum']=$username;
		$_SESSION['user_password']=$password;
header("location: haladmin.php?top=home.php");
}
else
include "login.php";
echo "<div align=center>Username dan Password tidak sesuai</div>";      
?>