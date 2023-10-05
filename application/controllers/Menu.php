<?php 

class Menu extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->model('m_menu');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Menu',
            'menu' => $this->m_menu->lists(),
            'isi' => 'menu/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('nama_makanan', 'Nama Makanan','required');
		$this->form_validation->set_rules('harga', 'Harga','required');
		$this->form_validation->set_rules('keterangan', 'Keterangan','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Menu',
                'menu' => $this->m_menu->lists(),
                'isi' => 'menu/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'nama_makanan' => $this->input->post('nama_makanan'),
            'harga' => $this->input->post('harga'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->m_menu->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('menu');
        }
    }
    function edit($menu_id) {
		$this->form_validation->set_rules('nama_makanan', 'Nama Makanan','required');
		$this->form_validation->set_rules('harga', 'Harga','required');
		$this->form_validation->set_rules('keterangan', 'Keterangan','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Menu',
                'menu' => $this->m_menu->detail($menu_id),
                'isi' => 'menu/v_edit'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'menu_id' => $menu_id,
            'nama_makanan' => $this->input->post('nama_makanan'),
            'harga' => $this->input->post('harga'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->m_menu->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
        redirect('menu');
        }
    }
    function delete($menu_id) {
        $data = array(
            'menu_id' => $menu_id,
        );
        $this->m_menu->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('menu');
    }
}