<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin/admin_model', 'admin/admin_category_model', 'admin/user_model'));  //Open 
        $this->load->library(array('session', 'email'));  // Session on each controller
        $this->load->database(); // db 
        $this->load->helper(array('url', 'form', 'file')); // form action basic things
        //$this->load->library('../controllers/Category');// another controler Category
    }

    public function dashboard() {
        $data['title'] = 'Home';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/dashboard_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
    }

    public function login() {
	
	$userid = $this->session->userdata('usr_id');
		$super_admin_status = $this->session->userdata('super_admin_status');
		if(($super_admin_status == '1')&&($userid != '')) {
            $this->dashboard();
        }
		else{
			$data['title'] = 'Admin Login';
            $this->load->view("admin/login_view", $data); //New Settings
		}
		
    }
	
    public function index() {
        $userid = $this->session->userdata('usr_id');
		$super_admin_status = $this->session->userdata('super_admin_status');
		
		if(( $super_admin_status == '1')&&($userid != '')) {
			
            $this->dashboard();
        }
		else{
			$data['title'] = 'Admin Login';
            $this->load->view("admin/login_view", $data); //$this->load->view("registration_view.php", $data);
		}
    }

    public function postlogin() {
        $usr = $this->input->post('usrname');
        $pwd = $this->input->post('pwd');

        $result = $this->admin_model->login($usr, $pwd);
        if ($result)
        {
            echo "1";
            //$this->dashboard();
        }
        else{
            echo "0";
            //$this->login();
        }
    }

    public function CategoryStatusUpdate() {
        $this->admin_category_model->CategoryStatusUpdate();
    }
   
	public function CategoryPopularUpdate() {
        $this->admin_category_model->CategoryPopularUpdate();
    }
   public function AdminPwdUpdate() {
        $this->admin_model->AdminPwdUpdate();
    }

    public function logout() {
        $this->session->unset_userdata('usr_id', '');
        $this->session->unset_userdata('usr_name', '');
        $this->session->unset_userdata('email_id', '');
        $this->session->unset_userdata('logged_in', 'FALSE');
        //$this->session->unset_userdata($newdata );
        $this->session->sess_destroy();
        //$this->index();
        echo "0";
    }
}

?>