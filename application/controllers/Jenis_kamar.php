<?php 

class Jenis_kamar extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('username')){
            redirect('login');
        }
        $this->load->model('m_jenis_kamar');
    }
    function index() {
        $data = array(
            'title' => 'Hotel Biru',
            'title2' => 'Jenis Kamar',
            'jenis_kamar' => $this->m_jenis_kamar->lists(),
            'isi' => 'jenis_kamar/v_list'
        );
    $this->load->view('template/v_wrapper', $data,FALSE);
    }
    function add() {
		$this->form_validation->set_rules('jeniskamar_nama', 'Nama Kamar','required');
		$this->form_validation->set_rules('fasilitas', 'Fasilitas','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Add Jenis Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->lists(),
                'isi' => 'jenis_kamar/v_add'
            );
            $this->load->view('template/v_wrapper', $data,FALSE);
        }
    }
    function add_tambah(){
        $config['upload_path'] = './gambar/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2000;
        $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('gambar'))
                {
                    $data = array(
                        'title' => 'Hotel Biru',
                        'title2' => 'Add Jenis Kamar',
                        'error' => $this->upload->display_errors(),
                        'isi' => 'jenis_kamar/v_add'
                    );
                    $this->load->view('template/v_wrapper', $data,FALSE);
                } else {
                        $upload_data = array('uploads' => $this->upload->data());
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './gambar/'.$upload_data['uploads']['file_name']; 
                        $this->load->library('image_lib', $config);

                        $data = array(
                            'jeniskamar_nama' => $this->input->post('jeniskamar_nama'),
                            'fasilitas' => $this->input->post('fasilitas'),
                            'gambar' => $upload_data['uploads']['file_name']
                        );
                        $this->m_jenis_kamar->add($data);
                        $this->session->set_flashdata('pesan', 'Data Berhasil DiTambahkan !!!');
                        redirect ('jenis_kamar');
                }
    }
    function edit($jeniskamar_id) {
        $this->form_validation->set_rules('jeniskamar_nama', 'Nama Kamar', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Hotel Biru',
                'title2' => 'Edit Jenis Kamar',
                'jenis_kamar' => $this->m_jenis_kamar->detail($jeniskamar_id), // Use $jeniskamar_id here
                'isi' => 'jenis_kamar/v_edit'
            );
            $this->load->view('template/v_wrapper', $data, FALSE);
        }
    }
    function edit_jenis($jeniskamar_id){
        $config['upload_path'] = './gambar/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2000;
        $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('gambar'))
                {
                    $data = array(
                        'title' => 'Hotel Biru',
                        'title2' => 'Edit Jenis Kamar',
                        'error' => $this->upload->display_errors(),
                        'menu' => $this->m_jenis_kamar->detail($jeniskamar_id),
                        'isi' => 'jenis_kamar/v_edit'
                    );
                    $this->load->view('template/v_wrapper', $data,FALSE);
                } else {
                        $upload_data = array('uploads' => $this->upload->data());
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './gambar/'.$upload_data['uploads']['file_name']; 
                        $this->load->library('image_lib', $config);
                        //menghapus file foto lama
                        $jenis_kamar = $this->m_jenis_kamar->detail($jeniskamar_id);
                        if ($jenis_kamar->gambar !="") {
                            unlink('./gambar/'.$jenis_kamar->gambar);
                        }
                        //end menghapus foto
                        $data = array(
                            'jeniskamar_id' => $jeniskamar_id,
                            'jeniskamar_nama' => $this->input->post('jeniskamar_nama'),
                            'fasilitas' => $this->input->post('fasilitas'),
                            'gambar' => $upload_data['uploads']['file_name']
                        );
                        $this->m_jenis_kamar->edit($data);
                        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
                        redirect ('jenis_kamar');
                }
                        $upload_data = array('uploads' => $this->upload->data());
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './gambar/'.$upload_data['uploads']['file_name']; 
                        $this->load->library('image_lib', $config);

                        $data = array(
                            'jeniskamar_id' => $jeniskamar_id,
                            'jeniskamar_nama' => $this->input->post('jeniskamar_nama'),
                            'fasilitas' => $this->input->post('fasilitas'),f
                        );
                        $this->m_jenis_kamar->edit($data);
                        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
                        redirect ('menu');
    }
    function delete($jeniskamar_id) {
        $jenis_kamar = $this->m_jenis_kamar->detail($jeniskamar_id);
        if ($jenis_kamar->gambar !="") {
            unlink('./gambar/'.$jenis_kamar->gambar);
        }
        $data = array(
            'jeniskamar_id' => $jeniskamar_id,
        );
        $this->m_jenis_kamar->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        redirect ('jenis_kamar');
    }
}