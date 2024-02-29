<?php 

class Kritik extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->model('m_kritik');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Kritik',
            'kritik' => $this->m_kritik->lists(),
            'isi' => 'kritik/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('saran', 'Saran','required');
		$this->form_validation->set_rules('kritik', 'Kritik','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Kritik',
                'kritik' => $this->m_kritik->lists(),
                'isi' => 'kritik/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'saran' => $this->input->post('saran'),
            'kritik' => $this->input->post('kritik'),
        );
        $this->m_kritik->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('kritik');
        }
    }
    function edit($kritik_id) {
		$this->form_validation->set_rules('saran', 'Saran','required');
		$this->form_validation->set_rules('kritik', 'Kritik','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Kritik',
                'kritik' => $this->m_kritik->detail($kritik_id),
                'isi' => 'kritik/v_edit'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'kritik_id' => $kritik_id,
            'saran' => $this->input->post('saran'),
            'kritik' => $this->input->post('kritik'),
        );
        $this->m_kritik->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
        redirect('kritik');
        }
    }
    function delete($kritik_id) {
        $data = array(
            'kritik_id' => $kritik_id,
        );
        $this->m_kritik->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('kritik');
    }
}