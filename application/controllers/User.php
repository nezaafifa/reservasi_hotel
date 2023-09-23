<?php 

class User extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('m_user');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'User',
            'user' => $this->m_user->lists(),
            'isi' => 'user/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('username', 'Username','required');
		$this->form_validation->set_rules('password', 'Password','required');
		$this->form_validation->set_rules('nama', 'Nama','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add User',
                'user' => $this->m_user->lists(),
                'isi' => 'user/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_user->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('user');
        }
    }
    function edit($id_user) {
		$this->form_validation->set_rules('username', 'Username','required');
		$this->form_validation->set_rules('password', 'Password','required');
		$this->form_validation->set_rules('nama', 'Nama','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit User',
                'user' => $this->m_user->detail($id_user),
                'isi' => 'user/v_edit'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'id_user' => $id_user,
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_user->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
        redirect('user');
        }
    }
    function delete($id_user) {
        $data = array(
            'id_user' => $id_user,
        );
        $this->m_user->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('user');
    }
}