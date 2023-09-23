<?php 

class M_menu extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('menu_resto');
        $this->db->order_by('id_menu');
        return $this->db->get()->result();
    } 
    function detail($id_menu) {
        $this->db->select('*');
        $this->db->from('menu_resto');
        $this->db->where('id_menu', $id_menu);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('menu_resto', $data);
    }
    function edit($data) {
        $this->db->where('id_menu', $data['id_menu']);
        $this->db->update('menu_resto', $data);
    }
    function delete($data) {
        $this->db->where('id_menu', $data['id_menu']);
        $this->db->delete('menu_resto', $data);
    }
}