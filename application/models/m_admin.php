<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_admin extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private $tabel = 'admin';

    function jumlah_user() {
        $jumlah = $this->db->get($this->tabel);
        $jumlah_user = $jumlah->num_rows();
        return $jumlah_user;
    }

    /* Digunakan untuk mengambil semua data username */

    function get_data() {
        $this->db->from($this->tabel);
        $query = $this->db->get();

        //cek apakah ada baris data dalam tabel
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    /* Ambil data di database, sesuai id tertentu */

    function get_by_id($id_user) {
        $this->db->where('id_admin', $id_user);
        $q = $this->db->get($this->tabel);
        return $q->result();
    }

    function get_username($username, $mdpass) {
        $this->db->where("username='$username' AND password='$mdpass' AND (level='1' OR level='2')");
        $query = $this->db->get($this->tabel);
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

}
