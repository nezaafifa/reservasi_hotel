<?php 

class Kamar extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->model('m_kamar');
        $this->load->model('m_jenis_kamar');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Kamar',
            'kamar' => $this->m_kamar->lists(),
            'isi' => 'kamar/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('jeniskamar_id', 'Nama Kamar','required');
        $this->form_validation->set_rules('kamar_no', 'kamar_no','required');
        $this->form_validation->set_rules('harga', 'Harga','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->lists(),
                'kamar' => $this->m_kamar->lists(),
                'isi' => 'kamar/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'jeniskamar_id' => $this->input->post('jeniskamar_id'),
            'kamar_no' => $this->input->post('kamar_no'),
            'harga' => $this->input->post('harga'),
        );
        $this->m_kamar->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('kamar');
        }
    }
    function edit($kamar_id) {
        $this->form_validation->set_rules('jeniskamar_id', 'Nama Kamar', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->lists(), // Use $jeniskamar_id here
                'kamar' => $this->m_kamar->detail($kamar_id), 
                'isi' => 'kamar/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'kamar_id' => $kamar_id,
                'jeniskamar_id' => $this->input->post('jeniskamar_id'),
                'harga' => $this->input->post('harga'),
            );
            $this->m_kamar->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('kamar');
        }
    }
    
    
    function delete($kamar_id) {
        $data = array(
            'kamar_id' => $kamar_id,
        );
        $this->m_kamar->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('kamar');
    }
}