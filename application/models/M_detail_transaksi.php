<?php

class M_detail_transaksi extends CI_Model {

    function lists() {
        $this->db->select('*');
        $this->db->from('trans_hotel');
        $this->db->join('tamu', 'tamu.tamu_id = trans_hotel.tamu_id', 'left');
        // $this->db->join('jenis_kamar', 'kamar.jeniskamar_id = jenis_kamar.jeniskamar_id', 'left');
        $this->db->order_by('trans_id', 'desc');
        return $this->db->get()->result();
    }
    function detail($trans_id) {
        $this->db->select('*');
        $this->db->from('trans_hotel');
        $this->db->join('tamu', 'tamu.tamu_id = trans_hotel.tamu_id', 'left');
        // $this->db->join('jenis_kamar', 'kamar.jeniskamar_id = jenis_kamar.jeniskamar_id', 'left');
        $this->db->where('trans_id', $trans_id);
        return $this->db->get()->row();
    }
    // function add($data) {
    //     $this->db->insert('trans_hotel', $data);
    // }
    // function edit($data) {
    //     $this->db->where('trans_id', $data['trans_id']);
    //     $this->db->update('trans_hotel', $data);
    // }
    // function delete($data) {
    //     $this->db->where('trans_id', $data['trans_id']);
    //     $this->db->delete('trans_hotel', $data);
    // }
    public function get_kamar($kamar_nm) {
        // var_dump($kamar_nm);
        $sql = "SELECT a.*,b.jeniskamar_nama FROM kamar a LEFT JOIN jenis_kamar b on a.jeniskamar_id = b.jeniskamar_id WHERE b.jeniskamar_nama LIKE '%$kamar_nm%'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $res = array();
        foreach($result as $row) {
            $res[] = array(
                'id' => @$row['kamar_id'],
                'text' => @$row['jeniskamar_nama'],
                'harga' => @$row['harga'],
            );
        }
        return $res;
    }
}