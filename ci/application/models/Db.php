<?php 
 
class Db extends CI_Model{

    public function manualQuery($sql)
    {    
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}