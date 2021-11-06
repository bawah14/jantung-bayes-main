<?php 
include "koneksi.php";

?>
<html>
<head>
<title>Form Utama Penelusuran</title>
<script type="text/javascript" src="jquery-1.2.6.pack.js"></script>
<script type="text/javascript">
$(document).ready(function()
		{
			$("form").submit(function()
			{
				if (!isCheckedById("gejala"))
				{
					alert ("Anda Belum Memilih Gejala Apapun\nSilahkan Pilih Gejala..!");
					return false;
				}else{				
					return true; //submit the form
					}				
			});
			function isCheckedById(id)
			{
				var checked = $("input[@id="+id+"]:checked").length;
				if (checked == 0)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			// pilih bobot
			function isCheckedById2(id)
			{
				var checked = $("option[@id="+id+"]:checked").length;
				if (checked =="")
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			//--
		});
</script>
<style type="text/css">
ul {list-style:none;}
li {line-height:-6px; font-weight:normal; color:#09F;}
</style>
</head>
<body>
<div class="konten"><form  method="post" name="form" target="_self" action="?top=konsulperiksa.php">
  <table class="tab" width="700" border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#FFFFFF">
    <tr> 
      <td colspan="3"><div align="center"><strong>~ FORM DIAGNOSA JANTUNG~</strong></div></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><strong>Pilih gejala sedetail mungkin untuk mendapatkan hasil yang akurat</strong></td>
    </tr>
    <tr> 
	  <tr> <td colspan="3">&nbsp;</td></tr>
	<tr>
	  <td width="64" ></td>
	  <td width="625" >  
    <?php
	include "koneksi.php";
	$query=mysqli_query($koneksi,"SELECT * FROM tbgejala") or die("Query Error..!" .mysqli_error);
	while ($row=mysqli_fetch_array($query)){
	?>
    	<li style="list-style:none; font-family:'Courier New', Courier, monospace;"><input type="checkbox" name="gejala[]" id="gejala" value="<?php echo $row['kd_gejala'];?>"><?php echo "[".$row['kd_gejala']."]".$row['gejala'];?></li>
		 <?php } ?>
       </td> </tr>

	<tr>
	  <td width="64" align="right" bgcolor="#FFFFFF">&nbsp;</td>  
	  <td width="625" align="right" bgcolor="#FFFFFF"><input style="background-color:#06C; border:2px  solid #03C; font-family:Calibri; font-size:12pt;font-weight:bold;" type="submit" name="Submit" value="Proses Diagnosa">	  <input type="reset" style="background-color:#06C; border:2px  solid #03C; font-family:Calibri; font-size:12pt;font-weight:bold;" value="Reset">
	  <input type="button"  style="background-color:#06C; border:2px  solid #03C; font-family:Calibri; font-size:12pt;font-weight:bold;" onClick="self.history.back();" value="Kembali"></td>
    </tr>
  </table>
</form></div>
</body>
</html>
