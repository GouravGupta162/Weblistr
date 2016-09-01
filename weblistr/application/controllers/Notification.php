<?php
class Notification extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array("url","form","string"));
		$this->load->model("notificationmodel");
		$this->load->database();
	}
	
	function fetchcontent()
	{
		$limit = $this->input->post('getresult');
		
		$this->notificationmodel->fetchcontent($limit);
	}
	
	function fetchmsg()
	{
		$this->notificationmodel->fetchmsg();
	}
	function readit()
	{
		$notificationId = $this->input->post('notificationId');
		$this->notificationmodel->readnotification($notificationId);
	}
	function readallnotification()
	{
		$this->notificationmodel->readallnotification();
	}
	function countNotification()
	{
		$this->notificationmodel->countNotification();
	}
	function countAllNotification()
	{
		$this->notificationmodel->countAllNotification();
	}
	
}
?>