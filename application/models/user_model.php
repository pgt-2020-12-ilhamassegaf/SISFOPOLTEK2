<?php
class user_model extends CI_Controller{
    public function ambil_data($id){
        $this->db->where('username', $id);
        return $this->db->get('user')->row();
    }
}
