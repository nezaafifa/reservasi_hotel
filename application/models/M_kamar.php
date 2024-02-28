<?php

class M_kamar extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->join('jenis_kamar', 'jenis_kamar.jeniskamar_id = kamar.jeniskamar_id', 'left');
        $this->db->order_by('kamar_id', 'asc');
        return $this->db->get()->result();
    }
    function detail($kamar_id) {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->join('jenis_kamar', 'jenis_ka    mar.jeniskamar_id = kamar.jeniskamar_id', 'left');
        $this->db->where('kamar_id', $kamar_id);
        return $this->db->get()->row();
    }
    function add($data) {
        $this->db->insert('kamar', $data);
    }
    function edit($data) {
        $this->db->where('kamar_id', $data['kamar_id']);
        $this->db->update('kamar', $data);
    }
    function delete($data) {
        $this->db->where('kamar_id', $data['kamar_id']);
        $this->db->delete('kamar', $data);
    }
    public function HitungKamar()
    {
        $this->db->from('kamar');
        return $this->db->count_all_results();
    }
    public function HitungTransaksi()
    {
        $this->db->from('trans_hotel_detail');
        return $this->db->count_all_results();
    }
    public function HitungSelisihKamarTransaksi()
{
    $jumlahKamar = $this->HitungKamar();
    $jumlahTransaksi = $this->HitungTransaksi();
    return $jumlahKamar - $jumlahTransaksi;
}
}