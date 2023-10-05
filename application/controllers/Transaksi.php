<?php


class Transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model('m_transaksi');
        $this->load->model('m_tamu');
        $this->load->model('m_kamar');
        $this->load->model('m_detail_transaksi');
        $this->load->model('m_user');
    }
    function index()
    {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Transaksi',
            'transaksi' => $this->m_transaksi->lists(),
            'isi' => 'transaksi/v_list'
        );
        // var_dump($data);die;
        $this->load->view('template/v_wrapper', $data, FALSE);
    }
    function add()
    {

        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Add Transaksi',
            'tamu' => $this->m_tamu->lists(),
            'petugas' => $this->m_user->lists(),
            'transaksi' => $this->m_transaksi->lists(),
            // 'invoice_no' => @$this->m_transaksi->invoice_no(),
            'isi' => 'transaksi/v_add'
        );
        $this->load->view('template/v_wrapper', $data);
    }
    // function edit($trans_id) {
    // 	$this->form_validation->set_rules('tamu_id', 'Nama Tamu','required');
    // 	$this->form_validation->set_rules('kamar_id', 'Harga','required');
    // 	$this->form_validation->set_rules('checkin_tgl', 'Tanggal Checkin','required');
    // 	$this->form_validation->set_rules('checkout_tgl', 'Tanggal Checkout','required');
    // 	$this->form_validation->set_rules('lama_inap', 'Lama Inap','required');
    // 	$this->form_validation->set_rules('total_biaya', 'Total Biaya','required');
    //     $this->form_validation->set_rules('harga', 'Total Biaya','required');

    //     if($this->form_validation->run() == FALSE) {
    //         $data = array(
    //             'title' => 'Hotel Biru',
    //             'title2' => 'Edit Transaksi',
    //             'tamu' => $this->m_tamu->lists(),
    //             'kamar' => $this->m_kamar->lists(),
    //             'transaksi' => $this->m_transaksi->detail($trans_id),
    //             'isi' => 'transaksi/v_edit'
    //         );
    //         $this->load->view('template/v_wrapper', $data,FALSE);
    //     } else {
    //     $data = array(
    //         'trans_id' => $trans_id,
    //         'tamu_id' => $this->input->post('tamu_id'),
    //         'kamar_id' => $this->input->post('kamar_id'),
    //         'checkin_tgl' => $this->input->post('checkin_tgl'),
    //         'checkout_tgl' => $this->input->post('checkout_tgl'),
    //         'lama_inap' => $this->input->post('lama_inap'),
    //         'total_biaya' => $this->input->post('total_biaya'),
    //         'harga' => $this->input->post('harga'),
    //     );
    //     $this->m_transaksi->edit($data);
    //     $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
    //     redirect('transaksi');
    //     }
    // }
    // function edit($transhotel_id)
    // {
    //     $this->form_validation->set_rules('pembooking_id', 'Nama Pembooking', 'required');
    //     $this->form_validation->set_rules('checkin_tgl', 'Tanggal Checkin', 'required');
    //     $this->form_validation->set_rules('checkout_tgl', 'Tanggal Checkout', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $data = array(
    //             'title' => 'Hotel Biru',
    //             'title2' => 'Edit Transaksi',
    //             'tamu' => $this->m_tamu->lists(),
    //             'petugas' => $this->m_user->lists(),
    //             'transaksi' => $this->m_transaksi->detail($transhotel_id),
    //             'isi' => 'transaksi/v_edit'
    //         );
    //         $this->load->view('template/v_wrapper', $data, FALSE);
    //     } else {
    //         $data = array(
    //             'transhotel_id' => $transhotel_id,
    //             'pembooking_id' => $this->input->post('pembooking_id'),
    //             'petugas_id' => $this->input->post('petugas_id'),
    //             'checkin_tgl' => to_date($this->input->post('checkin_tgl'), '', 'full_date'),
    //             'checkout_tgl' => to_date($this->input->post('checkout_tgl'), '', 'full_date'),
    //         );
    //         $tgl1 = strtotime($data['checkin_tgl']);
    //         $tgl2 = strtotime($data['checkout_tgl']);

    //         $jarak = $tgl2 - $tgl1;

    //         $lama_inap = $jarak / 60 / 60 / 24;

    //         $data['lama_inap'] = @$lama_inap;
    //         $this->m_transaksi->edit($data);
    //         $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
    //         // redirect('transaksi');
    //         redirect('transaksi');
    //     }
    // }
    function edit($transhotel_id)
    {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Edit Transaksi',
            'tamu' => $this->m_tamu->lists(),
            'petugas' => $this->m_user->lists(),
            'transaksi' => $this->m_transaksi->detail($transhotel_id),
            'kamar' => @$this->m_kamar->lists(),
            'isi' => 'transaksi/v_edit'
        );
        // var_dump($data['transaksi']);die;
        $this->load->view('template/v_wrapper', $data, FALSE);
    }

    function show($trans_id)
    {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Detail Transaksi',
            'tamu' => $this->m_tamu->lists(),
            // 'kamar' => $this->m_kamar->lists(), 
            'detail_transaksi' => $this->m_detail_transaksi->detail($trans_id),
            'isi' => 'transaksi/v_show'
        );
        var_dump($data);
        die;
        $this->load->view('template/v_wrapper', $data, FALSE);
    }


    function delete($transhotel_id)
    {
        $data = array(
            'transhotel_id' => $transhotel_id,
        );
        $this->m_transaksi->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect('transaksi');
    }

    public function ajax($type = null, $id = null)
    {
        if ($type == 'kamar_cek') {
            $kamar_nm = $this->input->get('kamar_nm');
            $res = $this->m_transaksi->get_kamar($kamar_nm);
            // var_dump($res);
            echo json_encode($res);
        } else if($type == 'tamu_autocomplete') {
            $tamu_nm = $this->input->get('tamu_nm');
            $res = $this->m_transaksi->get_tamu($tamu_nm);
            // var_dump($res);
            echo json_encode($res);
        }
    }

    public function ajax_transaksi($type = null, $id = null)
    {
        if ($type == 'save') {
            $result = $this->m_transaksi->save_transaksi();
            echo json_encode($result);
        } else if ($type == 'transaksi_kamar_data') {
            $transhotel_id = $this->input->post('transhotel_id');
            $data['main'] = $this->m_transaksi->transaksi_kamar_data($transhotel_id);
            echo json_encode(array(
                'html' => @$this->load->view('transaksi/transaksi_kamar_data', @$data, true)
            ));
        } else if (@$type == 'kamar_save') {
            $this->m_transaksi->transaksi_kamar_save();
        } else if ($type == 'delete_transaksi_kamar') {
            $detail_id = $this->input->post('detail_id');
            $transhotel_id = $this->input->post('transhotel_id');

            $this->m_transaksi->transaksi_kamar_delete($detail_id);

            $data['main'] = $this->m_transaksi->transaksi_kamar_data($transhotel_id);
            echo json_encode(array(
                'html' => $this->load->view('transaksi/transaksi_kamar_data', $data, true)
            ));
        } else if ($type == 'transaksi_kamar_get') {
            $detail_id = $this->input->post('detail_id');
            $transhotel_id = $this->input->post('transhotel_id');

            $main = $this->m_transaksi->transaksi_kamar_get($detail_id, $transhotel_id);
            echo json_encode(array(
                'main' => $main
            ));
        } 
    }
}
