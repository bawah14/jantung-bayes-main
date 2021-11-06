<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Login|PakarJantung</title>
<link href="../Image/icon.png" rel='shortcut icon'>
<link rel="stylesheet" type="text/css" href="../style.css">
<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#username").focus();
	})
	function validasi(form){
		if(form.username.value==""){
			alert("Masukkan Username..!");
			form.username.focus();
			return false;
			}else if(form.password.value==""){
				alert("Masukkan Password Anda..!");
				form.password.focus();
				return false;
				}
			form.submit();
		}
</script>

</head>

<body>
 <br><br>
<table width="700" border="0" align="center">
    <tr>
      <td align="center">
                 <h1><a href="./index.html">SISTEM PAKAR DIAGNOSA PENYAKIT JANTUNG</a></h1>
                 <h2>Menggunakan Metode Bayes</h2>
       </td>
    </tr>
    <tr>
    <td width="310" height="220">
	<form name="form1" method="post" onSubmit="return validasi(this)" action="cekpswd.php" >
<table width="251" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="3"><div align="center"><strong>Login Admin</strong></div></td>
    </tr>
  <tr>
    <td width="86">Username</td>
    <td width="5">:</td>
    <td width="146">
      <input name="username" type="text" id="username">
    </td>
  </tr>
  <tr>
    <td>Password</td>
    <td>:</td>
    <td>
      <input name="password" type="password" id="password">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Login">&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="../index.php"> Kembali</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><a href="../index.php"></a></td>
	</tr>
</table>
    </form>
	</td>
  </tr>
    <tr>
      <td><p style="background-image:url(../images/footer.jpg); height:50px; text-align:center; padding:5px;">Copyright © 2018. All Rights Reserved. </p></td>
    </tr>
</table>
</body>
</html>
