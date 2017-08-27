<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('table', 'session'));
        $this->load->model(array('m_dokter'));
        $this->load->database();
    }

    public function index() {
        $this->load->view('v_nav_header');

        $dokters = $this->m_dokter->list_data()->result();

        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('No', 'ID', 'Nama', 'Alamat', 'Jenis Kelamin', 'Spesialis', 'No. Telepon', 'Actions');
        $i = 0;
        foreach ($dokters as $dokter) {
            $this->table->add_row(
                    ++$i, 
                    $dokter->ID_DOKTER, 
                    ucwords(strtolower($dokter->NAMA_DOKTER)), 
                    ucwords(strtolower($dokter->ALAMAT_DOKTER)),
                    ucwords(strtolower($dokter->JENIS_KELAMIN)), 
                    ucwords(strtolower($dokter->SPESIALIS)), 
                    $dokter->TELPON,     
                    anchor('dokter/view/' . $dokter->ID_DOKTER, 
                        '<i class="fa fa-search-plus"></i>', 
                        array('class' => 'btn btn-info', 'title' => 'View Detail')) . ' ' .
                    anchor('dokter/update/' . $dokter->ID_DOKTER, 
                        '<i class="fa fa-pencil"></i>', 
                        array('class' => 'btn btn-warning', 'title' => 'Edit Data')) . ' ' .
                    anchor('dokter/delete/' . $dokter->ID_DOKTER, 
                        '<i class="fa fa-trash-o"></i>', 
                        array('class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure want to delete this dokter?')", 'title' => 'Delete Data'))
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
        $this->load->view('v_dokter', $data);
        $this->load->view('v_nav_footer');
    }

    function add() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Add new dokter';
        $data['action'] = site_url('dokter/addData');
        $data['link_back'] = anchor('dokter/index/', 'Back to list of dokters', array('class' => 'back'));

        /* Meload view */
        $this->load->view('v_form_dokter', $data);
    }

    function addData() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Add new dokter';
        $data['action'] = site_url('dokter/addData');

            /* Deklarasi data untuk di-insert-kan ke database */
            $dokter = array(
                'ID_DOKTER' => $this->input->post('ID_DOKTER'),
                'NAMA_DOKTER' => $this->input->post('NAMA_DOKTER'),
                'ALAMAT_DOKTER' => $this->input->post('ALAMAT_DOKTER'),
                'JENIS_KELAMIN' => $this->input->post('JENIS_KELAMIN'),
                'SPESIALIS' => $this->input->post('SPESIALIS'),
                'TELPON' => $this->input->post('TELPON')
            );

            /* Insert data ke database */
            $this->m_dokter->insert($dokter);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-insert-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-success" style="color:green;" id="alert"><i class="fa fa-info-circle"></i> <h4>Data telah ditambahkan.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect('dokter','refresh');
    }

    function view($id) {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Person Details';
        $data['link_back'] = anchor('dokter/index/', 'Back to list of dokters', array('class' => 'back'));

        /* Ambil detail data */
        $data['dokter'] = $this->m_dokter->get_by_id($id)->row();

        /* Meload view */
        $this->load->view('v_detail_dokter', $data);
    }

    function update($id) {
        /* Isi data form sesuai data di database */
        $dokter = $this->m_dokter->get_by_id($id)->row();
        $_POST['ID_DOKTER'] = $dokter->ID_DOKTER;
        $_POST['NAMA_DOKTER'] = $dokter->NAMA_DOKTER;
        $_POST['ALAMAT_DOKTER'] = $dokter->ALAMAT_DOKTER;
        $_POST['JENIS_KELAMIN'] = $dokter->JENIS_KELAMIN;
        $_POST['SPESIALIS'] = $dokter->SPESIALIS;
        $_POST['TELPON'] = $dokter->TELPON;
        
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Update dokter';
        $data['action'] = site_url('dokter/updateData');
        $data['link_back'] = anchor('dokter/index/', 'Back to list of dokters', array('class' => 'back'));

        /* Meload view */
        $this->load->view('v_form_dokter', $data);
    }

    function updateData() {
        /* Atur data yang akan ditampilkan */
        $data['title'] = 'Update dokter';
        $data['action'] = site_url('dokter/updateData');

            /* Deklarasi data untuk di-update-kan ke database */
            $id = $this->input->post('ID_DOKTER');
            $dokter = array(
                'ID_DOKTER' => $this->input->post('ID_DOKTER'),
                'NAMA_DOKTER' => $this->input->post('NAMA_DOKTER'),
                'ALAMAT_DOKTER' => $this->input->post('ALAMAT_DOKTER'),
                'JENIS_KELAMIN' => $this->input->post('JENIS_KELAMIN'),
                'SPESIALIS' => $this->input->post('SPESIALIS'),
                'TELPON' => $this->input->post('TELPON')
            );

            /* Update data ke database */
            $this->m_dokter->update($id, $dokter);

            /* Pesan untuk ditampilkan, bahwa data telah berhasil di-update-kan ke database */
            $this->session->set_flashdata('pesan', '<center><div class="alert alert-danger" style="color:blue;" id="alert"><i class="fa fa-info-circle fa-2x"></i><h4>Data telah diupdate.</h4></div></center>');

            /* Kembali ke halaman master data */
            redirect('dokter','refresh');
        }

    function delete($id) {
        /* Perintah untuk delete data */
        $this->m_dokter->delete($id);

        /* Pesan untuk ditampilkan, bahwa data telah berhasil di-delete dari database */
        $this->session->set_flashdata('pesan', 
            '<center>
            <div class=\"alert alert-success\" style=\"color:tomato;\" id=\"alert\"><i class=\"fa fa-info-circle\"></i> 
            <h4>Data telah di-delete.</h4>
            </div>
            </center>');

        /* Kembali ke halaman master data */
        redirect('dokter','refresh');
    }
}
