<?php

class M_kamar extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->join('jenis_kamar', 'jenis_kamar.id_jeniskamar = kamar.id_jeniskamar', 'left');
        $this->db->order_by('id_kamar', 'desc');
        return $this->db->get()->result();
    }
    function detail($id_kamar) {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->join('jenis_kamar', 'jenis_kamar.id_jeniskamar = kamar.id_jeniskamar', 'left');
        $this->db->where('id_kamar', $id_kamar);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('kamar', $data);
    }
    function edit($data) {
        $this->db->where('id_kamar', $data['id_kamar']);
        $this->db->update('kamar', $data);
    }
    function delete($data) {
        $this->db->where('id_kamar', $data['id_kamar']);
        $this->db->delete('kamar', $data);
    }
}