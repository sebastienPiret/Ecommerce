<?php
/**
 * Copyright 2019 sebastien Piret
 */

class Admin extends CI_Controller
{
    public function index()
    {
        if($this->session->userdata('id')){
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navbar');
            $this->load->view('admin/home/main');
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/specialJs');
            $this->load->view('admin/header/closehtml');
        }else{
            setFlashdata('alert-warning','Please login before accessing dashboard.','admin/login');
        }
    }

    public function login()
    {
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/home/login');
        //$this->load->view('admin/header/footer');
        $this->load->view('admin/header/closehtml');
    }

    public function logout()
    {
        if($this->session->userdata('id')){
            $this->session->set_userdata('id','');
            setFlashdata('alert-warning','You\'ve successfully logged out.','admin/login');
        }else{
            setFlashdata('alert-warning','Please login before accessing dashboard.','admin/login');
        }
    }

    // Check email and password are linked to admin
    public function checkAdmin()
    {
        $data['mail']=$this->input->post('mail',true);
        $data['mdp']=$this->input->post('mdp',true);
        $data['role']=2; // admin number

        if(!empty($data['mail']) && !empty($data['mdp']))
        {
            $credential=$this->modAdmin->checkAdmin($data);
            if(count($credential)==1){
                $forSession=array(
                    'id'=>$credential[0]['id'],
                    'mail'=>$credential[0]['mail'],
                    'nom'=>$credential[0]['nom'],
                    'prenom'=>$credential[0]['prenom']
                );
                $this->session->set_userdata($forSession);
                if ($this->session->userdata('id')){
                    redirect('admin');
                }else{
                    echo 'Something\'s wrong...';
                }

            }else{
                setFlashdata('alert-warning','Please verify your entered correct mail and/or password.','admin/login');
            }
        }
        else{
            setFlashdata('alert-warning','Please enter your mail and/or password.','admin/login');
        }

    }
}