<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsul extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Db');
    }

    public function index()
    {

        $data['title'] = 'Konsul';
		$data['gejala'] = $this->Db->manualQuery("SELECT * FROM tbgejala")->result_array();
        $this->load->view('__layout/header', $data);
        $this->load->view('__layout/sidebar', $data);
        $this->load->view('__layout/topbar', $data);
        $this->load->view('konsul/index', $data);
        $this->load->view('__layout/footer');
    }
    
    public function konsulHandler()
    {
        $_POST['gejala'] = [];
        foreach ($_POST as $key => $value) {
            # code...
            if($key != "gejala")
                array_push($_POST['gejala'],$key);
        }
        $gejala 	= '';
        if (isset($_POST['gejala']))
        {
            $selectors 	= htmlentities(implode(',', $_POST['gejala']));
        }
        $data=$selectors;
        $input = $data;
            $pecah = explode("\r\n\r\n", $input);
            $text = "";
            for ($i=0; $i<=count($pecah)-1; $i++)
            {
                $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
                $text .=$part;
            }

        $kosongtabel=$this->Db->manualQuery("DELETE FROM tmp_gejala");
        $text_line=$data;
        $text_line =$data; //"Poll number 1, 1500, 250, 150, 100, 1000";
        $text_line = explode(",",$text_line);
        $posisi=0;
        for ($start=0; $start < count($text_line); $start++) {
            $baris=$text_line[$start]; //echo "$baris<br>";
            $sql="INSERT INTO tmp_gejala (kd_gejala) VALUES ('$baris')";
            $query=$this->Db->manualQuery($sql);
            $posisi++;
        }
        $this->diagnosa();

    }

    
    public function diagnosa()
    {
        error_reporting(0);
        $result="";
        $kosong_tmp_penyakit = $this->Db->manualQuery("DELETE FROM tmp_penyakit");
        $sqlpenyakit="SELECT * FROM tbrule GROUP BY kd_penyakit ";
        $querypenyakit=$this->Db->manualQuery($sqlpenyakit);
        $Similarity=0;
        $result.= "<strong>PROSES PERHITUNGAN NILAI BAYES</strong><BR><BR>";
	//menampilkan gejala terpilih
		$result.= "<div style='border-radius:50px 50px;background-color:#C33; padding:2px 2px 2px 5px; color:#ffffff;'><strong>GEJALA YANG DIALAMI</strong></div>";
        $query_gejala_input=$this->Db->manualQuery("SELECT tbgejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM tbgejala,tmp_gejala WHERE tmp_gejala.kd_gejala=tbgejala.kd_gejala");
        $nogejala=0;
        // print_r($query_gejala_input);
        // print_r($query_gejala_input->result_array());
        foreach($query_gejala_input->result_array()  as $row_gejala_input){
            $nogejala++;
            // print_r($row_gejala_input);
            $result.= "<li style='list-style:none;'><img src='https://img.icons8.com/external-kiranshastry-lineal-color-kiranshastry/64/000000/external-check-banking-and-finance-kiranshastry-lineal-color-kiranshastry.png' width='20' height='20'/><strong>"."[$row_gejala_input[kd_gejala]] " . $row_gejala_input['namagejala']. "</strong></li>";
            $kd_gejalaTmp=$row_gejala_input['kd_gejala'];
            $NilaiProbabilitasGejalaH=$this->Db->manualQuery("SELECT * FROM tbrule WHERE kd_gejala='$kd_gejalaTmp' ");
            $dataProbabilitasGejalaH=($NilaiProbabilitasGejalaH)->result_array()[0];
            $result.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nilai Probablitas Gejala : ".$dataProbabilitasGejalaH['bobot']."<br>";
            } $result.= "<br>";
        //$strKosongtmpanalisa=$this->Db->manualQuery(" DELETE FROM tmp_analisa");
        $strEmptyTotalBayes=$this->Db->manualQuery(" DELETE FROM tmp_totalbayes ");
        $strP=$this->Db->manualQuery("SELECT * FROM tbrule,tbpenyakit WHERE tbrule.kd_penyakit=tbpenyakit.kd_penyakit GROUP BY tbrule.kd_penyakit  ORDER BY tbrule.kd_penyakit ASC");
        foreach(($strP)->result_array() as $dataP){
            $result.= "<span style='font-weight:bold; color:red; text-decoration:underline;'>PROSES PERHITUNGAN KASUS : " .$dataP['kd_penyakit']." ( $dataP[nama_penyakit])"."</span><br>";
            //ambil nilai propobilitas (H)
            $kd_penyakitP=$dataP['kd_penyakit'];
            $strProbabilitasPHE=$this->Db->manualQuery("SELECT * FROM  nilai_probabilitas_p WHERE kd_penyakit='$kd_penyakitP' ");
            $dataProbabilitasPHE=($strProbabilitasPHE)->result_array()[0];
            $result.= "<span style='font-weight:bold; color:blue;'>nilai probabilitas $kd_penyakitP = ".$dataProbabilitasPHE['nilai']."</span><br>";
            //retrive data gejala pada penyakit
            $strGejala=$this->Db->manualQuery("SELECT * FROM tmp_gejala ORDER BY kd_gejala ASC");
            $Proses=0; $nilaiBagi=0;
            foreach (($strGejala)->result_array() as $dataGejala){
                $result.= "<span style='color:green;'>Gejala yang di alami : ".$dataGejala['kd_gejala']."</span><br>";
                //ambil data bobot gejala per penyakit
                $kd_gejalaP=$dataGejala['kd_gejala'];
                // $result.= ("SELECT * FROM tbrule WHERE kd_gejala='$kd_gejalaP' AND kd_penyakit='$kd_penyakitP' ");
                $strGejalaBobot=$this->Db->manualQuery("SELECT * FROM tbrule WHERE kd_gejala='$kd_gejalaP' AND kd_penyakit='$kd_penyakitP' ");
                $Proses=$Proses+1;
                // $result.= ("SELECT * FROM tbrule WHERE kd_gejala='$kd_gejalaP' AND kd_penyakit='$kd_penyakitP' ");

                    //$result.= "H(" .$kd_gejalaP ."=".$dataGejalaBobot['bobot']."<br>";
                $dataGejalaBobot=($strGejalaBobot)->result_array()[0];
                    
                if(empty($dataGejalaBobot) ){ $dataGBobot=0;}else{ $dataGBobot=$dataGejalaBobot['bobot'];};$result.= "H (".$kd_penyakitP."|".$dataGejalaBobot['kd_gejala'].") = <strong>[</strong>H(".$kd_gejalaP."|".$kd_penyakitP.") * H($kd_penyakitP)<strong>]</strong> /";
                $result.= "<br>";
                $result.= "H($kd_penyakitP|$kd_gejalaP) = $dataGBobot * $dataProbabilitasPHE[nilai] <br>";
                $result.= "<hr style='margin-left:80px;'>";
                //$result.= "<span style='margin-left:80px;'>$dataGejalaBobot[bobot] x $dataProbabilitasPHE[nilai] + "; 
                $result.= "<span style='margin-left:80px;'>";
                
                //mengambil nilai probabilitas pada hipotesis nilai H pada setiap penyakit
                $strH_nPenyakit=$this->Db->manualQuery("SELECT * FROM nilai_probabilitas_p ORDER BY kd_penyakit ASC");
                $result.= "<strong>[</strong> H ";
                $NilaiProbabilitasEvidencePH=0; $nPH=0; $nilaiBawah=0;
                $strKosongtmpanalisa=$this->Db->manualQuery(" DELETE FROM tmp_analisa ");
                foreach (($strH_nPenyakit)->result_array() as $dataH_nPenyakit){
                    //mencari gejala di tbrule apakah ad, jika tidak ad maka akan bernilai True=value, jika False=0
                    //$NilaiProbabilitasEvidencePH=0;
                    $kd_penyakitH_n=$dataH_nPenyakit['kd_penyakit'];
                    $strGejalatbrule=$this->Db->manualQuery("SELECT * FROM tbrule WHERE kd_penyakit='$kd_penyakitH_n' AND kd_gejala='$kd_gejalaP' ");
                    $dataGejalatbrule=($strGejalatbrule)->result_array();
                    if (!empty($dataGejalatbrule)){ $NbobotGejalaR=$dataGejalatbrule[0]['bobot']; }else { $NbobotGejalaR=0;}
                    //$NbobotGejalaR=$dataGejalatbrule['bobot'];
                    $result.= "($kd_gejalaP|".$dataH_nPenyakit['kd_penyakit'].") x H(".$dataH_nPenyakit['kd_penyakit']. ") + ";
                    //$result.= "<hr style='margin-left:80px;color:red;'>";
                    $result.= "<span style='color:red; font-weight:bold;';>";
                    $result.= "H ($kd_gejalaP = $NbobotGejalaR |".$dataH_nPenyakit['kd_penyakit']."=".$dataH_nPenyakit['nilai'].") +<br>";
                    $result.= "$NbobotGejalaR x ".$dataH_nPenyakit['nilai']; $nPH=$NbobotGejalaR*$dataH_nPenyakit['nilai']; $result.= "=$nPH)";
                    $NilaiProbabilitasEvidencePH=$nPH; $result.= "[nilai evidence=".$NilaiProbabilitasEvidencePH."]";
                    //$NilaiProbabilitasEvidencePH=$NilaiProbabilitasEvidencePH+$nPH; $result.= "(jumlah evidence = $NilaiProbabilitasEvidencePH)";
                    //input nilai kedalam tabel tmp_analisa
                    $kdProses="Proses".$Proses;
                    $strNilaiProbEvidence=$this->Db->manualQuery("INSERT INTO tmp_analisa(kd_proses,kd_penyakit,kd_gejala,nilaiPH) VALUES ('$kdProses','$kd_penyakitH_n','$kd_gejalaP','$NilaiProbabilitasEvidencePH') ");
                    //$nilaiBawah=$NilaiProbabilitasEvidencePH+$nPH; $result.= "(nilai bawah = $nilaiBawah)";
                    $result.= "</span>"; //$nPH=0;
                    }  $result.= "<strong>]</strong>";
                    //sum nilai tmp_analisa
                    $strSumTmpAnalisa=$this->Db->manualQuery("SELECT SUM(nilaiPH) AS NilaiSumPH FROM tmp_analisa");
                    $dataSumTmpAnalisa=($strSumTmpAnalisa)->result_array()[0];
                    $result.= "sum $dataSumTmpAnalisa[NilaiSumPH]"; $nilaiSum=$dataSumTmpAnalisa['NilaiSumPH'];
                    $strInsertTmpPenyakit=$this->Db->manualQuery("INSERT INTO tmp_penyakit(kd_penyakit, kd_gejala, nilai) VALUES ('$kd_penyakitP','$kd_gejalaP','$nilaiSum' )");
                $result.= "</span><br>";
                
                //jumlahkan h1*g1
                $bobotG=$dataGejalaBobot['bobot']; $bobotP=$dataProbabilitasPHE['nilai']; $NilaiPHAtas=$bobotG*$bobotP;
                $result.= "H($kd_penyakitP|$dataGejalaBobot[kd_gejala] = $NilaiPHAtas";
                $result.= "<hr style='margin-left:80px;'>";
                $result.= "<span style='margin-left:80px;'>$nilaiSum </span><br>";//$NilaiProbabilitasEvidencePH</span><br>";
                //$HasilBagiPHgejalaPHpenyakit=$NilaiPHAtas/$NilaiProbabilitasEvidencePH;
                $nilaiBagi=$NilaiPHAtas/$nilaiSum;
                $result.= "H($kd_penyakitP|$dataGejalaBobot[kd_gejala] =  $nilaiBagi<br><br>";
                //memasukkan kedalam tabel nilai bayes
                $strTotalBayes=$this->Db->manualQuery("INSERT INTO  tmp_totalbayes (kd_penyakit,kd_gejala,totalbayes) VALUES ('$kd_penyakitP','$kd_gejalaP','$nilaiBagi')");
            }$Proses=$Proses+1;
            $result.= "<hr>";
        }

        $diagnosa="";
		$data['pasien'] = $this->Db->manualQuery("SELECT * FROM tbpasien ORDER BY idpasien DESC")->result_array()[0];

        $strHasilBayes=$this->Db->manualQuery("SELECT kd_penyakit, SUM(totalbayes)AS nilaiBayesTotal FROM tmp_totalbayes WHERE NOT totalbayes='0' GROUP BY kd_penyakit ORDER BY nilaiBayesTotal DESC ");
        foreach(($strHasilBayes)->result_array() as $dataHasilBayes){
            $diagnosa.= "<li>$dataHasilBayes[kd_penyakit] |";
            $bobotHasil=substr($dataHasilBayes['nilaiBayesTotal'],0,5);
            $diagnosa.= "bobot = ".$bobotHasil; $diagnosa.= "&nbsp;&nbsp;";
            $kd_penyakitS=$dataHasilBayes['kd_penyakit'];
            $strPenyakitSolusi=$this->Db->manualQuery("SELECT * FROM tbpenyakit WHERE kd_penyakit='$kd_penyakitS' ");
            $dataPenyakitSolusi=($strPenyakitSolusi)->result_array()[0];
            $diagnosa.= "<span style='font-size:12pt; color:#99cc99; font-weight:bold; text-decoration:underline;'>Nama Penyakit : ".$dataPenyakitSolusi['nama_penyakit']."</span><br>";
            $diagnosa.= "<div style='font-size:9pt; color:#333; border:1px solid #999; padding:2px 2px 2px 2px; max-height:80px; overflow:auto; '><strong>Definisi Penyakit :</strong> ".$dataPenyakitSolusi['definisi']."</div><br>";
            $diagnosa.= "<div style='font-size:9pt; color:#333; border:1px solid #999; padding:2px 2px 2px 2px; max-height:100px; overflow:auto; '><strong>Solusi Penanganan :</strong> ".$dataPenyakitSolusi['solusi']."</div><br>";
            $diagnosa.= "</li><hr>";
            //memasukkan data pasien ke tabel hasil
            $strHasil=$this->Db->manualQuery("INSERT INTO tbhasil (idpasien,kd_penyakit,bobotpenyakit,tanggal_diagnosa) VALUES ('".$data['pasien']['idpasien']."','$kd_penyakitS','$bobotHasil', NOW() )");
        }
        // echo $diagnosa;
        $data['title'] = 'Diagnosa';
		$data['result'] = $result;
		$data['gejala'] = $this->Db->manualQuery("SELECT tbgejala.gejala AS namagejala,tmp_gejala.kd_gejala FROM tbgejala,tmp_gejala WHERE tmp_gejala.kd_gejala=tbgejala.kd_gejala")->result_array();
		$data['diagnosa'] =$diagnosa;
        if($data['pasien']['kelamin'] == "Wanita") {
            $data['foto'] = "http://localhost/jantung-bayes-main/ci/assets/img/girl.png";
        }else{
            $data['foto'] = "http://localhost/jantung-bayes-main/ci/assets/img/boy.png";

        }
        $this->load->view('__layout/header', $data);
        $this->load->view('__layout/sidebar', $data);
        $this->load->view('__layout/topbar', $data);
        $this->load->view('konsul/hasilDiagnosa', $data);
        $this->load->view('__layout/footer');
    }
}