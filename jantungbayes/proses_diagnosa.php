<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proses Diagnosa</title>
<style type="text/css">
p{ padding-left:2px; text-indent:0px;}
</style>
</head>
<body>
<div class="konten">
<div style="text-align:center; background:linear-gradient(to top, #C33, #C90); color:#ffffff; font-family:Calibri; border-radius:50px 50px; height:25px; margin-bottom:8px;">
<a style="background-color:#C90;" href="index.php?top=konsultasifm.php"><strong>ULANG DIAGNOSA</strong></a>
<a style="background-color:#99AB74;" href="index.php?top=home.php"><strong>BACK HOME</strong></a>Hasil Diagnosa Penyakit JANTUNG</div>
<?php
include "koneksi.php";
// kosongkan tabel tmp_penyakit
$kosong_tmp_penyakit=mysqli_query($koneksi,"DELETE FROM tmp_penyakit");
$sqlpenyakit="SELECT * FROM tbrule GROUP BY kd_penyakit ";
$querypenyakit=mysqli_query($koneksi,$sqlpenyakit);
$Similarity=0;
echo"<div style='display:none;'>";
echo "</div>";
?> 

<div style="float:left; position:inherit; width:320px;"><table width="330" height="158" border="1" style="float:left;">
  <tr>
    <td height="22"><h5>Hasil Analisa Diagnosa Penyakit Jantung Dengan Metode Bayes</h5></td>
  </tr>
  <tr>
    <td height="99">
	    <table width="170" border="1">
  <tr>
    <td width="60" rowspan="2" align="right"><br />P(H\E) =</td>
    <td width="94">P(E\H) * P(H)<hr />P(E)</td>
  </tr>
