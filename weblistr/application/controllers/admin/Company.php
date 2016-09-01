<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('admin/admin_model', 'admin/admin_category_model', 'admin/user_model','notificationmodel'));  //Open 
        $this->load->library(array('session', 'email'));  // Session on each controller
        $this->load->database(); // db 
        $this->load->helper(array('url', 'form', 'file')); // form action basic things
        //$this->load->library('../controllers/Category');// another controler Category
    }

    public function index() {
        $userid = $this->session->userdata('usr_id');
        $data['title'] = 'Home';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
        
        $data['getcmpUser'] = $this->user_model->getcmpUser();
        
        $this->load->view("admin/company_user_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
    }

	 public function add() {
        
        $data['title'] = 'User Add';
        $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);

        $this->load->view("admin/user_add_manage_view", $data); //$this->load->view("registration_view.php", $data);
        $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
        
    }
	
    public function UserStatusUpdate() {
        $this->user_model->UserStatusUpdate();
    }
	
	public function getAllUserOnScroll() {
        $users = $this->user_model->getAllUserOnScroll();
		if(sizeof($users)>0)
		{
			foreach ($users as $user) {
				$usr_id = $user['usr_id'];
				$usr_name = $user['usr_name'];
				$email_id = $user['email_id'];
				$register_method = $user['register_method'];
				$register_date = $user['register_date'];
				$profile_image = $user['profile_image'];
				$bio = $user['bio'];
				$mobile = $user['mobile'];
				$address = $user['address'];
				$city = $user['city'];
				$state = $user['state'];
				$country = $user['country'];
				$status = $user['status'];
				?>

				<tr>
					<td>
					 <input type='hidden' id='cat_id' value='<?php echo $usr_id ?>' />
					 
						<a href="user/profile/<?php echo $usr_id ?>" data-id="<?php echo $usr_id ?>" target='_blank' >
							<?php echo $usr_name ?>
						</a>
					</td>
					<td>
						<?php
						if ($profile_image != '') {
							?>
							<img src='<?php echo $profile_image ?>' width='75px' /></td>
						<?php
					} else {
						 ?>
							<img src='images/about-icon-md.png' width='75px' /></td>
						<?php
					}
					?>
					<td>
						<?php echo $email_id; ?>
					</td>
					<td>
						<?php echo date("d-m-Y", strtotime($register_date));
						;
						?>
					</td>
					<td>
						<?php echo $register_method; ?>
					</td>
					<td>
						<?php echo $bio; ?>
					</td>
					<td>
						<?php echo $mobile; ?>
					</td>
					<td>
						<?php
						echo $address;
						if (($state != '') && ($state != '0') && ($state != 'null')) {
							$resultstate = $this->user_model->getStateName($state);
							if (sizeof($resultstate) > 0) {
								echo ', ' . $resultstate[0]['state_name'];
							}
						}
						if (($country != '') && ($country != '0') && ($country != 'null')) {
							$resultcountry = $this->user_model->getCountryName($country);
							if (sizeof($resultcountry) > 0) {
								echo ', ' . $resultcountry[0]['country_name'];
							}
						}
						?>
					</td>
					<td class="hidden-480">														  
<span  
class="label label-sm usr_id_right cursor <?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'label-warning' : 'label-success'); ?>"
data-id="<?php echo $usr_id ?>" 
data-stts="<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>" 
onclick="useractive('<?php echo $usr_id ?>','<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')"


>
<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'In-Active' : 'Active'); ?>
</span>
<a class="label label-sm cursor label-info" data-id="<?php echo $usr_id ?>"  href="admin/user/edit/<?php echo $usr_id; ?>" >Edit</a>

				</tr>
				<?php
			}
		}
    }
	
	public function getcmpUseronscroll() {
        $users = $this->user_model->getcmpUseronscroll();
		if(sizeof($users)>0)
		{
			foreach ($users as $usr) {
				$usr_id = $usr['uid'];
				$cmp_stts = $usr['status'];
				$user = $this->user_model->getSelectedUser($usr_id);
				
				$usr_name = $user['usr_name'];
				$email_id = $user['email_id'];
				$register_method = $user['register_method'];
				$register_date = $user['register_date'];
				$profile_image = $user['profile_image'];
				$bio = $user['bio'];
				$mobile = $user['mobile'];
				$address = $user['address'];
				$city = $user['city'];
				$state = $user['state'];
				$country = $user['country'];
				$status = $user['status'];
				?>

	<tr>
		<td class="center">
 <input type='hidden' id='usr_id' value='<?php echo $usr_id ?>' >
 
	<a href="user/profile/<?php echo $usr_id ?>" data-id="<?php echo $usr_id ?>" target='_blank' >
		<?php echo $usr_name ?>
	</a>
		</td>
<?php
	if ($profile_image != '') {
		?><td>
		<img src='<?php echo $profile_image ?>' width='75px' /></td>
	<?php
} else {
	 ?>
	  <td>  <img src='images/about-icon-md.png' width='75px' /></td>
	<?php
}
?>
		<td>  <?php echo $email_id; ?></td>
<td class="hidden-480"> <?php echo date("d-m-Y", strtotime($register_date)); ?></td>
		<td>   <?php echo $this->user_model->getotherdetails($usr_id); //$register_method; ?></td>

		<td class="hidden-480">
									<?php

if($cmp_stts == 0)					
{
	?>
	<a href="javascript:void(0)" onclick="approveassign('<?php echo $usr_id ?>')" >Approve</a>
	<?php
}
else{
	?>
	Approved
	<?php
	
}	?>
		</td>

		<td>
<?php echo $mobile; ?>
		</td>
											  <td>
	<?php
	echo $address;
	if (($state != '') && ($state != '0') && ($state != 'null')) {
		$resultstate = $this->user_model->getStateName($state);
		if (sizeof($resultstate) > 0) {
			echo ', ' . $resultstate[0]['state_name'];
		}
	}
	if (($country != '') && ($country != '0') && ($country != 'null')) {
		$resultcountry = $this->user_model->getCountryName($country);
		if (sizeof($resultcountry) > 0) {
			echo ', ' . $resultcountry[0]['country_name'];
		}
	}
	?>
</td>
<td class="hidden-480">
<span  
class="label label-sm usr_id_right cursor <?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'label-warning' : 'label-success'); ?>"
data-id="<?php echo $usr_id ?>" 
data-stts="<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>"

onclick="useractive('<?php echo $usr_id ?>','<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? '1' : '0'); ?>')" >
<?php $var = $status; echo $var_is_greater_than_two = ($var == 0 ? 'In-Active' : 'Active'); ?>
</span>


<a class="label label-sm cursor label-info" data-id="<?php echo $usr_id ?>"  href="admin/user/edit/<?php echo $usr_id; ?>" >Edit</a>


</td>

</tr>
				<?php
			}
		}
    }
	
	public function PostAdd() { 
		return $this->user_model->PostAdd();
    }
	
	 public function edit($id = 0) {
        if ($id != 0) {
            $data['title'] = 'User Edit';
            $this->load->view("admin/header_view", $data); //$this->load->view("registration_view.php", $data);
            
			$data['getSelectedUser'] = $this->user_model->getSelectedUser($id);
			
			$countryID = 1; //India Static
			$data['getState'] = $this->user_model->getState($countryID);//all state from tbl_state table
			
			
            $this->load->view("admin/user_edit_manage_view", $data); //$this->load->view("registration_view.php", $data);
            $this->load->view("admin/footer_view", $data); //$this->load->view("registration_view.php", $data);
        }
    }
	function userEditUpdateForm()
	{
		$this->user_model->userEditUpdateForm();
	}
}
?>