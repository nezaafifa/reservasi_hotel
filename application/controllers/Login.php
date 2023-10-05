<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('M_user');
    }
    public function index() {
        // $this->session->dess_destroy();
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('v_login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->M_user->get_user($username);

            if ($user && password_verify($password, $user->password)) {
                $data = array(
                    'user_id' => $user->user_id,
                    'username' => $user->username,
                    'nama' => $user->nama,
                    'alamat' => $user->alamat,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                redirect('home'); 
            } else {
                $this->session->set_flashdata('message', 'Login failed. Invalid username or password.');
                redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}