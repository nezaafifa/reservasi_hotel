<?php 

class M_user extends CI_Model {

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }
    function lists() {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('user_id');
        return $this->db->get()->result();
    } 
    function detail($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('user', $data);
    }
    function edit($data) {
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('user', $data);
    }
    function delete($data) {
        $this->db->where('user_id', $data['user_id']);
        $this->db->delete('user', $data);
    }

    /**
     * mengambil data user 
     * berdasarkan username :)
     */
    public function get_user($username) {
        return $this->db->get_where('user', array('username' => $username))->row();
    }
}