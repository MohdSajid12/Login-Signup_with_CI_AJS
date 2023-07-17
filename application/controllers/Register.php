<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('Rgstr');
    }

    public function login()
    {
        $this->load->view('lgn');
    }

    public function welcome()
    {
        $this->load->view('red');
    }

    public function addUser()
    {
        
        $this->form_validation->set_rules('firstname', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('conpassword', 'Password Confirmation', 'required|matches[password]');
    
        $response = array(
            'status' => 'error',
            'message' => 'Validation Error',
            'errors' => array()
        );
    
        if ($this->form_validation->run()==FALSE) {
            $response['errors'] = $this->form_validation->error_array();
           
        } else {
    
            $userData = array(
                'firstname' => $this->input->post('firstname'),
                'email' => $this->input->post('email'),
                'password' =>md5( $this->input->post('password',true)),
            );
           
            $insert_id = $this->Data->addUser($userData);
    
            if ($insert_id) {
                $response['status'] = 'success';
                $response['message'] = 'Register Successfully';
                $response['response_data'] = $userData;
               
            } else {
                $response['message'] = 'Failed to register';
            }
        }
    
        echo json_encode($response);
    }

    public function loginUser()
    {
     
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
    
        $response = array(
            'status' => 'error',
            'message' => 'Validation Error',
            'errors' => array()
        );
    
        if ($this->form_validation->run()==FALSE) {
            $response['errors'] = $this->form_validation->error_array();
           
        } else {
            
            $userData = array(
                'email' => $this->input->post('email'),
                'password' =>md5( $this->input->post('password',true)),
            );

            $insert_id = $this->Data->checkUser($userData);
    
            if ($insert_id) {
                $response['status'] = 'success';
                $response['message'] = 'Login Successfully';
                $response['response_data'] = $userData;
                $this->session->set_flashdata('success_message', 'Login Successfully');
            } else {
                $response['message'] = 'Failed to Login';
                $response['error_message'] = 'Please check your email and password';
            }
        }
    
        echo json_encode($response);
    }
}
?>