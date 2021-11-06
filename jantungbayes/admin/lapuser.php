<?php 
include "../koneksi.php";
?>
<html>
<head>
<title>Tampilan Data Penyakit</title>
<script type="text/javascript">
function konfirmasi(id_user){
	var kd_hapus=id_user;
	var url_str;
	url_str="hapus_user.php?id_user="+kd_hapus;
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
<h2>Laporan Data Pasien</h2>
<div class="CSSTableGenerator">
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#22B5DD">
  <tr bordercolor="" bgcolor="#CCCCCC"> 
    <td width="29"><div align="center"><strong>No</strong></div></td>
    <td width="108"><div align="center"><b>Nama</b></div></td>
    <td width="76"><div align="center"><strong>Kelamin</strong></div></td>
    <td width="65" align="center"><div align="center"><strong>Umur</strong></div></td>
    <td width="138" align="center"><div align="center"><strong>Alamat</strong></div></td>
    <td width="154" align="center"><strong>Email</strong></td>
    <td width="325" align="center"><div align="center"><strong>Penyakit Yang diderita </strong></div></td>
    <td width="157" align="center"><strong>Tanggal Diagnosa</strong> </td>
  </tr>
  <?php 
	$sql = "SELECT * FROM tbpasien ORDER BY idpasien DESC";
	$qry = mysqli_query($koneksi,$sql )  or die ("SQL Error".mysqli_error());
	$no=0;
	while ($data=mysqli_fetch_array($qry)) {
	$no++;
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td><?php echo $no; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['kelamin']; ?></td>
    <td><?php echo $data['umur']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['email']; ?></td>
    <td><?php
    //menampilkan data penyakit yang pernah di diagnosa
	$strP=mysqli_query($koneksi,"SELECT * FROM tbhasil,tbpenyakit WHERE tbhasil.idpasien='$data[idpasien]' AND tbhasil.kd_penyakit=tbpenyakit.kd_penyakit ORDER BY tbhasil.bobotpenyakit DESC ");
	while($dataP=mysqli_fetch_array($strP)){
		echo $dataP['nama_penyakit']." (bobot = ".$dataP['bobotpenyakit'].")<br>";
		}
	?></td>
    <td><?php echo $data['tanggal']; ?>&nbsp;|<a title="hapus pengguna" style="cursor:pointer;" onClick="return konfirmasi('<?php echo $data['idpasien'];?>')"><img src="image/hapus.jpeg" width="16" height="16" ></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
</body>
</html>
