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
        $this->db->order_by('id_user');
        return $this->db->get()->result();
    } 
    function detail($id_user) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('user', $data);
    }
    function edit($data) {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('user', $data);
    }
    function delete($data) {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('user', $data);
    }

    /**
     * validate
     */
    public function validate($username, $password){
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('user', 1);
        return $result;
    }
}