</table><hr />
	<?php
	// retrive data penyakit
	echo "<strong>PROSES PERHITUNGAN NILAI BAYES</strong><BR><BR>";
	//menampilkan gejala terpilih
		echo "<div style='border-radius:50px 50px;background-color:#C33; padding:2px 2px 2px 5px; color:#ffffff;'><strong>GEJALA YANG DIALAMI</strong></div>";
	$query_gejala_input=mysqli_query($koneksi,"SELECT tbgejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM tbgejala,tmp_gejala WHERE tmp_gejala.kd_gejala=tbgejala.kd_gejala");
	$nogejala=0;
	while($row_gejala_input=mysqli_fetch_array($query_gejala_input)){
		$nogejala++;
		echo "<li style='list-style:none;'><img src='images/checkbox.jpg' width='20' height='20'><strong>"."[$row_gejala_input[kd_gejala]] " . $row_gejala_input['namagejala']. "</strong></li>";
		$kd_gejalaTmp=$row_gejala_input['kd_gejala'];
		$NilaiProbabilitasGejalaH=mysqli_query($koneksi,"SELECT * FROM tbrule WHERE kd_gejala='$kd_gejalaTmp' ");
		$dataProbabilitasGejalaH=mysqli_fetch_array($NilaiProbabilitasGejalaH);
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nilai Probablitas Gejala : ".$dataProbabilitasGejalaH['bobot']."<br>";
		} echo "<br>";
	//$strKosongtmpanalisa=mysqli_query($koneksi," DELETE FROM tmp_analisa");
	$strEmptyTotalBayes=mysqli_query($koneksi," DELETE FROM tmp_totalbayes ");
	$strP=mysqli_query($koneksi,"SELECT * FROM tbrule,tbpenyakit WHERE tbrule.kd_penyakit=tbpenyakit.kd_penyakit GROUP BY tbrule.kd_penyakit  ORDER BY tbrule.kd_penyakit ASC");
	while($dataP=mysqli_fetch_array($strP)){
		echo "<span style='font-weight:bold; color:red; text-decoration:underline;'>PROSES PERHITUNGAN KASUS : " .$dataP['kd_penyakit']." ( $dataP[nama_penyakit])"."</span><br>";
		//ambil nilai propobilitas (H)
		$kd_penyakitP=$dataP['kd_penyakit'];
		$strProbabilitasPHE=mysqli_query($koneksi,"SELECT * FROM  nilai_probabilitas_p WHERE kd_penyakit='$kd_penyakitP' ");
		$dataProbabilitasPHE=mysqli_fetch_array($strProbabilitasPHE);
		echo "<span style='font-weight:bold; color:blue;'>nilai probabilitas $kd_penyakitP = ".$dataProbabilitasPHE['nilai']."</span><br>";
		//retrive data gejala pada penyakit
		$strGejala=mysqli_query($koneksi,"SELECT * FROM tmp_gejala ORDER BY kd_gejala ASC");
		$Proses=0; $nilaiBagi=0;
		while ($dataGejala=mysqli_fetch_array($strGejala)){
			echo "<span style='color:green;'>Gejala yang di alami : ".$dataGejala['kd_gejala']."</span><br>";
			//ambil data bobot gejala per penyakit
			$kd_gejalaP=$dataGejala['kd_gejala'];
			$strGejalaBobot=mysqli_query($koneksi,"SELECT * FROM tbrule WHERE kd_gejala='$kd_gejalaP' AND kd_penyakit='$kd_penyakitP' ");
			$Proses=$Proses+1;
			$dataGejalaBobot=mysqli_fetch_array($strGejalaBobot);
				//echo "H(" .$kd_gejalaP ."=".$dataGejalaBobot['bobot']."<br>";
				echo "H (".$kd_penyakitP."|".$dataGejalaBobot['kd_gejala'].") = <strong>[</strong>H(".$kd_gejalaP."|".$kd_penyakitP.") * H($kd_penyakitP)<strong>]</strong> /";
				echo "<br>";
				if(empty($dataGejalaBobot['bobot'])){ $dataGBobot=0;}else{ $dataGBobot=$dataGejalaBobot['bobot'];};
				echo "H($kd_penyakitP|$kd_gejalaP) = $dataGBobot * $dataProbabilitasPHE[nilai] <br>";
				echo "<hr style='margin-left:80px;'>";
				//echo "<span style='margin-left:80px;'>$dataGejalaBobot[bobot] x $dataProbabilitasPHE[nilai] + "; 
				echo "<span style='margin-left:80px;'>";
				
				//mengambil nilai probabilitas pada hipotesis nilai H pada setiap penyakit
				$strH_nPenyakit=mysqli_query($koneksi,"SELECT * FROM nilai_probabilitas_p ORDER BY kd_penyakit ASC");
				echo "<strong>[</strong> H ";
				$NilaiProbabilitasEvidencePH=0; $nPH=0; $nilaiBawah=0;
				$strKosongtmpanalisa=mysqli_query($koneksi," DELETE FROM tmp_analisa ");
				while ($dataH_nPenyakit=mysqli_fetch_array($strH_nPenyakit)){
					//mencari gejala di tbrule apakah ad, jika tidak ad maka akan bernilai True=value, jika False=0
					//$NilaiProbabilitasEvidencePH=0;
					$kd_penyakitH_n=$dataH_nPenyakit['kd_penyakit'];
					$strGejalatbrule=mysqli_query($koneksi,"SELECT * FROM tbrule WHERE kd_penyakit='$kd_penyakitH_n' AND kd_gejala='$kd_gejalaP' ");
					$dataGejalatbrule=mysqli_fetch_array($strGejalatbrule);
					if (!empty($dataGejalatbrule)){ $NbobotGejalaR=$dataGejalatbrule['bobot']; }else { $NbobotGejalaR=0;}
					//$NbobotGejalaR=$dataGejalatbrule['bobot'];
					echo "($kd_gejalaP|".$dataH_nPenyakit['kd_penyakit'].") x H(".$dataH_nPenyakit['kd_penyakit']. ") + ";
					//echo "<hr style='margin-left:80px;color:red;'>";
					echo "<span style='color:red; font-weight:bold;';>";
					echo "H ($kd_gejalaP = $NbobotGejalaR |".$dataH_nPenyakit['kd_penyakit']."=".$dataH_nPenyakit['nilai'].") +<br>";
					echo "$NbobotGejalaR x ".$dataH_nPenyakit['nilai']; $nPH=$NbobotGejalaR*$dataH_nPenyakit['nilai']; echo "=$nPH)";
					$NilaiProbabilitasEvidencePH=$nPH; echo "[nilai evidence=".$NilaiProbabilitasEvidencePH."]";
					//$NilaiProbabilitasEvidencePH=$NilaiProbabilitasEvidencePH+$nPH; echo "(jumlah evidence = $NilaiProbabilitasEvidencePH)";
					//input nilai kedalam tabel tmp_analisa
					$kdProses="Proses".$Proses;
					$strNilaiProbEvidence=mysqli_query($koneksi,"INSERT INTO tmp_analisa(kd_proses,kd_penyakit,kd_gejala,nilaiPH) VALUES ('$kdProses','$kd_penyakitH_n','$kd_gejalaP','$NilaiProbabilitasEvidencePH') ");
					//$nilaiBawah=$NilaiProbabilitasEvidencePH+$nPH; echo "(nilai bawah = $nilaiBawah)";
					echo "</span>"; //$nPH=0;
					}  echo "<strong>]</strong>";
					//sum nilai tmp_analisa
					$strSumTmpAnalisa=mysqli_query($koneksi,"SELECT SUM(nilaiPH) AS NilaiSumPH FROM tmp_analisa");
					$dataSumTmpAnalisa=mysqli_fetch_array($strSumTmpAnalisa);
					echo "sum $dataSumTmpAnalisa[NilaiSumPH]"; $nilaiSum=$dataSumTmpAnalisa['NilaiSumPH'];
					$strInsertTmpPenyakit=mysqli_query($koneksi,"INSERT INTO tmp_penyakit(kd_penyakit, kd_gejala, nilai) VALUES ('$kd_penyakitP','$kd_gejalaP','$nilaiSum' )");
				echo "</span><br>";
				
				//jumlahkan h1*g1
				$bobotG=$dataGejalaBobot['bobot']; $bobotP=$dataProbabilitasPHE['nilai']; $NilaiPHAtas=$bobotG*$bobotP;
				echo "H($kd_penyakitP|$dataGejalaBobot[kd_gejala] = $NilaiPHAtas";
				echo "<hr style='margin-left:80px;'>";
				echo "<span style='margin-left:80px;'>$nilaiSum </span><br>";//$NilaiProbabilitasEvidencePH</span><br>";
				//$HasilBagiPHgejalaPHpenyakit=$NilaiPHAtas/$NilaiProbabilitasEvidencePH;
				$nilaiBagi=$NilaiPHAtas/$nilaiSum;
				echo "H($kd_penyakitP|$dataGejalaBobot[kd_gejala] =  $nilaiBagi<br><br>";
				//memasukkan kedalam tabel nilai bayes
				$strTotalBayes=mysqli_query($koneksi,"INSERT INTO  tmp_totalbayes (kd_penyakit,kd_gejala,totalbayes) VALUES ('$kd_penyakitP','$kd_gejalaP','$nilaiBagi')");
			}$Proses=$Proses+1;
			echo "<hr>";
		}
	?>
