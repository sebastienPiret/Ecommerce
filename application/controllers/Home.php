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

    public function about()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/about');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function contact()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/contact');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function team()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/team');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function menu()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/menu');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function cart()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/cart');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function login()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/login');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function inscription()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/inscription');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }


}