<?php 

class Tamu extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('m_tamu');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Tamu',
            'tamu' => $this->m_tamu->lists(),
            'isi' => 'tamu/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('nama_tamu', 'Nama Tamu','required');
		$this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('warganegaraan', 'Warganegaraan','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('tlp', 'Telepon','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Tamu',
                'tamu' => $this->m_tamu->lists(),
                'isi' => 'tamu/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'nama_tamu' => $this->input->post('nama_tamu'),
            'jns_kelamin' => $this->input->post('jns_kelamin'),
            'warganegaraan' => $this->input->post('warganegaraan'),
            'alamat' => $this->input->post('alamat'),
            'tlp' => $this->input->post('tlp'),
        );
        $this->m_tamu->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('tamu');
        }
    }
    function edit($id_tamu) {
        $this->form_validation->set_rules('nama_tamu', 'Nama Tamu', 'required');
        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('warganegaraan', 'Warganegaraan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tlp', 'Telepon', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Tamu',
                'tamu' => $this->m_tamu->detail($id_tamu), 
                'isi' => 'tamu/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        } else {
            $data = array(
                'id_tamu' => $id_tamu,
                'nama_tamu' => $this->input->post('nama_tamu'),
                'warganegaraan' => $this->input->post('warganegaraan'),
                'alamat' => $this->input->post('alamat'),
                'tlp' => $this->input->post('tlp'),
            );
            $this->m_tamu->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('tamu');
        }
    }
    
    
    function delete($id_tamu) {
        $data = array(
            'id_tamu' => $id_tamu,
        );
        $this->m_tamu->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('tamu');
    }
}