<?php 

class Pesan extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->model('m_pesan');
        $this->load->model('m_tamu');
        $this->load->model('m_kamar');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Pesan',
            'pesan' => $this->m_pesan->lists(),
            'isi' => 'pesan/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('id_tamu', 'Nama Tamu','required');
		$this->form_validation->set_rules('id_kamar', 'Harga','required');
		$this->form_validation->set_rules('tgl_checkin', 'Tanggal Checkin','required');
		$this->form_validation->set_rules('tgl_checkout', 'Tanggal Checkout','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Pesan',
                'tamu' => $this->m_tamu->lists(),
                'kamar' => $this->m_kamar->lists(),
                'pesan' => $this->m_pesan->lists(),
                'isi' => 'pesan/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'id_tamu' => $this->input->post('id_tamu'),
            'id_kamar' => $this->input->post('id_kamar'),
            'tgl_checkin' => $this->input->post('tgl_checkin'),
            'tgl_checkout' => $this->input->post('tgl_checkout'),
        );
        $this->m_pesan->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('pesan');
        }
    }
    function edit($id_pesan) {
        $this->form_validation->set_rules('id_tamu', 'Nama Tamu', 'required');
        $this->form_validation->set_rules('id_kamar', 'Harga', 'required');
        $this->form_validation->set_rules('tgl_checkin', 'Tanggal Checkin', 'required');
        $this->form_validation->set_rules('tgl_checkout', 'Tanggal checkout', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Pesan',
                'tamu' => $this->m_tamu->lists(), // Use $id_jeniskamar here
                'kamar' => $this->m_kamar->lists(), // Use $id_jeniskamar here
                'pesan' => $this->m_pesan->detail($id_pesan), 
                'isi' => 'pesan/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'id_pesan' => $id_pesan,
                'id_tamu' => $this->input->post('id_tamu'),
                'id_kamar' => $this->input->post('id_kamar'),
                'tgl_checkin' => $this->input->post('tgl_checkin'),
                'tgl_checkout' => $this->input->post('tgl_checkout'),
            );
            $this->m_pesan->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('pesan');
        }
    }
    
    
    function delete($id_pesan) {
        $data = array(
            'id_pesan' => $id_pesan,
        );
        $this->m_pesan->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('pesan');
    }
}