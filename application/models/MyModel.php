<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {

    public function insertRecord($data) {
        $this->db->insert('crud', $data);
    }

    public function getRecords() {
        $query = $this->db->get('crud')->result();
       
        $json_data = json_encode($query);
        $this->output->set_content_type('application/json');

        $this->output->set_output($json_data);
    }
}
