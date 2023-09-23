<?php 

class User_login {
    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('m_login');
    } 
    function login($username,$password){
        $cek=$this->ci->m_login->login($username,$password);
        if($cek) {
            $id_user = $cek->id_user;
            $username = $cek->username;
            $nama = $cek->nama;
            $alamat = $cek->alamat;
            // buat session
            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('nama', $nama);
            $this->ci->session->set_userdata('alamat', $alamat);
            redirect ('home');
        } else {
            $this->ci->session->set_flashdata('pesan','Username Atau Password Salah !!!');
            redirect ('login');
        }
    }
    function cek_login() {
        if($this->ci->session->userdata('username')=="") {
            $this->ci->session->set_flashdata('pesan','Anda Belum Login !!!');
            redirect ('login');
        }
    }
    function logout() {
        $this->ci->session->unset_userdata('id_user');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('alamat');
        $this->ci->session->unset_userdata('nama');
        $this->ci->session->set_flashdata('pesan','Logout Sukses !!!');
        redirect ('login');
    }
}