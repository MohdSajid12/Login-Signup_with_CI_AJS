<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MyModel');
        $this->load->database(); // Load the database library~
    }
    
    public function indexx() {
        $this->load->view('crud');
    }

    public function create() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        );
        $insert = $this->MyModel->insertRecord($data);
        if ($insert) {
            echo "data submitted";
        } else {
           echo "something went wrong";
        }
    }

    public function get() {
        $res = $this->db->get('crud')->result();
        $data_arr = array();
        $i = 0;

        foreach ($res as $r) {
            $data_arr[$i]['id'] = $r->id;
            $data_arr[$i]['name'] = $r->name;
            $data_arr[$i]['email'] = $r->email;
            $i++;
        }
        echo json_encode($data_arr);
    }
}
