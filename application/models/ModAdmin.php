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

    public function displayCategory(){
        $this->db->select('nom');
        $query=$this->db->get('categories');
        $string=[];
        foreach ($query->result() as $row)
        {
            $string[]=$row->nom;
        }
        return $string;
    }

    public function addNewCategory($data){
        $this->db->insert('categories',$data);
    }

    public function checkItem($data)
    {
        return $this->db->get_where('item',array('nom'=>$data['nom']));

    }

    public function addItem($data)
    {
        $this->db->insert('item',$data);
    }

    public function getAllItem()
    {
        return $this->db->get('item')->num_rows();

    }

    public function fetchAllItem($limit,$start)
    {
        $this->db->limit($limit,$start);
        $query= $this->db->get('item');

        if(count($query) >0)
        {
            foreach ($query->result() as $row)
            {
                $data[]=$row;
            }
            return $data;
        }
        return false;
    }

}