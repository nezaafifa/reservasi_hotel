<?php

class M_transaksi extends CI_Model
{

    function lists()
    {
        $result = $this->db->query(
            "SELECT 
            a.*,
            b.tamu_nama as pembooking_nm,
            c.username as petugas_nm 
         FROM 
            trans_hotel a
         LEFT JOIN 
            tamu b ON a.pembooking_id = b.tamu_id
         LEFT JOIN
            user c ON a.petugas_id = c.user_id"
        )->result_array();

        return $result;
    }
    function detail($trans_id)
    {
        // $this->db->select('*');
        // $this->db->from('trans_hotel');
        // $this->db->join('tamu', 'tamu.tamu_id = trans_hotel.tamu_id', 'left');
        // // $this->db->join('jenis_kamar', 'kamar.jeniskamar_id = jenis_kamar.jeniskamar_id', 'left');
        // $this->db->where('trans_id', $trans_id);
        // return $this->db->get()->row();
        $result = $this->db->query(
            "SELECT 
                a.*,
                b.tamu_nama as pembooking_nm,
                c.username as petugas_nm 
             FROM 
                trans_hotel a
             LEFT JOIN 
                tamu b ON a.pembooking_id = b.tamu_id
             LEFT JOIN
                user c ON a.petugas_id = c.user_id
             WHERE
                a.transhotel_id = '" . @$trans_id . "'"
        )->row_array();
        return $result;
    }
    function add($data)
    {
        $this->db->insert('trans_hotel', $data);
    }
    function edit($data)
    {
        $this->db->where('transhotel_id', $data['transhotel_id']);
        $this->db->update('trans_hotel', $data);
    }
    function delete($data)
    {
        $this->db->where('transhotel_id', $data['transhotel_id']);
        $this->db->delete('trans_hotel', $data);
    }
    public function get_kamar($kamar_nm)
    {
        // var_dump($kamar_nm);
        $sql = "SELECT a.*,b.jeniskamar_nama FROM kamar a LEFT JOIN jenis_kamar b on a.jeniskamar_id = b.jeniskamar_id WHERE b.jeniskamar_nama LIKE '%$kamar_nm%'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $res = array();
        foreach ($result as $row) {
            $res[] = array(
                'id' => @$row['kamar_id'],
                'text' => @$row['kamar_nama'] . '-' . float_id(@$row['harga']),
                'harga' => @$row['harga'],
            );
        }
        return $res;
    }

    // public function invoice_no()
    // {
    //     $sql = "SELECT MAX(MID(transhotel_id,9,4)) AS transhotel_id FROM trans_hotel WHERE MID(transhotel_id,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
    //     $query = $this->db->query($sql);
    //     if ($query->num_rows() > 0) {
    //         $row = $query->row();
    //         $n = ((int)$row->transhotel_id) + 1;
    //         $no = sprintf("%'.04d", $n);
    //     } else {
    //         $no = "0001";
    //     }
    //     $invoice = "INV" . date('ymd') . $no;
    //     return $invoice;
    // }

    public function save_transaksi()
    {
        $data = $this->input->post();
        // echo '<pre>' . var_export($data, true) . '</pre>';die;
        $cek_transaksi_no_last = $this->db->query("SELECT transaksi_no FROM trans_hotel WHERE DATE(transaksi_tgl) = '" . to_date(@$data['transaksi_tgl'], '', 'date') . "' ORDER BY transaksi_no DESC LIMIT 1")->row_array();
        if (@$cek_transaksi_no_last['transaksi_no'] != '') {
            $transaksi_no = @$cek_transaksi_no_last['transaksi_no'] + 1;
        } else {
            $transaksi_no = 1;
        }
        $transaksi = 'INV' . date('ymd') . '000' . @$transaksi_no;
        $d = array(
            'transhotel_id' => @$transaksi,
            'transaksi_no' => @$transaksi_no,
            'transaksi_tgl' => to_date(@$data['transaksi_tgl'], '', 'full_date'),
            'petugas_id' => @$data['petugas_id'],
            'pembooking_id' => @$data['pembooking_id'],
            'checkin_tgl' => to_date(@$data['checkin_tgl'], '', 'full_date'),
            'checkout_tgl' => to_date(@$data['checkout_tgl'], '', 'full_date'),
            'lama_inap' => @$data['lama_inap'],
            'keterangan' => @$data['keterangan'],
        );

        // echo '<pre>' . var_export($d, true) . '</pre>';die;
        $this->db->insert('trans_hotel', @$d);
        return $d['transhotel_id'];
        // retur
    }

    function RemoveSpecialChar($str)
    {

        // Using str_replace() function
        // to replace the word
        $res = str_replace(array(
            '\'', '"',
            ',', ';', '<', '>'
        ), ' ', $str);

        // Returning the result
        return $res;
    }

    public function transaksi_kamar_data($transhotel_id = '')
    {
        return $this->db->query(
            "SELECT
              a.*,
              b.tamu_nama,
              c.kamar_nama,
              d.jeniskamar_nama
             FROM
              trans_hotel_detail a
             LEFT JOIN
              tamu b on a.tamu_id = b.tamu_id
             LEFT JOIN
              kamar c ON a.kamar_id = c.kamar_id
             LEFT JOIN
              jenis_kamar d ON c.jeniskamar_id = d.jeniskamar_id
             WHERE
              a.transhotel_id = '" . @$transhotel_id . "'"
        )->result_array();
    }

    public function transaksi_kamar_save()
    {
        $data = $this->input->post();
        $harga = $this->db->query("SELECT harga FROM kamar WHERE kamar_id = '" . @$data['kamar_id'] . "'")->row_array()['harga'];
        // var_dump($data);
        // die;
        if ($data['detail_id'] == '') {
            $d = array(
                'transhotel_id' => @$data['transhotel_id'],
                'tamu_id' => @$data['tamu_id'],
                'kamar_id' => @$data['kamar_id'],
                'harga' => @$harga,
                'total_biaya' => @$harga * @$data['lama_inap'],
            );

            $this->db->insert('trans_hotel_detail', @$d);
        } else {
            $d = array(
                'transhotel_id' => @$data['transhotel_id'],
                'tamu_id' => @$data['tamu_id'],
                'kamar_id' => @$data['kamar_id'],
                'harga' => @$harga,
                'total_biaya' => @$harga * @$data['lama_inap'],
            );
            // var_dump($d);
            // die;
            $this->db->where('detail_id', @$data['detail_id'])->update('trans_hotel_detail', @$d);
        }
    }

    public function transaksi_kamar_delete($detail_id = '')
    {
        $this->db->where('detail_id', $detail_id)->delete('trans_hotel_detail');
    }

    public function transaksi_kamar_get($detail_id = '', $transhotel_id = '')
    {
        return $this->db->query(
            "SELECT
                a.*,
                b.tamu_nama,
                c.kamar_nama,
                c.harga
             FROM 
                trans_hotel_detail a
             LEFT JOIN 
                tamu b ON a.tamu_id = b.tamu_id
             LEFT JOIN 
                kamar c ON a.kamar_id = c.kamar_id"
        )->row_array();
    }

    public function get_tamu($tamu_nm)
    {
        // var_dump($kamar_nm);
        $sql = "SELECT a.* FROM tamu a WHERE a.tamu_nama LIKE '%$tamu_nm%'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $res = array();
        foreach ($result as $row) {
            $res[] = array(
                'id' => @$row['tamu_id'],
                'text' => @$row['tamu_nama'],
            );
        }
        return $res;
    }
}
