<?php 

class Home extends CI_Controller {
    
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Dashboard',
            'isi' => 'v_home'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
}