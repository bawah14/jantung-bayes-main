<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class GejalaController extends CI_Controller {
	
	function __construct(){
		parent::__construct();		
		$this->load->model('Db');
	}
 
	public function index(){
		$data['gejala'] = $this->Db->manualQuery("SELECT * FROM tbgejala");
        print_r($data);
	}
 
}