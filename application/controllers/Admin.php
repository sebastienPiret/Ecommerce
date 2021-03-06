<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Copyright 2019 sebastien Piret
 */

class Admin extends CI_Controller
{
    public function index()
    {
        if(adminLoggedIn()){

            $data['total']=$this->modAdmin->getTotal();
            $data['element']=$this->modAdmin->getPie();


            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navbar');
            $this->load->view('admin/home/main',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/specialJs');
            $this->load->view('admin/header/closehtml');
        }else{
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
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
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
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
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
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
            setFlashdata('alert-success','You\'ve successfully logged out.','admin/login');
        }else{
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
        }
    }

    // Check email and password are linked to admin
    public function checkAdmin()
    {
        $data['mail']=html_escape($this->input->post('mail',true));
        $data['mdp']=html_escape($this->input->post('mdp',true));
        $data['role']=3; // admin number
        $data['mdp']=hash('sha224',$data['mdp']);

        if(!empty($data['mail']) && !empty($data['mdp']))
        {
            $credential=$this->modAdmin->checkAdmin($data);
            if(count($credential)==1){
                $forSession=array(
                    'id'=>$credential[0]['id'],
                    'mail'=>$credential[0]['mail'],
                    'nom'=>$credential[0]['nom'],
                    'prenom'=>$credential[0]['prenom'],
                    'role'=>$credential[0]['role']
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
            if(!empty($data['nom'])){
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
            $data['nom']=html_escape($this->input->post('itemName',true));

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
                    setFlashdata('alert-danger',$error,'admin/item');
                }else{
                    $fileName=$this->upload->data('file_name');
                    $data['path']=$fileName;
                    $data['price']=html_escape($this->input->post('itemPrice',true));
                    $data['categorie']=$this->input->post('itemCategory',true)+1;
                    $data['description']=html_escape($this->input->post('description',true));
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
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
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
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
        }
    }

    public function showOrder()
    {
        if(adminLoggedIn())
        {
            $data['order']=$this->modAdmin->getCommande();

            $this->load->view('admin/header/header');
            $this->load->view('admin/header/css');
            $this->load->view('admin/header/navbar');
            $this->load->view('admin/home/showOrder',$data);
            $this->load->view('admin/header/footer');
            $this->load->view('admin/header/specialJs');
            $this->load->view('admin/header/closehtml');
        }else
        {
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
        }
    }

    public function editItem($id)
    {
        if(adminLoggedIn()){
            if(!empty($id) && isset($id))
            {
                $data['item']=$this->modAdmin->checkItemById($id); // getting the info from db where row is id
                if(count($data['item']) == 1)
                {
                    $this->load->view('admin/header/header');
                    $this->load->view('admin/header/css');
                    $this->load->view('admin/header/navbar');
                    $this->load->view('admin/home/editItem',$data);
                    $this->load->view('admin/header/footer');
                    $this->load->view('admin/header/specialJs');
                    $this->load->view('admin/header/closehtml');
                }else{
                    setFlashdata('alert-danger','Item not found.','admin/showAllItem');
                }
            }else{
                setFlashdata('alert-danger','Something went wrong.','admin/showAllItem');
            }

        }else{
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
        }
    }

    public function updateItem()
    {
        if(adminLoggedIn()){
            $data['nom']=$this->input->post('itemName',true);
            $XID=$this->input->post('XID',true);
            $oldImage=$this->input->post('oldImage',true);
            if(!empty($data['nom']) && isset($data['nom']))
            {
                if(isset($_FILES['itemImg']) && is_uploaded_file($_FILES['itemImg']['tmp_name']))
                {
                    $path=realpath(APPPATH.'../assets/custom/img/item/');
                    $config['upload_path']          = $path;
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 200;
                    $config['max_width']            = 400;
                    $config['max_height']           = 400;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('itemImg')){
                        $error=$this->upload->display_errors();
                        setFlashdata('alert-danger',$error,'admin/editItem/'.$XID);
                    }else{
                        $fileName=$this->upload->data('file_name');
                        $data['path']=$fileName;
                    }
                }
                $data['price']=$this->input->post('itemPrice',true);
                $data['categorie']=$this->input->post('itemCategory',true)+1;
                $data['description']=$this->input->post('description',true);

                $reply=$this->modAdmin->updateItem($data,$XID);
                if($reply)
                {
                    if(!empty($data['path']) && isset($data['path']) && $oldImage!='no.png') // we check we have an image name, and it is not the default one
                    {
                        if (file_exists($path.'/'.$oldImage) && $oldImage != 'no.png')
                        {
                            unlink($path.'/'.$oldImage);  // and if so, we delete the old file

                        }
                    }
                    setFlashdata('alert-success','You\'ve successfully updated your item.','admin/editItem/'.$XID);
                }else{
                    setFlashdata('alert-danger','Something went wrong, please retry later.','admin/editItem/'.$XID);
                }
            }else{
                setFlashdata('alert-danger','Item name is required.','admin/editItem/'.$XID);
            }

        }else{
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
        }
    }

    public function deleteItem()
    {
        if(adminLoggedIn()){
            if ($this->input->is_ajax_request())
            {

                $cId = $this->input->post('text',true);
                if (!empty($cId) && isset($cId))
                {
                    $cId=$this->encryption->decrypt($cId);
                    $oldImage = $this->modAdmin->getImageItem($cId); // get id image to also delete it from file
                    if(!empty($oldImage) && count($oldImage) == 1)
                    {
                        $realImage=$oldImage[0]['path'];
                    }
                    $checkDelete=$this->modAdmin->deleteItem($cId);
                    if($checkDelete)
                    {
                        if(!empty($realImage) && isset($realImage) && $realImage!='no.png') // we check we have an image name, and it is not the default one
                        {
                            $path=realpath(APPPATH.'../assets/custom/img/item/');
                            if (file_exists($path.'/'.$realImage) && $realImage != 'no.png')
                            {
                                unlink($path.'/'.$realImage);  // and if so, we delete the old file

                            }
                        }
                        $data['return']=true;
                        $data['message']='successfully deleted!';
                        echo json_encode($data);
                    }else{
                        $data['return']=false;
                        $data['message']='You cannot delete this item right now.';
                        echo json_encode($data);
                    }
                }else{
                    $data['return']=false;
                    $data['message']='value not exists';
                    echo json_encode($data);
                }

            }else{
                setFlashdata('alert-danger','Something went wrong.','admin/showAllItem');
            }
        }else{
            setFlashdata('alert-danger','Please login before accessing dashboard.','admin/login');
        }
    }
}