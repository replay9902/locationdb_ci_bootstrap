<?php
class My_Model extends CI_Model {
    function __construct()
     {
         parent::__construct();
     }
    
    function getData($q)
    { 
        $query = $this->db->query($q);
        return $query->result_array();
    }
    function getRow($q)
    { 
        $query = $this->db->query($q);
        return $query->row_array();
    }
}
