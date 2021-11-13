<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Db');
    }

    public function index()
    {

        $data['title'] = 'Pasien';
		$data['_data'] = $this->Db->manualQuery("SELECT * FROM tbpasien")->result_array();
        $this->load->view('__layout/header', $data);
        $this->load->view('__layout/sidebar', $data);
        $this->load->view('__layout/topbar', $data);
        $this->load->view('pasien/index', $data);
        $this->load->view('__layout/footer');
    }

    public function add()
    {
        $data['title'] = 'Data diri';
        $this->load->view('__layout/header', $data);
        $this->load->view('__layout/sidebar', $data);
        $this->load->view('__layout/topbar', $data);
        $this->load->view('pasien/insert', $data);
        $this->load->view('__layout/footer');
    }

    public function addHandler()
    {
        print_r($_POST);
        $TxtNama 	= $_POST['name'];
        $RbKelamin 	= $_POST['kelamin'];
        $TxtUmur	= $_POST['umur'];
        $TxtAlamat 	= $_POST['alamat'];
        $NOIP       = $_SERVER['REMOTE_ADDR'];
        $email      = $_POST['email'];

	//$sqldel = "DELETE FROM tmp_pasien WHERE noip='$NOIP'";	mysqli_query($koneksi,$sqldel );
        $sql  = " INSERT INTO tbpasien (nama,kelamin,umur,alamat,tanggal,email) 
                VALUES ('$TxtNama','$RbKelamin','$TxtUmur','$TxtAlamat',NOW(),'$email')";
        
        $sqlhapus = "DELETE FROM tmp_penyakit ";
        
        $sqlhapus2 = "DELETE FROM tmp_analisa ";
                
        $sqlhapus3 = "DELETE FROM tmp_gejala ";
        try {
            //code...
            $this->Db->manualQuery($sql);
            $this->Db->manualQuery($sqlhapus);
            $this->Db->manualQuery($sqlhapus2);
            $this->Db->manualQuery($sqlhapus3);
            redirect('/Konsul');
        } catch (\Throwable $th) {
            //throw $th;
            print_r($th);
        }
    }



}