<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright 2019 sebastien Piret
 */

class Home extends CI_Controller
{
    public function index()
    {
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/main');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }else {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/main');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }
    }

    public function about()
    {
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/about');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }else {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/about');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }
    }

    public function contact()
    {
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/contact');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }else {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/contact');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }
    }

    public function contactMail()
    {
        $to = 'sebquadris@gmail.com';
        $name = $_POST["name"];
        $email= $_POST["email"];
        $text= $_POST["message"];
        $subject= $_POST["subject"];



        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $message ='<table style="width:100%">
        <tr>
            <td>'.$name.'  '.$subject.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>subject: '.$subject.'</td></tr>
        <tr><td>Text: '.$text.'</td></tr>
        
    </table>';

        if (@mail($to, $email, $message, $headers))
        {
            setFlashdata('alert-success','your message has been sent.','home/contact');
        }else{
            setFlashdata('alert-danger','your message has not been sent.','home/contact');
        }
    }

    public function team()
    {
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/team');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }else {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/team');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }
    }

    public function logout()
    {
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/logout');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }else{
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/login');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclose');
        }
    }

    public function menu()
    {
        $data['allItems']=$this->modUser->fetchAllItem();
        $data['allCategories']=$this->modUser->getAllCategories();
        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/menu',$data);
            $this->load->view('header/footer');
            $this->load->view('header/galleryJs');
            $this->load->view('header/htmlclose');
        }else {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/menu',$data);
            $this->load->view('header/footer');
            $this->load->view('header/galleryJs');
            $this->load->view('header/htmlclose');
        }
    }

    public function addToCart($id)
    {
        $product = $this->modUser->getRows($id);

        // Add product to the cart
        $data = array(
            'id'    => $product['id'],
            'qty'    => 1,
            'price'    => $product['price'],
            'name'    => $product['nom'],
            'image' => $product['path']
        );
        $this->cart->insert($data);

        // Redirect to the cart page
        redirect('cart');
    }


}