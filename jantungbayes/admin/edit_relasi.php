<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Data Relasi</title>
<script type="text/javascript">
$(document).ready(function() {
 	$('div.TxtKdPenyakit option[value="<?php echo $_GET['kd_penyakit'];?>').prop("selected", true);
	$('TxtKdPenyakit').val("<?php echo $_GET['kd_penyakit'];?>");
	
	$('div.TxtKdGejala option[value="<?php echo $_GET['kd_gejala'];?>').prop("selected", true);
	$('TxtKdGejala').val("<?php echo $_GET['kd_gejala'];?>");
});
</script>
</head>
<body>
<h3>Edit Data Relasi</h3><hr />
<form id="form1" name="form1" method="post" action="update_relasi.php" enctype="multipart/form-data"><div>
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" bordercolor="#F0F0F0" bgcolor="#DBEAF5">
      <tr>
        <td colspan="2"><div align="center"><b>&nbsp;</b></div></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td>Kode</td>
        <td><div class="TxtKdPenyakit"><label>
        <select name="TxtKdPenyakit" id="TxtKdPenyakit">
          <option value="NULL">[ Daftar Penyakit ]</option>
          <?php 
	$sqlp = "SELECT * FROM tbpenyakit ORDER BY kd_penyakit";
	$qryp = mysqli_query($koneksi,$sqlp ) 
		    or die ("SQL Error: ".mysqli_error());
	while ($datap=mysqli_fetch_array($qryp)) {
		if ($datap['kd_penyakit']==$kdsakit) {
			$cek ="selected";
		}
		else {
			$cek ="";
		}
		echo "<option value='$datap[kd_penyakit]' $cek>$datap[kd_penyakit]&nbsp;|&nbsp;$datap[nama_penyakit]</option>";
	}
  ?>
        </select><?php $id_relasi=$_GET['id_relasi'];?>
        </label></div><input name="textrelasi" type="hidden" value="<?=$id_relasi?>" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="179">Gejala</td>
        <td width="252"><div class="TxtKdGejala">
          <select name="TxtKdGejala" id="TxtKdGejala">
            <option value="NULL">[ Daftar Gejala]</option>
            <?php 
	$sqlp = "SELECT * FROM tbgejala ORDER BY kd_gejala ASC";
	$qryg = mysqli_query($koneksi,$sqlp ) 
		    or die ("SQL Error: ".mysqli_error());
	while ($datag=mysqli_fetch_array($qryg)) {
		if ($datag['kd_gejala']==$kdgejala) {
			$cek ="selected";
		}
		else {
			$cek ="";
		}
		echo "<option value='$datag[kd_gejala]' $cek>$datag[kd_gejala]&nbsp;|&nbsp;$datag[gejala]</option>";
	}
  ?>
          </select></div>
         </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td>Nilai Probabilitas (H)</td>
        <td><input type="text" id="txtbobot" name="txtbobot" value="<?php echo $_GET['bobot']; ?>" size="10" />
ex(0.1, 0.2, 0.3, 0.11)</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit" value="Update" /><input type="button" value="Kembali" onclick="self.history.back();" /></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>