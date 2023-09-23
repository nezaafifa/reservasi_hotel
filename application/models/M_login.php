<?php 

class M_login extends CI_Model{

    function login($username,$password) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where(array(
            'username' => $username,
            'password' => $password,
        ));
        return $this->db->get()->row();
    }
}