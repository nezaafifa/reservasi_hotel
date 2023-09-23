<?php 

class Login extends CI_Controller {

    public function __consturct(){
        parent::__construct();
        // $this->load->model('m_user');
        $this->load->library('form_validation');
    }

    // public function validation(){
        $this->form_validation->set_rules('name','Name','trim|required',[
            'required' => 'nama tida boleh kosong',
        ]);
        $this->form_validation->set_rules('username','Email','trim|required|is_unique[user.username]',[
            'reqiured' => 'Username tidak boleh kosong',
            'is_unique' => 'Username sudah tersedia',
        ]);
        $this->form_validation->set_rules('password','Password','required|trim|min_length[6]|matches[confirm_password]',[
            'matches' => 'Password tida sama',
            'min_length' => 'Password minimal 6 karakter atau lebih',
        ]);
        $this->form_validation->set_rules('confirm_password','Confirm_password','required|trim|matches[password]');
    // }

    private function __login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user',['username' => $username])->row_array();
        if($user){
            if($user['is_active'] == 1){
                if(password_verify($password, $user['password'])){
                    $data  = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('home');
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Password salah!</div>');
                    redirect('login');
                }
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Akun tidak aktif!</div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Akun tidak ditemukan!</div>');
            redirect('login');
        }
    }

    public function index(){
        if($this->session->userdata('username')){
            // redirect('user');
            redirect('home');
        }
        $this->form_validation->set_rules('username','Username','trim|required',[
            'required' => 'Email tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 6 karakter atau lebih',
        ]);
        if($this->form_validation->run() == false){
            $this->load->view('v_login');
        }else{
            $this->__login();
        }
    }

    // function auth() {
    //     $username = $this->input->post('username', TRUE);
    //     $password = md5($this->input->post('password', TRUE));
    //     $validate = $this->m_user->validate($username,$password);
    //     if($validate->num_rows() > 0 ){
    //         $data = $validate->row_array();
    //         $nama = $data['nama'];
    //         $sesdata = array(
    //             'username' => $username,
    //             'alamat' => $alamat,
    //             'logged_in' => TRUE
    //         );
    //         $this->session->set_userdata($sesdata);
    //         // if($level === '1'){
    //         //     redirect('page');
    //         // }elseif($level === '2'){
    //         //     redirect('page/author');
    //         // }
    //         redirect('home');
    //     }else {
    //         echo $this->session->set_flashdata('msg','Username atau password salah');
    //         redirect('login');
    //     }
    // }    

    public function logout(){
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert" >Anda berhasil logout!</div>');
        redirect('auth');
    }
}