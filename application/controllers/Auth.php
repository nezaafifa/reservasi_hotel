<?php

class Auth extends CI_Controller {
    /**
     * construct 
     */
    function __construct(){
        parent::__construct();
        $this->load->model('m_user');
    }
    
}