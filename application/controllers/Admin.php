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

    public function category()
    {
        if(adminLoggedIn()){
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navbar');
            $this->load->view('admin/home/category');
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/specialJs');
            $this->load->view('admin/header/closehtml');
        }else{
            setFlashdata('alert-warning','Please login before accessing dashboard.','admin/login');
        }
    }

    public function item()
    {
        if(adminLoggedIn()){
            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navbar');
            $this->load->view('admin/home/item');
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

    public function addCategory(){
        if(adminLoggedIn())
        {
            $data['nom']=$this->input->post('categoryName','TRUE');
            if(!empty($data)){
                $this->modAdmin->addNewCategory($data);
                setFlashdata('alert-success','Category is correctly added.','admin/category');
            }else{
                setFlashdata('alert-danger','Category name is required.','admin/category');
            }
        }else{
            setFlashdata('alert-warning','Please login before accessing dashboard.','admin/login');
        }
    }

    public function addItem(){

        if(adminLoggedIn())
        {
            $data['nom']=$this->input->post('itemName',true);

            if(!empty($data['nom'])){
                $path=realpath(APPPATH.'../assets/custom/img/item/');
                $config['upload_path']          = $path;
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 200;
                $config['max_width']            = 400;
                $config['max_height']           = 400;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('itemImg')){
                    $error=$this->upload->display_errors();
                    setFlashdata('danger',$error,'admin/item');
                }else{
                    $fileName=$this->upload->data('file_name');
                    $data['path']=$fileName;
                    $data['price']=$this->input->post('itemPrice',true);
                    $data['categorie']=$this->input->post('itemCategory',true)+1;
                }
                $checkData=$this->modAdmin->checkItem($data);
                if($checkData->num_rows()>0){
                    setFlashdata('alert-danger','this item already exists.','admin/item');
                }else{
                    $addData=$this->modAdmin->addItem($data);
                    if($addData){
                        setFlashdata('alert-success','You\'ve successfully added your item.','admin/item');
                    }else{
                        setFlashdata('alert-warning','your item isn\'t successfully added.','admin/item');
                    }
                }

            }else{
                setFlashdata('alert-warning','Item name is required.','admin/item');
            }
        }else{
            setFlashdata('alert-warning','Please login before accessing dashboard.','admin/login');
        }
    }

    public function showAllItem()
    {
        if(adminLoggedIn()){
            $config['base_url']=site_url('admin/showAllItem');
            $totalRows= $this->modAdmin->getAllItem();

            $config['total_rows']=$totalRows;
            $config['per_page']=5;
            $config['uri_segment']=3;
            $this->load->library('pagination');

            $this->pagination->initialize($config);
            $page=($this->uri->segment(3))? $this->uri->segment(3):0;

            $data['allItems']=$this->modAdmin->fetchAllItem($config['per_page'],$page);

            $data['links']= $this->pagination->create_links();

            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navbar');
            $this->load->view('admin/home/showItem',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/specialJs');
            $this->load->view('admin/header/closehtml');
        }else{
            setFlashdata('alert-warning','Please login before accessing dashboard.','admin/login');
        }
    }
}