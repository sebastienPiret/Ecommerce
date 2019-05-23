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

    public function getAllCategory()
    {

    }

    public function checkItem($data)
    {
        return $this->db->get_where('item',array('nom'=>$data['nom']));

    }

    public function addItem($data)
    {
        return $this->db->insert('item',$data);
    }

    public function getAllItem()
    {
        return $this->db->get('item')->num_rows();

    }

    public function fetchAllItem($limit,$start)
    {
        $this->db->limit($limit,$start);
        $this->db->select('i.id, i.nom, price, path, i.categorie, c.nom AS nomCategorie');
        $this->db->from('item AS i');
        $this->db->join('categories AS c', 'i.categorie = c.id');
        $query= $this->db->get();

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

    public function checkItemById($id)
    {
        return $this->db->get_where('item',array('id'=>$id))->result_array();
    }

    public function updateItem($data,$id)
    {
        $this->db->where('id',$id);
        return $this->db->update('item',$data);
    }

    public function getImageItem($id)
    {
        return $this->db->select('path')
            ->from('item')
            ->where('id',$id)
            ->get()
            ->result_array();
    }

    public function deleteItem($id)
    {
        return $this->db->delete('item',array('id'=>$id));
    }
}