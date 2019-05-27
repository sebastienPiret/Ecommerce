<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright 2019 sebastien Piret
 */

class Cart extends CI_Controller
{
    public function index()
    {
        $data = array();

        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        $data['order']=$this->modUser->getCommande($this->session->userdata('id'));
        //var_dump($data);

        if(userLoggedIn())
        {
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbarUser');
            $this->load->view('home/cart',$data);
            $this->load->view('header/footer');
            $this->load->view('header/htmlclosebis');
        }else {
            $this->session->set_flashdata('class','alert-danger');
            $this->session->set_flashdata('message','you need to login to view your cart.');
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('home/cart',$data);
            $this->load->view('header/footer');
            $this->load->view('header/htmlclosebis');
            //setFlashdata('alert-danger','you need to be logged in to view your cart.','cart/');

        }

    }
    public function updateItemQty(){
        $update = 0;

        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');

        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }

        // Return response
        echo $update?'ok':'err';
    }


    public function removeItem($rowid){
        // Remove item from cart

        $remove = $this->cart->remove($rowid);

        if($remove)
        {
            echo 'success';
            //return true;
        }else{
            echo 'success';
            setFlashdata('alert-danger','you need to be logged in to view your cart.','cart/');
            return false;
        }
        // Redirect to the cart page

        redirect('cart');
    }
}