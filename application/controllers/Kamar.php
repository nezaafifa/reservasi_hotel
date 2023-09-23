<?php 

class Kamar extends CI_Controller {
    
    function __construct() {
        parent::__construct();
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
		$this->form_validation->set_rules('harga', 'Harga','required');
		$this->form_validation->set_rules('id_jeniskamar', 'Nama Kamar','required');

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
            'harga' => $this->input->post('harga'),
            'id_jeniskamar' => $this->input->post('id_jeniskamar'),
        );
        $this->m_kamar->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('kamar');
        }
    }
    function edit($id_kamar) {
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('id_jeniskamar', 'Nama Kamar', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->lists(), // Use $id_jeniskamar here
                'kamar' => $this->m_kamar->detail($id_kamar), 
                'isi' => 'kamar/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'id_kamar' => $id_kamar,
                'harga' => $this->input->post('harga'),
                'id_jeniskamar' => $this->input->post('id_jeniskamar'),
            );
            $this->m_kamar->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('kamar');
        }
    }
    
    
    function delete($id_kamar) {
        $data = array(
            'id_kamar' => $id_kamar,
        );
        $this->m_kamar->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('kamar');
    }
}