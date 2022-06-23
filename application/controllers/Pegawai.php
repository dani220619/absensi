<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mod_admin');
    }
    public function index()
    {
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/index', $data);
        $this->load->view('template/footer');
    }
}
