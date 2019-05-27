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

    public function checkLink($link)
    {
        return $this->db->get_where('utilisateur',array('link'=>$link))->result_array();
    }

    public function activateUser($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('utilisateur',$data);
    }

    public function fetchAllItem()
    {
        $this->db->select('i.id, i.nom, price, path,description, i.categorie, c.nom AS nomCategorie, c.id AS idCategorie');
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

    public function getAllCategories()
    {
        $this->db->select('id,nom');
        $query=$this->db->get('categories');

        foreach ($query->result() as $row)
        {
            $data[]=$row;
        }
        return $data;
    }

    /* fetch all products. If $id, returns a single record */
    public function getRows($id='')
    {
        $this->db->select('*');
        $this->db->from('item');
        if($id){
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        // Return fetched data
        return !empty($result)?$result:false;
    }

    /* fetch order. $id returns a single record */
    public function getOrder($id){
        $this->db->select('o.*, c.name, c.email, c.phone, c.address');
        $this->db->from('commande AS o');
        $this->db->join('utilisateur AS c', 'c.id = o.customer_id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();

        // Get order items
        $this->db->select('i.*, p.image, p.name, p.price');
        $this->db->from('commande_item AS i');
        $this->db->join('utilisateur AS p', 'p.id = i.product_id', 'left');
        $this->db->where('i.order_id', $id);
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();

        // Return fetched data
        return !empty($result)?$result:false;
    }

    /* insert commande */
    public function insertOrder($data){
        // Add created and modified date if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }

        // Insert order data
        $insert = $this->db->insert('commande', $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    /* insert commande_item */
    public function insertOrderItems($data = array()) {

        // Insert order items
        $insert = $this->db->insert_batch('commande_item', $data);

        // Return the status
        return $insert?true:false;
    }
}