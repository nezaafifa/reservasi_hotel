<?php 

class M_jenis_kamar extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('jenis_kamar');
        $this->db->order_by('jeniskamar_id');
        return $this->db->get()->result();
    } 
    function detail($jeniskamar_id) {
        $this->db->select('*');
        $this->db->from('jenis_kamar');
        $this->db->where('jeniskamar_id', $jeniskamar_id);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('jenis_kamar', $data);
    }
    function edit($data) {
        $this->db->where('jeniskamar_id', $data['jeniskamar_id']);
        $this->db->update('jenis_kamar', $data);
    }
    function delete($data) {
        $this->db->where('jeniskamar_id', $data['jeniskamar_id']);
        $this->db->delete('jenis_kamar', $data);
    }
}