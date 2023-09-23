<?php 

class Jenis_kamar extends CI_Controller {
    
    function __construct() {
        parent::__construct();
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
		$this->form_validation->set_rules('nama_kamar', 'Nama Kamar','required');
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
            'nama_kamar' => $this->input->post('nama_kamar'),
            'fasilitas' => $this->input->post('fasilitas'),
        );
        $this->m_jenis_kamar->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('jenis_kamar');
        }
    }
    function edit($id_jeniskamar) { // Add the $id_jeniskamar parameter here
        $this->form_validation->set_rules('nama_kamar', 'Nama Kamar', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Jenis Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->detail($id_jeniskamar), // Use $id_jeniskamar here
                'isi' => 'jenis_kamar/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'id_jeniskamar' => $id_jeniskamar,
                'nama_kamar' => $this->input->post('nama_kamar'),
                'fasilitas' => $this->input->post('fasilitas'),
            );
            $this->m_jenis_kamar->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('jenis_kamar');
        }
    }
    
    function delete($id_jeniskamar) {
        $data = array(
            'id_jeniskamar' => $id_jeniskamar,
        );
        $this->m_jenis_kamar->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('jenis_kamar');
    }
}