<?php 

class M_kritik extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('kritik');
        $this->db->order_by('kritik_id');
        return $this->db->get()->result();
    } 
    function detail($kritik_id) {
        $this->db->select('*');
        $this->db->from('kritik');
        $this->db->where('kritik_id', $kritik_id);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('kritik', $data);
    }
    function edit($data) {
        $this->db->where('kritik_id', $data['kritik_id']);
        $this->db->update('kritik', $data);
    }
    function delete($data) {
        $this->db->where('kritik_id', $data['kritik_id']);
        $this->db->delete('kritik', $data);
    }
}