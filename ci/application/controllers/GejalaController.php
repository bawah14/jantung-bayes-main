<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class GejalaController extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('Gejala');
	}
 
	public function index(){
		$data['gejala'] = $this->Gejala->index()->result();
        print_r($data);
		// $this->load->view('v_user.php',$data);
	}
 
}