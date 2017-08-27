<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('table', 'session'));
        $this->load->model('m_admin');
        $this->load->database();
    }

    public function index() {
        $this->load->view('v_nav_header');

        $admins = $this->m_admin->list_data()->result();

        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'ID', 'Nama', 'Alamat', 'No. Telepon', 'Username', 'Password', 'Level', 'Actions');
        $i = 0;
        foreach ($admins as $admin) {
            $this->table->add_row(
                    ++$i, 
                    $admin->ID_ADMIN, 
                    ucwords(strtolower($admin->NAMA_ADMIN)), 
                    ucwords(strtolower($admin->ALAMAT_ADMIN)), 
                    $admin->TELPON,
                    $admin->USERNAME,     
                    $admin->PASSWORD,     
                    $admin->LEVEL,     
                    anchor('admin/view/' . $admin->ID_ADMIN, 
                        '<i class="fa fa-search-plus"></i>', 
                        array('class' => 'btn btn-info', 'title' => 'View Detail')) . ' ' .
                    anchor('admin/update/' . $admin->ID_ADMIN, 
                        '<i class="fa fa-pencil"></i>', 
                        array('class' => 'btn btn-warning', 'title' => 'Edit Data')) . ' ' .
                    anchor('admin/delete/' . $admin->ID_ADMIN, 
                        '<i class="fa fa-trash-o"></i>', 
                        array('class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure want to delete this admin?')", 'title' => 'Delete Data'))
            );
        }
           
        $template = array(
            'table_open' => '<table class="table table-striped" style="margin-top: 35px;">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        /* ========= Generate table data ========= */
        $data['table'] = $this->table->set_template($template);
        $data['table'] = $this->table->generate();

        /* Meload view */
        $this->load->view('v_admin', $data);
        $this->load->view('v_nav_footer');
    }

    function add() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Add new admin';
        $data['action'] = site_url('admin/addData');
        $data['link_back'] = anchor('admin/index/', 'Back to list of admins', array('class' => 'back'));

        /* Meload view */
        $this->load->view('v_form_admin', $data);
    }

    function addData() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Add new admin';
        $data['action'] = site_url('admin/addData');

            /* Deklarasi data untuk di-insert-kan ke database */
            $admin = array(
                'ID_ADMIN' => $this->input->post('ID_ADMIN'),
                'NAMA_ADMIN' => $this->input->post('NAMA_ADMIN'),
                'ALAMAT_ADMIN' => $this->input->post('ALAMAT_ADMIN'),
                'TELPON' => $this->input->post('TELPON'),
                'USERNAME' => $this->input->post('USERNAME'),
                'PASSWORD' => $this->input->post('PASSWORD'),
                'LEVEL' => $this->input->post('LEVEL')
            );

            /* Insert data ke database */
            $this->m_admin->insert($admin);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-insert-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-success" style="color:green;" id="alert"><i class="fa fa-info-circle"></i> <h4>Data telah ditambahkan.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect('admin','refresh');
    }

    function view($id_user) {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Person Details';
        $data['link_back'] = anchor('admin/index/', 'Back to list of admins', array('class' => 'back'));

        /* Ambil detail data */
        $data['admin'] = $this->m_admin->get_by_id($id_user)->row();

        /* Meload view */
        $this->load->view('v_detail_admin', $data);
    }

    function update($id_user) {
        /* Isi data form sesuai data di database */
        $admin = $this->m_admin->get_by_id($id_user)->row();
        $_POST['ID_ADMIN'] = $admin->ID_ADMIN;
        $_POST['NAMA_ADMIN'] = $admin->NAMA_ADMIN;
        $_POST['ALAMAT_ADMIN'] = $admin->ALAMAT_ADMIN;
        $_POST['TELPON'] = $admin->TELPON;
        $_POST['USERNAME'] = $admin->USERNAME;
        $_POST['PASSWORD'] = $admin->PASSWORD;
        $_POST['LEVEL'] = $admin->LEVEL;
        
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Update admin';
        $data['action'] = site_url('admin/updateData');
        $data['link_back'] = anchor('admin/index/', 'Back to list of admins', array('class' => 'back'));

        /* Meload view */
        $this->load->view('v_form_admin', $data);
    }

    function updateData() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Update admin';
        $data['action'] = site_url('admin/updateData');

            /* Deklarasi data untuk di-update-kan ke database */
            $id = $this->input->post('ID_ADMIN');
            $admin = array(
                'ID_ADMIN' => $this->input->post('ID_ADMIN'),
                'NAMA_ADMIN' => $this->input->post('NAMA_ADMIN'),
                'ALAMAT_ADMIN' => $this->input->post('ALAMAT_ADMIN'),
                'TELPON' => $this->input->post('TELPON'),
                'USERNAME' => $this->input->post('USERNAME'),
                'PASSWORD' => $this->input->post('PASSWORD'),
                'LEVEL' => $this->input->post('LEVEL')
            );

            /* Update data ke database */
            $this->m_admin->update($id, $admin);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-update-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-danger" style="color:blue;" id="alert"><i class="fa fa-info-circle fa-2x"></i><h4>Data telah diupdate.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect('admin','refresh');
        }

    function delete($id) {
        /* Perintah untuk delete data */
        $this->m_admin->delete($id);

        /* Pesan untuk ditampilkan, bahwa data telah berhasil di-delete dari database */
        $this->session->set_flashdata('pesan', 
            '<center>
            <div class=\"alert alert-success\" style=\"color:tomato;\" id=\"alert\"><i class=\"fa fa-info-circle\"></i> 
            <h4>Data telah di-delete.</h4>
            </div>
            </center>');

        /* Kembali ke halaman master data */
        redirect('admin','refresh');
    }
}
