<?php

class Data extends CI_Model{

    public function addUser($userData)
    {
        $this->db->insert('users' , $userData);
        return $this->db->insert_id();
    }

    public function checkUser($userData)

    {
      return $this->db->get_where('users' ,$userData)->result_array();
    }
}

?>