<?php 

class Jenis_kamar extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->model('m_jenis_kamar');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Jenis Kamar',
            'jenis_kamar' => $this->m_jenis_kamar->lists(),
            'isi' => 'jenis_kamar/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('jeniskamar_nama', 'Nama Kamar','required');
		$this->form_validation->set_rules('fasilitas', 'Fasilitas','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Jenis Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->lists(),
                'isi' => 'jenis_kamar/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'jeniskamar_nama' => $this->input->post('jeniskamar_nama'),
            'fasilitas' => $this->input->post('fasilitas'),
        );
        $this->m_jenis_kamar->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('jenis_kamar');
        }
    }
    function edit($jeniskamar_id) { // Add the $jeniskamar_id parameter here
        $this->form_validation->set_rules('jeniskamar_nama', 'Nama Kamar', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Jenis Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->detail($jeniskamar_id), // Use $jeniskamar_id here
                'isi' => 'jenis_kamar/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'jeniskamar_id' => $jeniskamar_id,
                'jeniskamar_nama' => $this->input->post('jeniskamar_nama'),
                'fasilitas' => $this->input->post('fasilitas'),
            );
            $this->m_jenis_kamar->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('jenis_kamar');
        }
    }
    
    function delete($jeniskamar_id) {
        $data = array(
            'jeniskamar_id' => $jeniskamar_id,
        );
        $this->m_jenis_kamar->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('jenis_kamar');
    }
}