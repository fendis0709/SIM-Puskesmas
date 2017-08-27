<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'security'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('m_admin'));
        $this->load->database();
    }

    public function index() {
        $username = $this->session->userdata('username_admin');
        if (isset($username)) {
            $this->load->view('v_nav_header');
            $this->load->view('v_home');
            $this->load->view('v_nav_footer');
//            $this->load->view('welcome_message');
        } else {
            $this->load->view('akun/v_login');
        }
    }

    function aturan_form_login() {
        $rules = array(
            'username' => array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|xss_clean'
            ),
            'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean'
            )
        );
        $this->form_validation->set_rules($rules);

        $this->form_validation->set_error_delimiters('<label class="control-label" for="inputError" style="color: tomato;"><i class="fa fa-times-circle-o"></i>&nbsp;&nbsp;&nbsp;', '</label>');
        $catatan = array(
            'required' => 'Harap Diisi.',
            'xss_clean' => 'Scripting detected...!!!'
        );

        $data['message'] = $this->form_validation->set_message($catatan);
    }

    function login() {
        $this->aturan_form_login();
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('pesan', '<center><div class="alert" style="color:tomato; font-size: 16pt;"><i class="fa fa-warning"></i><p>Username dan Password salah.</p></div></center>');
            $this->load->view('akun/v_login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $mdpass = md5($password);

            $get = $this->m_admin->get_username($username, $mdpass);

            if ($get == TRUE) {
                foreach ($get as $row) {
                    $id = $row->ID_ADMIN;
                    $nama = $row->NAMA_ADMIN;
                    $alamat = $row->ALAMAT_ADMIN;
                    $telpon = $row->TELPON;
                    $username_admin = $row->USERNAME;
                    $level = $row->LEVEL;
                }
                $data = array(
                    'id_admin' => $id,
                    'username_admin' => $username_admin,
                    'nama_admin' => $nama,
                    'alamat_admin' => $alamat,
                    'telepon_admin' => $telpon,
                    'level_admin' => $level
                );
                $this->session->set_userdata($data);
                redirect('home');
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }

    function aturan_form_signup() {
        $rules = array(
            'nama_admin' => array(
                'field' => 'nama_admin',
                'label' => 'Nama',
                'rules' => 'trim|required|xss_clean|max_length[25]',
                'errors' => array(
                    'max_length[25]' => 'Nama maksimal 25 karakter'
                )
            ),
            'alamat_admin' => array(
                'field' => 'alamat_admin',
                'label' => 'Alamat',
                'rules' => 'trim|required|xss_clean|max_length[25]',
                'errors' => array(
                    'max_length[25]' => 'Alamat maksimal 25 karakter'
                )
            ),
            'telepon' => array(
                'field' => 'telepon',
                'label' => 'Telepon',
                'rules' => 'trim|required|xss_clean|max_length[12]|numeric',
                'errors' => array(
                    'max_length[12]' => 'Alamat maksimal 12 angka',
                    'numeric' => 'Nomor telepon hanya boleh diisi angka'
                )
            ),
            'username' => array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|xss_clean',
                'errors' => ''
            ),
            'password' => array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean',
                'errors' => ''
            )
        );
        $this->form_validation->set_rules($rules);

        $this->form_validation->set_error_delimiters('<label class="control-label" for="inputError" style="color: tomato;"><i class="fa fa-times-circle-o"></i>&nbsp;&nbsp;&nbsp;', '</label>');
        $catatan = array(
            'required' => 'Harap Diisi.',
            'xss_clean' => 'Scripting detected...!!!'
        );

        $data['message'] = $this->form_validation->set_message($catatan);
    }
	
	function signup(){
		$this->load->view('akun/v_signup');
	}

    function signup_proses() {
        $this->aturan_form_signup($data);
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('pesan', '<center><div class="alert" style="color:tomato; font-size: 16pt;"><i class="fa fa-warning"></i><p>Oops. Sepertinya Anda salah memasukkan data.</p></div></center>');
            $this->load->view('akun/v_signup', $data);
        } else {
            $jum_akun = $this->m_admin->jumlah_user();
            $id_baru = $jum_akun + 1;
            //hitung banyak nya data disini, lalu ditambah satu
            /* Deklarasi data untuk di-insert-kan ke database */
            $student = array(
                //masukkan hasil penmabahan diatas
                'id_admin' => $id_baru,
                'nama_admin' => $this->input->post('nama_admin'),
                'alamat_admin' => $this->input->post('alamat_admin'),
                'telepon' => $this->input->post('telepon'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );

            /* Insert data ke database */
            $this->m_student->insert($student);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-insert-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-success" style="color:green;" id="alert"><i class="fa fa-info-circle"></i> <h4>Data telah ditambahkan.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect(base_url());
        }
    }

}
