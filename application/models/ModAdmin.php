<?php
/**
 * Copyright 2019 sebastien Piret
 */

class ModAdmin extends CI_Model
{
    public function checkAdmin($data)
    {
        return $this->db->get_where('utilisateur',$data)->result_array();
    }
}