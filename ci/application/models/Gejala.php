<?php 
 
class Gejala extends CI_Model{
    private $_table = "tbgejala";
    private $_tableId = "kdgejala";


    public function manualQuery()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, [$this->_tableId => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->{$this->_tableId} = uniqid();
        return $this->db->insert($this->_table, $post);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->{$this->_tableId} = $post["id"];
        return $this->db->update($this->_table, $post, array($this->_tableId => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array($this->_tableId => $id));
    }
}