<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright 2019 sebastien Piret
 */

//require 'PHPMailer/PHPMailerAutoload.php';

class Registration extends CI_Controller
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
            $this->load->view('home/registration');
            $this->load->view('header/footer');
            $this->load->view('header/specialJs');
            $this->load->view('header/htmlclose');
        }
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
                   //$this->sendEmailUser($data);
                   $this->sendEmailUser($data);
                   setFlashdata('alert-success','You are correctly registred, please check your email to confirm it before login.','registration');
               }
               else{
                   setFlashdata('alert-danger','you cannot be registred right now, please try again later','registration');
               }
            }

        }
    }

    public function activateAccount($link)
    {
        if(!empty($link) && isset($link))
        {
            $user=$this->modUser->checkLink($link);

            if(count($user)==1){
                $userData['link']=$user[0]['link'].'ok';
                $userData['role']=2;
                $updatedUser=$this->modUser->activateUser($user[0]['id'],$userData);
                if($updatedUser){
                    setFlashdata('alert-success','Bravo! You\'ve correctly activated your account! Please login to begin shopping','login');
                }else{
                    setFlashdata('alert-danger','Something went wrong','registration');
                }

            }else{
                setFlashdata('alert-danger','link not available, or expired','registration');
            }
        }
        else{
            setFlashdata('alert-danger','Check your mail and try again','registration');
        }
    }

    private function sendEmailUser($data)
    {
        $userLink = site_url('registration/activateAccount/'.$data['link']);
        $myData = '<p>'.ucfirst(strtolower($data['prenom'])).' '.ucfirst(strtolower($data['nom'])).', please click on this <a href="'.$userLink.'"> link </a>to activate your account.</p><br>';

        $to       = $data['mail'];
        $subject  = 'Bakery account activation';
        $message  = $myData;
        $headers  = 'From: sebquadris@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
        if(mail($to, $subject, $message, $headers))
            echo "Email sent";
        else
            echo "Email sending failed";

        /*
         * configuration in a server

        $config= array(
            'useragent'=>'CodeIgniter',
            'protocol'=>'mail',
            'mailpath'=>'/usr/sbin/sendmail',
            'smtp_host'=>'localhost',
            'smtp_user'=>'sebquadris@gmail.com',
            'smtp_pass'=>'loginGmail',
            'smtp_port'=>25,
            'smtp_timeout'=>'55',
            'wordwrap'=>TRUE,
            'wrapchars'=>76,
            'mailtype'=>'html',
            'charset'=>'utf-8',
            'validate'=>FALSE,
            'priority'=>3,
            'crlf'=>'\r\n',
            'newline'=>'\r\n',
            'bcc_batch_mode'=>FALSE,
            'bcc_batch_size'=>200,
        );
        $this->email->initialize($config);

        $this->email->from('sebpiret@hotmail.com');
        $this->email->to($data['mail']);
        $this->email->subject('Account activation');
        $this->email->message($myData);
        if($this->email->send())
        {
            return true;
        }
        else{
            return false;
        }
        */

    }
}