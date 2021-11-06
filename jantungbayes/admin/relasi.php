<html>
<head>
<style type="text/css">
p {text-indent:0pt;}
</style>
<script type="text/javascript">
function konfirmasi(id_rule){
	var kd_hapus=id_rule;
	var url_str;
	url_str="hapus_relasi.php?id_rule="+kd_hapus;
	var r=confirm("Yakin ingin menghapus data..?"+kd_hapus);
	if (r==true){   
		window.location=url_str;
		}else{
			//alert("no");
			}
	}
</script>
</head>
<body>
<h2>Data Relasi </h2><hr>
<ul class="sub-menu">
	<li><a href="haladmin.php?top=rule-penyakit.php">Nilai Probabilitas Penyakit P(H)</a></li>
    <li><a href="haladmin.php?top=relasi.php">Nilai Probabilitas Gejala P(E/H)</a></li>
</ul><br><br>
<div class="konten">
<?php
include "../koneksi.php";
?>
<form id="form1" name="form1" method="post" action="relasisim.php" enctype="multipart/form-data"><div>
  <table class="tab" width="100%" border="0" align="center" cellpadding="4" cellspacing="1" bordercolor="#F0F0F0" bgcolor="#CCCC99">
      <tr bgcolor="#FFFFFF">
        <td>Kode Penyakit</td>
        <td><label>
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
        </select>
        </label></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td width="124">Gejala</td>
        <td width="224">
          <select name="TxtKdGejala" id="TxtKdGejala">
            <option value="NULL">[ Daftar Gejala]</option>
            <?php 
	$sqlp = "SELECT * FROM tbgejala ORDER BY kd_gejala";
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
          </select>
         </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td>Nilai Probabilitas (H)</td>
        <td><input type="text" id="txtbobot" name="txtbobot" size="5" >
          ex(0.1, 0.2, 0.3, 0.11)</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit" value="Simpan" /></td>
      </tr>
    </table>
  </div>
</form>
<table width="100%" border="0" cellpadding="4" cellspacing="1" bordercolor="#F0F0F0" >
  <tr>
    <td width="32"><strong>No</strong></td>
    <td width="105"><strong>Gejala</strong></td>
    <td width="535"><strong>Nama Penyakit</strong><span style="float:right; margin-right:25px;"><strong></strong></span></td>
    </tr>
    <?php
    $query=mysqli_query($koneksi,"SELECT tbrule.kd_gejala,tbrule.kd_penyakit, tbpenyakit.kd_penyakit, tbpenyakit.nama_penyakit AS penyakit FROM tbrule,tbpenyakit WHERE tbpenyakit.kd_penyakit=tbrule.kd_penyakit GROUP BY tbrule.kd_penyakit")or die(mysqli_error());
	$no=0;
	while($row=mysqli_fetch_array($query)){
	$idpenyakit=$row['kd_penyakit'];
	$no++;
	?>
  <tr bgcolor="#FFFFFF" bordercolor="#333333">
    <td valign="top"><?php echo $no;?></td>
    <td valign="top"><?php
    //$query2=mysqli_query($koneksi,"SELECT relasi.kd_gejala,gejala.kd_gejala FROM relasi,gejala WHERE gejala.kd_gejala='$idpenyakit'")or die(mysqli_error());
	//$query2=mysqli_query($koneksi,"SELECT relasi.kd_gejala FROM relasi WHERE relasi.kd_penyakit='$idpenyakit'")or die(mysqli_error());
	$query2=mysqli_query($koneksi,"SELECT tbrule.id_rule, tbrule.kd_gejala, tbrule.bobot, tbrule.kd_penyakit, tbgejala.gejala AS namagejala FROM tbrule,tbgejala WHERE tbrule.kd_penyakit='$idpenyakit' AND tbgejala.kd_gejala=tbrule.kd_gejala ORDER BY tbrule.kd_gejala ASC")or die(mysqli_error());
	while ($row2=mysqli_fetch_array($query2)){
		$kd_gej=$row2['kd_gejala'];
		$kd_pen=$row2['kd_penyakit'];
		echo "<table width='600' border='0' cellpadding='4' cellspacing='1' bordercolor='#F0F0F0' bgcolor='#DBEAF5'>";
		echo "<tr bgcolor='#FFFFFF' bordercolor='#333333'>";
		echo "<td width='50'>$row2[kd_gejala]</td>";
		echo "<td width='300'>$row2[namagejala]</td>";
		echo "<td width='50'>$row2[bobot]</td>";
		echo "<td width='20'><a title='Edit Relasi' href='haladmin.php?top=edit_relasi.php&id_relasi=$row2[id_rule]&bobot=$row2[bobot]&kd_penyakit=$row2[kd_penyakit]&kd_gejala=$row2[kd_gejala]'>Edit</a></td>";
		echo "<td width='20'><a title='Hapus Relasi' style='cursor:pointer;' onclick='return konfirmasi($row2[id_rule])'>Hapus</a></td>";
		echo "</tr>";
		echo "</table>";
		}
	?>      <br /></td>
    <td><?php echo $row['kd_penyakit'];?>
      &nbsp;|&nbsp;<strong>
      <?php echo $row['penyakit'];?>
      </strong></td>
    </tr><?php } ?>
</table>
</div>
</body>
</html>