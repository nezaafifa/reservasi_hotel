<?php 

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Dashboard',
            'isi' => 'v_home'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
}