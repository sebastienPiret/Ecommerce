<?php
/**
 * Copyright 2019 sebastien Piret
 */

class Admin extends CI_Controller
{
    public function index()
    {
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/home/login');
        //$this->load->view('admin/header/footer');
        $this->load->view('admin/header/closehtml');
    }

    public function dashboard()
    {
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/navbar');
        $this->load->view('admin/home/main');
        $this->load->view('admin/header/footer');
        $this->load->view('admin/header/specialJs');
        $this->load->view('admin/header/closehtml');
    }
}