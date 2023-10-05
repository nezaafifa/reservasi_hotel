<?php

class M_pesan extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->join('tamu', 'tamu.id_tamu = pesan.id_tamu', 'left');
        $this->db->join('kamar', 'kamar.id_kamar = pesan.id_kamar', 'left');
        $this->db->order_by('id_pesan', 'desc');
        return $this->db->get()->result();
    }
    function detail($id_kamar) {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->join('tamu', 'tamu.id_tamu = pesan.id_tamu', 'left');
        $this->db->join('kamar', 'kamar.id_kamar = pesan.id_kamar', 'left');
        $this->db->where('id_pesan', $id_kamar);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('pesan', $data);
    }
    function edit($data) {
        $this->db->where('id_pesan', $data['id_pesan']);
        $this->db->update('pesan', $data);
    }
    function delete($data) {
        $this->db->where('id_pesan', $data['id_pesan']);
        $this->db->delete('pesan', $data);
    }


}