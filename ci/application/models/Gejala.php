<?php 
 
class gejala extends CI_Model{
	function index(){
		return $this->db->get('tbgejala');
	}
}