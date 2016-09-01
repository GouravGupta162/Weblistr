<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin/admin_model', 'admin/admin_category_model', 'admin/user_model','admin/product_model','notificationmodel','contact_model','write_review_model'));  //Open 
        $this->load->library(array('session', 'email'));  // Session on each controller
        $this->load->database(); // db 
        $this->load->helper(array('url', 'form', 'file')); // form action basic things
        //$this->load->library('../controllers/Category');// another controler Category
    }

    public function index() {
		
		$userid = $this->session->userdata('usr_id');
		$super_admin_status = $this->session->userdata('super_admin_status');
		
		if(($super_admin_status == '1')&&($userid != '')) {
			$this->weblistindex();
        }
		else{
			$data['title'] = 'Admin Login';
            $this->load->view("admin/login_view", $data); //New Settings
		}
    }
	
    public function weblistindex() { //controller function
        $data['title'] = 'Category';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
        $data['getAllProduct'] = $this->product_model->getAllProduct();
        $this->load->view("admin/dashboard_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
    }

}

?>