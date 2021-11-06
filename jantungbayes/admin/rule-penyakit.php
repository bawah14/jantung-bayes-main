<html>
<head>
<style type="text/css">
p {text-indent:0pt;}
</style>
<script type="text/javascript">
function konfirmasi(id_relasi){
	var kd_hapus=id_relasi;
	var url_str;
	url_str="hapus_relasi_p.php?kd_penyakit="+kd_hapus;
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
<h2 class="art-postheader">Data Rule Penyakit</h2>
<ul class="sub-menu">
	<li><a href="haladmin.php?top=rule-penyakit.php">Nilai Probabilitas Penyakit P(H)</a></li>
    <li><a href="haladmin.php?top=relasi.php">Nilai Probabilitas Gejala P(E/H)</a></li>
</ul><br><br>
<hr>

<div class="konten">
<?php
//include "inc.connect/connect.php"; 
include "../koneksi.php";
//$kdsakit = $_REQUEST['kdsakit'];
//$kdgejala= $_REQUEST['kd_gejala'];
?>
<form id="form1" name="form1" method="post" action="relasisim_p.php" enctype="multipart/form-data"><div>
  <table class="tab" width="528" border="0" align="center" cellpadding="4" cellspacing="1" bordercolor="#F0F0F0" bgcolor="#CCCC99">
      <tr bgcolor="#FFFFFF">
        <td width="124">Kode</td>
        <td width="224"><label>
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
        <td>Nilai Probabilitas <em>(H)</em></td>
        <td><input type="text" id="txtbobot" name="txtbobot" size="10"> 
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
    <td width="27"><strong>No</strong></td>
    <td width="507"><strong>Nama Penyakit</strong><span style="float:right; margin-right:25px;"><strong></strong></span></td>
    <td width="331">Nilai Probabilitas <em>(H)</em> <br>Terhadap Penyakit <em>P(E)</em></td>
    <td width="167">Aksi</td>
    </tr>
    <?php
    $query=mysqli_query($koneksi,"SELECT * FROM nilai_probabilitas_p,tbpenyakit WHERE nilai_probabilitas_p.kd_penyakit=tbpenyakit.kd_penyakit  ORDER BY nilai_probabilitas_p.kd_penyakit ASC")or die(mysqli_error());
	$no=0;
	while($row=mysqli_fetch_array($query)){
	$idpenyakit=$row['kd_penyakit'];
	$no++;
	?>
  <tr bgcolor="#FFFFFF" bordercolor="#333333">
    <td valign="top"><?php echo $no;?></td>
    <td><?php echo $row['kd_penyakit'];?>
      &nbsp;|&nbsp;<strong>
      <?php echo $row['nama_penyakit'];?>
      </strong></td>
    <td><strong><?php echo $row['nilai'];?></strong></td>
    <td><a title='Edit rule penyakit' href='haladmin.php?top=edit_rule_p.php&kd_penyakit=<?php echo $row['kd_penyakit']; ?>&bobot=<?php echo $row['nilai']; ?>'>Edit</a> | <a style="cursor:pointer;" title='Edit rule penyakit' onclick='return konfirmasi(<?php echo $row['kd_penyakit']; ?>)'>Hapus</a></td>
    </tr>
  <?php } ?>
</table>
</div>
</body>
</html>