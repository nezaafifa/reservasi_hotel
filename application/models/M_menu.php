<?php 

class M_menu extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('menu_resto');
        $this->db->order_by('menu_id');
        return $this->db->get()->result();
    } 
    function detail($menu_id) {
        $this->db->select('*');
        $this->db->from('menu_resto');
        $this->db->where('menu_id', $menu_id);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('menu_resto', $data);
    }
    function edit($data) {
        $this->db->where('menu_id', $data['menu_id']);
        $this->db->update('menu_resto', $data);
    }
    function delete($data) {
        $this->db->where('menu_id', $data['menu_id']);
        $this->db->delete('menu_resto', $data);
    }
}