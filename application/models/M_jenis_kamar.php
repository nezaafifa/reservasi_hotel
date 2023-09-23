<?php 

class M_jenis_kamar extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('jenis_kamar');
        $this->db->order_by('id_jeniskamar');
        return $this->db->get()->result();
    } 
    function detail($id_jeniskamar) {
        $this->db->select('*');
        $this->db->from('jenis_kamar');
        $this->db->where('id_jeniskamar', $id_jeniskamar);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('jenis_kamar', $data);
    }
    function edit($data) {
        $this->db->where('id_jeniskamar', $data['id_jeniskamar']);
        $this->db->update('jenis_kamar', $data);
    }
    function delete($data) {
        $this->db->where('id_jeniskamar', $data['id_jeniskamar']);
        $this->db->delete('jenis_kamar', $data);
    }
}