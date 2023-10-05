<?php 

class M_tamu extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('tamu');
        $this->db->order_by('tamu_id');
        return $this->db->get()->result();
    } 
    function detail($tamu_id) {
        $this->db->select('*');
        $this->db->from('tamu');
        $this->db->where('tamu_id', $tamu_id);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('tamu', $data);
    }
    function edit($data) {
        $this->db->where('tamu_id', $data['tamu_id']);
        $this->db->update('tamu', $data);
    }
    function delete($data) {
        $this->db->where('tamu_id', $data['tamu_id']);
        $this->db->delete('tamu', $data);
    }
}