<?php
class Notificationmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array("url","form","string"));
		$this->load->database();
		$this->load->library(array('session'));
	}
	//insertreview - new review inserted 
	function index()
	{
		////Notification Model Loading and calling it Start
		//$notification =& get_instance(); 
		//$notification->load->model("notificationmodel");
		//$this->notificationmodel->addnotification($this->session->userdata("user_id"),'message',html content);
		////Notification Model Loading and calling it End
	}
	function addnotification($from,$type,$content)
	{
		$to = 0; //super admin
		
		//message for message notification
		//challenge for challenge notification
		//tournament for tournament notification
		
		$content = $this->db->escape_like_str($content);
		
		//$username = mysql_real_escape_string($_POST['username']);
		$sql = "insert into notifications (`from`,`to`,`notification_type`,`read_status`,`datetime`,`content`) values ('$from','$to','$type','0','NOW()','$content') ";
		
		$this->db->query($sql);
	}
	function readnotification($notificationId)
	{
		$sql = "update notifications set read_status = '1' where id = '$notificationId' ";
		$this->db->query($sql);
	}
	
	function readallnotification()
	{
		$sql = "update notifications set read_status = '1' ";
		$this->db->query($sql);
		echo "done";
	}
	
	
	
	function countAllNotification()
	{
		$sql = "select count(read_status) as notificationCount from notifications where `to` = '0' and read_status = '0' ";
		$this->db->query($sql);
		$this->db->close();
		$this->db->reconnect();
		$notification = $this->db->query($sql);
		//var_dump($notification->result_array());
		$notifications = $notification->row_array();	
		echo $notifications['notificationCount'];
	}
	
	function fetchcontent($getresult)
	{
		$sql = "select * from `notifications` where read_status = '0' order by id desc limit $getresult,7 ";
	
		$notification = $this->db->query($sql);
		//var_dump($notification->result_array());
		$notifications = $notification->result_array();				
		if(sizeof($notifications)>0)
		{
			foreach($notifications as $notification)
			{
				?>
				<span onclick="readnotification('<?php echo $notification['id']; ?>');" >
				<?php echo $notification['content'];?> 
				</span>
				<?php
			}
		}
		else
		{ echo "0";
			
		}
	
	}
	
	
	function writeReviewNotification($prd_id,$rev_id,$user,$webTitle) //Write a Review Page
	{
		//Notification Model Loading and calling it Start
		$notification =& get_instance(); 
		$notification->load->model("notificationmodel");
		
		$query = "Select * from product where prd_id = $prd_id";
		$row = $this->db->query($query)->row_array();
		$prdname = $row['prd_name'];
		
		$userdetails = $this->user_model->getUserDetailinRow($user);
		$uname = $userdetails['usr_name'];
		$pimag ='';
		if($userdetails['register_method'] == 'facebook')
		{
			$pimag = "http://graph.facebook.com/".$userdetails['social_id']."/picture?type=large";
		}
		else{
			
			if($userdetails['profile_image'] != '')
			{
				$pimag = $userdetails['profile_image'];
			}
			else{
				$pimag = "images/about-icon-md.png";
			}
		}
  
		$htmlbody = "<li>
				<a href='review/revdetail/".$prd_id."/".$rev_id."' target='_blank' >
				   <div class='clearfix'>
				     <span>
				       <img src='$pimag' alt='$uname' ><b>$uname</b>
				         wrote a new review for $prdname on $webTitle 
				       </span>
				   </div>
			        </a>
			     </li>";
			
		$this->notificationmodel->addnotification($user,'insertreview',$htmlbody);
		//Notification Model Loading and calling it End
	}
	
	function CompanyListingNotification($prd_id,$user) //Write a Review Page
	{
		//Notification Model Loading and calling it Start
		$notification =& get_instance(); 
		$notification->load->model("notificationmodel");
		
		$query = "Select * from product where prd_id = $prd_id";
		$row = $this->db->query($query)->row_array();
		$prdname = $row['prd_name'];
		
		$userdetails = $this->user_model->getUserDetailinRow($user);
		$uname = $userdetails['usr_name'];
		$pimag ='';
		if($userdetails['register_method'] == 'facebook')
		{
			$pimag = "http://graph.facebook.com/".$userdetails['social_id']."/picture?type=large";
		}
		else{
			
			if($userdetails['profile_image'] != '')
			{
				$pimag = $userdetails['profile_image'];
			}
			else{
				$pimag = "images/about-icon-md.png";
			}
		}
  
		$htmlbody  = 	"<li>
							<a href='review/detail/".$prd_id."' target='_blank' >
								<div class='clearfix'>
									<span>
										<img src='$pimag' alt='$uname' ><b>$uname</b>
										 listed a new company $prdname
									</span>
								</div>
							</a>
						</li>";
			
		$this->notificationmodel->addnotification($user,'insertcompany',$htmlbody);
		//Notification Model Loading and calling it End
	}
}
?>