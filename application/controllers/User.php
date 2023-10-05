<?php 

class User extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->library('form_validation');
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
    /**
     * fungsi password_hash sama dengan md5 
     * atau Hash di laravel, fungsinya untuk mengenerate password
     * agar lebih aman :)
     */
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
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
        );
        $this->m_user->add($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
        redirect('user');
        }
    }
    function edit($user_id) {
		$this->form_validation->set_rules('username', 'Username','required');
		$this->form_validation->set_rules('password', 'Password','required');
		$this->form_validation->set_rules('nama', 'Nama','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit User',
                'user' => $this->m_user->detail($user_id),
                'isi' => 'user/v_edit'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        } else {
        $data = array(
            'user_id' => $user_id,
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
    function delete($user_id) {
        $data = array(
            'user_id' => $user_id,
        );
        $this->m_user->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('user');
    }
}