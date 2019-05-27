<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright 2019 sebastien Piret
 */

class Checkout extends CI_Controller
{
    public function index()
    {
// Redirect if the cart is empty
        if($this->cart->total_items() <= 0){
            redirect('home/menu');
        }
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/checkout',$data);
            $this->load->view('header/footer');
            $this->load->view('header/htmlclosebis');
        }else {
            $this->session->set_flashdata('class','alert-danger');
            $this->session->set_flashdata('message','you need to login to view your cart.');
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/checkout');
            $this->load->view('header/footer');
            $this->load->view('header/htmlclosebis');
            //setFlashdata('alert-danger','you need to be logged in to view your cart.','cart/');

        }
    }

    public function recordOrder()
    {
        $data['utilisateur']=$this->session->userdata('id');
        $data['Total']=$this->cart->total();
        //$data['cartItems'] = $this->cart->contents();
        //var_dump($this->cart->contents());
        $i=0;
        $comID=$this->modUser->insertOrder($data);
        foreach ($this->cart->contents() as $items)
        {
            $order[$i]['commande_ID']=$comID;
            $order[$i]['item_ID']=$items['id'];
            $order[$i]['subTotal']=$items['subtotal'];
            $order[$i]['quantity']=$items['qty'];
            $this->modUser->insertOrderItems($order,$i);
            $i++;
        }

        if(!empty($order))
        {
            $this->cart->destroy();
            setFlashdata('alert-success','your order is correcty recorded.','cart/');
        }else{
            setFlashdata('alert-danger','your order is not recorded.','cart/');
        }

    }
}