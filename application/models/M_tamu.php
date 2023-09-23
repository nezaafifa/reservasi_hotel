<?php 

class M_tamu extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('tamu');
        $this->db->order_by('id_tamu');
        return $this->db->get()->result();
    } 
    function detail($id_tamu) {
        $this->db->select('*');
        $this->db->from('tamu');
        $this->db->where('id_tamu', $id_tamu);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('tamu', $data);
    }
    function edit($data) {
        $this->db->where('id_tamu', $data['id_tamu']);
        $this->db->update('tamu', $data);
    }
    function delete($data) {
        $this->db->where('id_tamu', $data['id_tamu']);
        $this->db->delete('tamu', $data);
    }
}