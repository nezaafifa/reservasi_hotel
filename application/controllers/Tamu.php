<?php 

class Tamu extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
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
    public function add() {
		$this->form_validation->set_rules('tamu_nama', 'Nama Tamu','required');
		$this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('wargenegaraan', 'Warganegaraan','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('no_tlp', 'Telepon','required');

        if($this->form_validation->run() == FALSE) {
            
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Tamu',
                'tamu' => $this->m_tamu->lists(),
                'isi' => 'tamu/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        }
    }
    public function add_tambah(){
        // echo "hello worlds";
        $data = array(
            'tamu_nama' => $this->input->post('tamu_nama'),
            'jns_kelamin' => $this->input->post('jns_kelamin'),
            'warganegaraan' => $this->input->post('warganegaraan'),
            'alamat' => $this->input->post('alamat'),
            'no_tlp' => $this->input->post('no_tlp'),
        );
        $this->m_tamu->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('tamu');
    }
    // function aksi_tambah(){
    //     $this->load->view('tamu/v_add');
    // }
    public function edit($tamu_id) {
        $this->form_validation->set_rules('tamu_nama', 'Nama Tamu', 'required');
        $this->form_validation->set_rules('jns_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('wargenegaraan', 'Warganegaraan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_tlp', 'Telepon', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Tamu',
                'tamu' => $this->m_tamu->detail($tamu_id), 
                'isi' => 'tamu/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
            // $data = array(
            //     'tamu_id' => $tamu_id,
            //     'tamu_nama' => $this->input->post('tamu_nama'),
            //     'jns_kelamin' => $this->input->post('jns_kelamin'),
            //     'wargenegaraan' => $this->input->post('wargenegaraan'),
            //     'alamat' => $this->input->post('alamat'),
            //     'no_tlp' => $this->input->post('no_tlp'),
            // );
            // $this->m_tamu->edit($data);
            // $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            // redirect('tamu');
        }
    }
    public function aksi_edit($tamu_id){
        $data = array(
            'tamu_id' => $tamu_id,
            'tamu_nama' => $this->input->post('tamu_nama'),
            'jns_kelamin' => $this->input->post('jns_kelamin'),
            'warganegaraan' => $this->input->post('warganegaraan'),
            'alamat' => $this->input->post('alamat'),
            'no_tlp' => $this->input->post('no_tlp'),
        );
        $this->m_tamu->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
        redirect('tamu');
    }
    
    function delete($tamu_id) {
        $data = array(
            'tamu_id' => $tamu_id,
        );
        $this->m_tamu->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('tamu');
    }
}