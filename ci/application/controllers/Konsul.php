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
		$data['gejala'] = $this->Db->manualQuery("SELECT * FROM tbgejala");
        $this->load->view('__layout/header', $data);
        $this->load->view('__layout/sidebar', $data);
        $this->load->view('__layout/topbar', $data);
        $this->load->view('konsul/index', $data);
        $this->load->view('__layout/footer');
    }
}