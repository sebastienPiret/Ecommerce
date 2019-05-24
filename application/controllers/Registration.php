<?php
/**
 * Copyright 2019 sebastien Piret
 */

class Registration extends CI_Controller
{
    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('header/navbar');
        $this->load->view('home/registration');
        $this->load->view('header/footer');
        $this->load->view('header/htmlclose');
    }

    public function  newUser()
    {
        $this->form_validation->set_rules('nom','nom','required');
        $this->form_validation->set_rules('prenom','prenom','required');
        $this->form_validation->set_rules('email','email','required|valid_email');
        $this->form_validation->set_rules('mdp','password','required');
        $this->form_validation->set_rules('mdp_confirmation','password confirmation','required|matches[mdp]');
        if ($this->form_validation->run() == false)
        {
            setFlashdata('alert-danger','All fields need to be filled, passwords must match','registration');
        }else{
            $data['nom']=html_escape($this->input->post('nom',true));
            $data['prenom']=html_escape($this->input->post('prenom',true));
            $data['mail']=html_escape($this->input->post('email',true));
            $data['mdp']=html_escape($this->input->post('mdp',true));
            //$mdpConfirm=html_escape($this->input->post('mdp_confirmation',true));
            $data['mdp']=hash('sha224',$data['mdp']);
            $data['link']=random_string('alnum',20);
            $user = $this->modUser->checkUser($data);
            if (count($user) == 1)
            {
                setFlashdata('alert-danger','This email is already used','registration');
            }else{
               $userAdded=$this->modUser->addUser($data);
               if ($userAdded)
               {
                   setFlashdata('alert-success','You are correctly registred, please check your email to confirm it before login.','registration');
               }
               else{
                   setFlashdata('alert-danger','you cannot be registred right now, please try again later','registration');
               }
            }

        }
    }
}