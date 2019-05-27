<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright 2019 sebastien Piret
 */

class Login extends CI_Controller
{
    public function index()
    {
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/logout');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }else {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/login');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }
    }

    public function checkUser()
    {
        $this->form_validation->set_rules('login','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() == false)
        {
            setFlashdata('alert-danger','you entered the wrong credential.','login');
        }else{
            $data['mail']=html_escape($this->input->post('login',true));
            $data['mdp']=html_escape($this->input->post('password',true));
            $data['mdp']=hash('sha224',$data['mdp']);
            $user =$this->modUser->checkUser($data);
            if(count($user)==1){
                if($user[0]['role'] == 2 || $user[0]['role'] == 3){

                    if($user[0]['mdp'] == $data['mdp'])
                    {
                        // create the session
                        $myActualUser=array(
                            'id'=>$user[0]['id'],
                            'mail'=>$user[0]['mail'],
                            'nom'=>$user[0]['nom'],
                            'prenom'=>$user[0]['prenom'],
                            'role'=>$user[0]['role']
                        );
                        $this->session->set_userdata($myActualUser);
                        if($this->session->userdata('id')){
                            setFlashdata('alert-success','Welcome '.$this->session->userdata('prenom').' '.$this->session->userdata('nom').', you are correctly logged in! ','login');
                        }else{
                            setFlashdata('alert-danger','You are not logged in.','login');
                        }

                    }else{
                        setFlashdata('alert-danger','Please check your password.','login');
                    }
                }else{
                    setFlashdata('alert-danger','this user is not activated, please check your email.','login');
                }

            }else{
                setFlashdata('alert-danger','this user is not registred.','login');
            }
        }
    }

    public function logOut()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}