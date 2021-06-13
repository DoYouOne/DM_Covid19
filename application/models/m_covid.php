<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_covid extends CI_Model {

    public function all(){
        return $this->db->get('tb_data');
    }
    
    public function hitung(){
        return $this->db->count_all('tb_data');
    }

    public function insert($data){
        $this->db->insert_batch('tb_data',$data);
    }

    public function del_all($data){
        $this->db->query('DELETE FROM tb_data');
        $this->db->insert_batch('tb_data',$data);
    }
}
