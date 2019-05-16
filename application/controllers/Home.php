<?php
/**
 * Copyright 2019 sebastien Piret
 */

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/main');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }
}