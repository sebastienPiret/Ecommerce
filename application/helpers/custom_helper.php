<?php
/**
 * Copyright 2019 sebastien Piret
 */

function setFlashdata($class,$message,$url)
{

    $CI=get_instance();
    $CI->session->set_flashdata('class',$class);
    $CI->session->set_flashdata('message',$message);
    redirect($url);

}

function adminLoggedIn(){
    $CI=get_instance();
    if ($CI->session->userdata('id') && $CI->session->userdata('role')==3){
        return TRUE;
    }else{
        return FALSE;
    }
}

function userLoggedIn(){
    $CI=get_instance();
    if ($CI->session->userdata('id')){
        return TRUE;
    }else{
        return FALSE;
    }
}