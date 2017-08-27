<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perawat extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('table', 'session'));
        $this->load->model(array('m_perawat'));
        $this->load->database();
    }

    public function index() {
        $this->load->view('v_nav_header');

        $perawats = $this->m_perawat->list_data()->result();

        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'ID', 'Nama', 'Alamat', 'No. Telepon', 'Jenis Kelamin', 'Actions');
        $i = 0;
        foreach ($perawats as $perawat) {
            $this->table->add_row(
                    ++$i, 
                    $perawat->ID_PERAWAT, 
                    ucwords(strtolower($perawat->NAMA_PERAWAT)),
                    ucwords(strtolower($perawat->ALAMAT_PERAWAT)),  
                    $perawat->TLPN, 
                    ucwords(strtolower($perawat->JK_PERAWAT)),     
                    anchor('perawat/view/' . $perawat->ID_PERAWAT, 
                        '<i class="fa fa-search-plus"></i>', 
                        array('class' => 'btn btn-info', 'title' => 'View Detail')) . ' ' .
                    anchor('perawat/update/' . $perawat->ID_PERAWAT, 
                        '<i class="fa fa-pencil"></i>', 
                        array('class' => 'btn btn-warning', 'title' => 'Edit Data')) . ' ' .
                    anchor('perawat/delete/' . $perawat->ID_PERAWAT, 
                        '<i class="fa fa-trash-o"></i>', 
                        array('class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure want to delete this perawat?')", 'title' => 'Delete Data'))
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
        $this->load->view('v_perawat', $data);
        $this->load->view('v_nav_footer');
    }

    function add() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Add new perawat';
        $data['action'] = site_url('perawat/addData');
        $data['link_back'] = anchor('perawat/index/', 'Back to list of perawats', array('class' => 'back'));

        /* Meload view */
        $this->load->view('v_form_perawat', $data);
    }

    function addData() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Add new perawat';
        $data['action'] = site_url('perawat/addData');

            /* Deklarasi data untuk di-insert-kan ke database */
            $perawat = array(
                'ID_PERAWAT' => $this->input->post('ID_PERAWAT'),
                'NAMA_PERAWAT' => $this->input->post('NAMA_PERAWAT'),
                'ALAMAT_PERAWAT' => $this->input->post('ALAMAT_PERAWAT'),
                'TLPN' => $this->input->post('TLPN'),
                'JK_PERAWAT' => $this->input->post('JK_PERAWAT')
            );

            /* Insert data ke database */
            $this->m_perawat->insert($perawat);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-insert-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-success" style="color:green;" id="alert"><i class="fa fa-info-circle"></i> <h4>Data telah ditambahkan.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect('perawat','refresh');
    }

    function view($id) {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Person Details';
        $data['link_back'] = anchor('perawat/index/', 'Back to list of perawats', array('class' => 'back'));

        /* Ambil detail data */
        $data['perawat'] = $this->m_perawat->get_by_id($id)->row();

        /* Meload view */
        $this->load->view('v_detail_perawat', $data);
    }

    function update($id) {
        /* Isi data form sesuai data di database */
        $perawat = $this->m_perawat->get_by_id($id)->row();
        $_POST['ID_PERAWAT'] = $perawat->ID_PERAWAT;
        $_POST['NAMA_PERAWAT'] = $perawat->NAMA_PERAWAT;
        $_POST['ALAMAT_PERAWAT'] = $perawat->ALAMAT_PERAWAT;
        $_POST['TLPN'] = $perawat->TLPN;
        $_POST['JK_PERAWAT'] = $perawat->JK_PERAWAT;
        
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Update perawat';
        $data['action'] = site_url('perawat/updateData');
        $data['link_back'] = anchor('perawat/index/', 'Back to list of perawats', array('class' => 'back'));

        /* Meload view */
        $this->load->view('v_form_perawat', $data);
    }

    function updateData() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Update perawat';
        $data['action'] = site_url('perawat/updateData');

            /* Deklarasi data untuk di-update-kan ke database */
            $id = $this->input->post('ID_PERAWAT');
            $perawat = array(
                'ID_PERAWAT' => $this->input->post('ID_PERAWAT'),
                'NAMA_PERAWAT' => $this->input->post('NAMA_PERAWAT'),
                'ALAMAT_PERAWAT' => $this->input->post('ALAMAT_PERAWAT'),
                'TLPN' => $this->input->post('TLPN'),
                'JK_PERAWAT' => $this->input->post('JK_PERAWAT')
            );

            /* Update data ke database */
            $this->m_perawat->update($id, $perawat);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-update-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-danger" style="color:blue;" id="alert"><i class="fa fa-info-circle fa-2x"></i><h4>Data telah diupdate.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect('perawat','refresh');
        }

    function delete($id) {
        /* Perintah untuk delete data */
        $this->m_perawat->delete($id);

        /* Pesan untuk ditampilkan, bahwa data telah berhasil di-delete dari database */
        $this->session->set_flashdata('pesan', 
            '<center>
            <div class=\"alert alert-success\" style=\"color:tomato;\" id=\"alert\"><i class=\"fa fa-info-circle\"></i> 
            <h4>Data telah di-delete.</h4>
            </div>
            </center>');

        /* Kembali ke halaman master data */
        redirect('perawat','refresh');
    }
}
