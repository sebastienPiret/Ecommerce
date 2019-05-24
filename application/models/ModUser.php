<?php
/**
 * Copyright 2019 sebastien Piret
 */

class ModUser extends CI_Model
{
    public function checkUser($data)
    {
        return $this->db->get_where('utilisateur',array('mail'=>$data['mail']))->result_array();
    }

    public function addUser($data)
    {
        return $this->db->insert('utilisateur',$data);
    }
}