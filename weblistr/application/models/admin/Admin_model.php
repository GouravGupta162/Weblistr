<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function login($usr, $pwd) {
		
		
		// $this->session->unset_userdata('usr_id','');
		// $this->session->unset_userdata('usr_name','');
		// $this->session->unset_userdata('email_id','');
		// $this->session->unset_userdata('logged_in','FALSE');
				  
		// //$this->session->unset_userdata($newdata );
		// $this->session->sess_destroy();
		
		$this->session->unset_userdata('usr_id','');
		$this->session->unset_userdata('usr_name','');
		$this->session->unset_userdata('email_id','');
		$this->session->unset_userdata('admin_status','');
		$this->session->unset_userdata('super_admin_status','');
		$this->session->unset_userdata('logged_in','FALSE');
		$this->session->unset_userdata('fb_profile','');
		$this->session->unset_userdata('register_method','');
		//$this->session->sess_destroy();
		
		
        $this->db->where("email_id", $usr);
        $this->db->where("usr_password", md5($pwd . '2@41bl13c9'));
        $this->db->where("admin_status", '1');
        $this->db->where("super_admin_status", '1');
        $query = $this->db->get("user_register");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                // $this->session->set_userdata('usr_id', $rows->usr_id);
                // $this->session->set_userdata('usr_name', $rows->usr_name);
                // $this->session->set_userdata('email_id', $rows->email_id);
                
                // $this->session->set_userdata('admin_status', '1'); //0 - user, 1- admin, 2-super admin
				
				// $this->session->set_userdata('super_admin_status','1');
				// //
				// $this->session->set_userdata('logged_in', 'TRUE');
				
				$this->session->set_userdata('usr_id',$rows->usr_id);
				$this->session->set_userdata('usr_name',$rows->usr_name);
				$this->session->set_userdata('email_id',$rows->email_id);
				$this->session->set_userdata('admin_status','1');
				$this->session->set_userdata('super_admin_status','1');
				$this->session->set_userdata('logged_in','TRUE');
				$this->session->set_userdata('fb_profile',$rows->social_id);
				$this->session->set_userdata('register_method',$rows->register_method);
				
            }
            return true;
        }
        return false;
    }
	function AdminPwdUpdate()
	{
		$oldpwd = $this->input->post('oldpwd');
        $newpwd = $this->input->post('newpwd');
		$conpwd = $this->input->post('conpwd');
		$usr_id = $this->input->post('usr_id');
		
		$newpwd = md5($newpwd.'2@41bl13c9');
		
        $sql = "update `user_register` set usr_password = '$newpwd' where usr_id = '$usr_id'";
        $query = $this->db->query($sql);
        echo 'done';
	}
}

?>