</td>
  </tr>
</table></div>
<div style="float:left; min-height:500px; margin-left:20px;"><table width="430" border="0" bgcolor="#0099FF" cellspacing="1" cellpadding="4" bordercolor="#0099FF">
  <tr bgcolor="#ffffff">
    <td width="408" height="32"  style="color:#C60;">
    <div style='border-radius:50px 50px;background-color:#C33; padding:2px 2px 2px 5px; color:#ffffff;'><strong>HASIL DIAGNOSA</strong></div>
    <?php
    include "koneksi.php";
	//menampilkan data pasien
	echo "<p style='color:#06F; font-size:13pt; font-weight:bold; font-family:Times New Roman;'>Data Pasien :</p> ";
	$str_pasien=mysqli_query($koneksi,"SELECT * FROM tbpasien ORDER BY idpasien DESC");
	$data_pasien=mysqli_fetch_array($str_pasien);
	echo "<table width='300' border='0'>
		  <tr>
			<td width='67'>Nama</td>
			<td width='8'>:</td>
			<td width='203'>$data_pasien[nama]</td>
		  </tr>
		  <tr>
			<td>Kelamin</td>
			<td>:</td>
			<td>$data_pasien[kelamin]</td>
		  </tr>
		  <tr>
			<td>Umur</td>
			<td>:</td>
			<td>$data_pasien[umur]</td>
		  </tr>
		  <tr>
			<td>Alamat</td>
			<td>:</td>
			<td>$data_pasien[alamat]</td>
		  </tr>
		  <tr>
			<td>Email</td>
			<td>:</td>
			<td>$data_pasien[email]</td>
		  </tr>
		</table>";
	echo "<p style='color:#06F; font-size:13pt; font-weight:bold; font-family:Times New Roman;'>Berdasarkan Gejala yang di alami pasien yaitu :</p> ";
	$query_gejala_input=mysqli_query($koneksi,"SELECT tbgejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM tbgejala,tmp_gejala WHERE tmp_gejala.kd_gejala=tbgejala.kd_gejala");
	$nogejala=0;
	while($row_gejala_input=mysqli_fetch_array($query_gejala_input)){
		$nogejala++;
		echo "<li style='list-style:none;'><img src='images/checkbox.jpg' width='20' height='20'><strong>" . $row_gejala_input['namagejala']. "</strong></li>";
		}
	?>
    <p style=" color:#06F; font-size:13pt; font-weight:bold; font-family:'Times New Roman';">Maka dapat disimpulkan penyakit :</p>
    <?php
    $strHasilBayes=mysqli_query($koneksi,"SELECT kd_penyakit, SUM(totalbayes)AS nilaiBayesTotal FROM tmp_totalbayes WHERE NOT totalbayes='0' GROUP BY kd_penyakit ORDER BY nilaiBayesTotal DESC ");
	while($dataHasilBayes=mysqli_fetch_array($strHasilBayes)){
		echo "<li>$dataHasilBayes[kd_penyakit] |";
		$bobotHasil=substr($dataHasilBayes['nilaiBayesTotal'],0,5);
		echo "bobot = ".$bobotHasil; echo "&nbsp;&nbsp;";
		$kd_penyakitS=$dataHasilBayes['kd_penyakit'];
		$strPenyakitSolusi=mysqli_query($koneksi,"SELECT * FROM tbpenyakit WHERE kd_penyakit='$kd_penyakitS' ");
		$dataPenyakitSolusi=mysqli_fetch_array($strPenyakitSolusi);
		echo "<span style='font-size:12pt; color:#99cc99; font-weight:bold; text-decoration:underline;'>Nama Penyakit : ".$dataPenyakitSolusi['nama_penyakit']."</span><br>";
		echo "<div style='font-size:9pt; color:#333; border:1px solid #999; padding:2px 2px 2px 2px; max-height:80px; overflow:auto; '><strong>Definisi Penyakit :</strong> ".$dataPenyakitSolusi['definisi']."</div><br>";
		echo "<div style='font-size:9pt; color:#333; border:1px solid #999; padding:2px 2px 2px 2px; max-height:100px; overflow:auto; '><strong>Solusi Penanganan :</strong> ".$dataPenyakitSolusi['solusi']."</div><br>";
		echo "</li><hr>";
		//memasukkan data pasien ke tabel hasil
		$strHasil=mysqli_query($koneksi,"INSERT INTO tbhasil (idpasien,kd_penyakit,bobotpenyakit,tanggal_diagnosa) VALUES ('$data_pasien[idpasien]','$kd_penyakitS','$bobotHasil', NOW() )");
		}
	?>
    </td>
  </tr>
</table></div>
</div>
</body>
</html>