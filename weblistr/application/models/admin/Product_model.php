<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form', 'file', 'string'));
    }

    function getAllProduct() { //Admin
        $sql = "SELECT * FROM `product` order by prd_id desc limit 10 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
	function getAllCompanyUsers() { //Admin
        $sql = "SELECT * FROM `user_register` where admin_status = 1 and status = 1";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
	
	function getAllProductOnScroll() { //Admin Scroll
		
		$getresult = $this->input->post('getresult');
        $sql = "SELECT * FROM `product` order by prd_id desc limit $getresult,10";

        $query = $this->db->query($sql);
		return $query->result_array();
       
    }
	
    function getAllcat()
	{
		$sql = "SELECT * FROM `category`";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
        {
			return $query->result_array();
		}
	}
    function getAllProductStatus() { //Admin
        $sql = "SELECT * FROM `product`";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function check_category($catname) {
        $where = "cat_name='$catname'";
        $this->db->where($where); //$this->db->where("email_id",$email);
        $query = $this->db->get("category");
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
	
	
	function loadAssignedContent()
	{
		
		$sql = "SELECT product.prd_id, product.prd_name,category.cat_name,user_register.usr_name FROM `product` inner join category on category.cat_id = product.cat_id inner join user_register on user_register.usr_id = product.added_by order by product.prd_id desc";
		$query = $this->db->query($sql);
		
		$assinedarray = $query->result_array();
		
		if(sizeof($assinedarray)>0)
		{
			foreach($assinedarray as $data)
			{
			?>
				<tr>
					<td>
					<?php echo $data['cat_name']; ?>
					</td>
					<td>
						<?php echo $data['prd_name']; ?>
					</td>
					<td>
						<?php echo $data['usr_name']; ?>
					</td>
				</tr>
				<?php				
			}
		}
		else{
			?>
			<tr>
			<td colspan='3'>
			No Data
			</td>
			</tr>
			<?php
		}
		
		
	}
	
	function getAllReviews() //page load
	{
		$sql = "SELECT user_register.usr_name,category.cat_name,product.prd_name, ";
		$sql  .="reviews.* FROM `reviews` ";
		$sql .="inner join user_register on reviews.usr_id = user_register.usr_id ";
		$sql .="inner join category on reviews.cat_id = category.cat_id ";
		$sql .="inner join product on reviews.prd_id = product.prd_id  and reviews.review_head <> '' order by rev_id desc   limit 10";
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	function getAllReviewsOnScroll() //on scroll
	{
		$getresult = $this->input->post('getresult');
		$sql = "SELECT user_register.usr_name,category.cat_name,product.prd_name, ";
		$sql  .="reviews.* FROM `reviews` ";
		$sql .="inner join user_register on reviews.usr_id = user_register.usr_id ";
		$sql .="inner join category on reviews.cat_id = category.cat_id ";
		$sql .="inner join product on reviews.prd_id = product.prd_id  and reviews.review_head <> ''  order by rev_id desc   limit $getresult,10";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	function GetReviewDetail()
	{
		$revid = $this->input->post('revid');
		$star = 0;
		
		
		$sql = "SELECT * from reviews where rev_id = $revid";
		$query = $this->db->query($sql);
		$review = $query->row_array();
		?>
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modalreadclose()" ><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title reviewTitle" id="myModalLabel"><?php echo $review['review_head']; 
		
		$sql = "SELECT rating_stars from review_details where rev_id = $revid";
		$query = $this->db->query($sql);
		$contact_model =& get_instance(); 
		$contact_model->load->model("contact_model");

		if ($query->num_rows() > 0) {
			$star = $query->row_array()['rating_stars'];
			
			$arrayvalue = $star;
			
			if(strpos($arrayvalue, '.') !== FALSE)
			{
				$splited =  explode(".",$arrayvalue);
				$splitersize = sizeof($splited);
				if($splitersize > 1)
				{
					$mainstar = $splited[0];
					$dotstar = $splited[1];
					$contact_model->contact_model->ratingNewWrite($mainstar,$dotstar);
				}
			}
			else{
				$contact_model->contact_model->ratingNewWrite($arrayvalue,'0');
			}
			
			// for($i = 1;$i<=$star;$i++)
			// {
				// ?>
				<!--	 <i class="fa fa-star"></i>-->
				 <?php
			// }
			
		}
		$contact_model->contact_model->ratingNewWrite('0','0');
		?>
		</h4>
		</div>

		<div class="modal-body">
		<div class="reviewBody">
		<?php echo $review['review_body']; 
		
		$sql = "SELECT * from review_images where rev_id = $revid";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			?>
			<div class="rev_img_btm">
			<?php
			foreach($query->result_array() as $img)
			{
			?>
			<!--<a class="fancybox" href="<?php// echo $img['rev_image'] ?>" data-fancybox-group="gallery<?php// echo $img['rev_id']; ?>" >
				<img src="<?php// echo $img['thumbnail'] ?>" />
				</a>-->
				<a href="<?php echo $img['rev_image'] ?>" target="_blank" > <img src='<?php echo $img['rev_image'] ?>' width='75px' /></a>
			<?php
			}
			?>
			</div>
			<?php
		}
		?>
		</div>
		</div>
		<?php
		
	}
	
    function category_add($admid) {
        $status = "0";
        $random = rand(1111, 9999);
        //under process
        $cat_name = $this->input->post('cat_name');
        $catstatus = $this->check_category($cat_name);
        if ($catstatus == false) {
            $cat_desc = $this->input->post('cat_desc');

            $bgcolor = $this->input->post('bgcolor');
            #banner file save
            // echo $cat_name; exit;
            $fname = $_FILES['file']['name'];
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $newFileName = $random . $fname;

            $targetpath = "images/category/";
            $banner = $targetpath . 'full/' . $newFileName;
            move_uploaded_file($fileTmpName, $banner);

            #icon file save
            $iconfname = $_FILES['iconfile']['name'];
            $iconfileTmpName = $_FILES["iconfile"]["tmp_name"];

            $iconFileName = $targetpath . 'icon/' . $random . $iconfname;
            move_uploaded_file($iconfileTmpName, $iconFileName);


            $date = date('Y-m-d H:i:s');
            $sql = "insert into `category` (adm_id,cat_name,cat_image,cat_desctiption,date,status) values ('$admid','$cat_name','$banner','$cat_desc','$date','1') ";
            $query = $this->db->query($sql);

            $query = $this->db->query('SELECT LAST_INSERT_ID()');
            $row = $query->row_array();
            $cat_id = $row['LAST_INSERT_ID()'];


            $sql = "insert into `category_attribute` (cat_id,adm_id,banner,bg_color,icon,date,status)  values('$cat_id','$admid','$banner','$bgcolor','$iconFileName','$date','1')";
            $query = $this->db->query($sql);

            $status = "1";
        } else {
            $status = "";
        }
        echo $status;
    }

    function productupdate() {
        $random = rand(1111, 9999);
        $prd_id = $this->input->post('prd_id'); //product id
        $cat_id = $this->input->post('cat_id'); //Current product category
        $prd_name = $this->input->post('prd_name');
        $hidden_tag = $this->input->post('hidden_tag'); //New tags values if any

        $prd_link = $this->input->post('prd_link');
        $prd_tel = $this->input->post('prd_tel');
        $prd_address = $this->input->post('prd_address');
        $prd_desc = $this->input->post('prd_desc');
        $dropdown_cat_id = $this->input->post('category');

        $fname = $_FILES['file']['name'];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $newFileName = $random . $fname;
        $targetpath = "images/product/";
        $logo = $targetpath . $newFileName;
        $status = "0";
        if (move_uploaded_file($fileTmpName, $logo)) {
            //$date = date('Y-m-d H:i:s');
            $sql = "update `product` set prd_image = '$logo' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        } else {
            $status = "0";
        }
        if ($dropdown_cat_id != $cat_id) {
            $sql = "update `product` set cat_id = '$dropdown_cat_id' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if ($prd_name != "") {
            $sql = "update `product` set prd_name = '$prd_name' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if ($prd_link != "") {
            $sql = "update `product` set prd_link = '$prd_link' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if ($prd_tel != "") {
            $sql = "update `product` set prd_number = '$prd_tel' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if ($prd_address != "") {
            $sql = "update `product` set prd_address = '$prd_address' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if ($prd_desc != "") {
            $string = $this->db->escape_like_str($prd_desc);
            $sql = "update `product` set prd_info = '$string' where prd_id = '$prd_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
		
		
		///
		$windowApp=$this->input->post('windowApp');
		$iosApp=$this->input->post('iosApp');
		$androidApp=$this->input->post('androidApp');
		$deallink=$this->input->post('deallink');
		$servicesOffered=$this->input->post('servicesOffered');
		$customer_support_id=$this->input->post('custId');//customer_support_id
		
		$payoption ='';
		if(isset($_POST['payoption'])){
			$payoption=implode(',',$_POST['payoption']);
		}
		
		//$payoption=$this->input->post('payoption');
		
		$locations=$this->input->post('locations');
		$deliveryTime=$this->input->post('deliveryTime');
		///
				
		$this->db->where("prd_id",$prd_id);
		if($payoption != ''){
			$data=array(
					'windows_app_url'=>$windowApp,
					'ios_app_url'=>$iosApp,
					'android_app_url'=>$androidApp,
					'deal_link'=>$deallink,
					'services_offered'=>$servicesOffered,
					'customer_support_id'=>$customer_support_id,
					'payment_option'=>$payoption,
					'locations'=>$locations,
					'delivery_time'=>$deliveryTime
				);
		}else{
			$data=array(
				'windows_app_url'=>$windowApp,
				'ios_app_url'=>$iosApp,
				'android_app_url'=>$androidApp,
				'deal_link'=>$deallink,
				'services_offered'=>$servicesOffered,
				'customer_support_id'=>$customer_support_id,
				'locations'=>$locations,
				'delivery_time'=>$deliveryTime
			);
		}
		$this->db->update('product', $data);
			

        if ($hidden_tag != "") {
            $this->tag_process($hidden_tag, $prd_id);
        }
        echo $status;
    }

    #Tag Work Start
    //Work on X
    public function tag_remove() {
        $prd_tag_id = $this->input->post('prd_tag_id'); //product id
        $sql = "delete product_tags from product_tags where prd_tag_id = '$prd_tag_id'";
        $query = $this->db->query($sql);
        echo "1";
    }

    //Tag Remove End


    public function tag_process($hidden_tags, $prd_id) {
        $arrayData = explode(",", $hidden_tags);
        foreach ($arrayData as $row => $tagname) {
            $checker = $this->check_tag($tagname); //tag id
            if ($checker == 0) {
                $checker = $this->insert_tags($tagname);
                $this->insert_product_tags($prd_id, $checker);
            } else {
                $this->insert_product_tags($prd_id, $checker);
            }
        }
    }

    public function check_tag($tag_name) {
        $where = "tag_name='$tag_name'";
        $this->db->where($where);
        $query = $this->db->get("tags");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                return $rows->tag_id;
            }
        }
        return "0";
    }

    public function insert_tags($tag_name) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'tag_name' => $tag_name,
            'date' => $date,
            'status' => '0'
        );
        $this->db->insert('tags', $data);

        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }

    public function insert_product_tags($prd_id, $tag_id) {
        $data = array(
            'prd_id' => $prd_id,
            'tag_id' => $tag_id,
            'status' => '0'
        );
        $this->db->insert('product_tags', $data);
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }

    #Tag Work End

    public function ProductStatusUpdate() {
        $prd_id = $this->input->post('prd_id');
        $stts = $this->input->post('stts');
        $sql = "update `product` set status = '$stts' where prd_id = '$prd_id'";
        $query = $this->db->query($sql);
		
		
		$sql = "select * from `product` where prd_id = '$prd_id'";
        $query = $this->db->query($sql);
		$row = $query->row_array();
		$prdname = $row['prd_name'];
		$cat_id = $row['cat_id'];
		
		
		$sql = "select * from `category` where cat_id = '$cat_id'";
        $query = $this->db->query($sql);
		$row = $query->row_array();
		$cat_name = $row['cat_name'];
		
		
		if($row['usr_type'] != "admin")
		{
			
			$sql = " select * from `prd_usr_ids` where prd_id = '$prd_id' ";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0)
			{
				$row = $query->row_array();
				$usrid = $row['usr_id'];
			}
			else{
				$sql = "select * from `applications` where company_name = '". $prdname."'";
				$query = $this->db->query($sql);
				$row = $query->row_array();
				$usrid = $row['uid'];
			}
			
			
			if($stts == 1)
			{
				///Email code 
				$toemailusrid = $usrid;
				$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
				$row = $query->row_array();
				$email_id = $row['email_id']; //review table auto gen id
				$usr_name = $row['usr_name']; //review table auto gen id
				if($email_id != '')
				{
					$query = $this->db->query('SELECT * FROM adminemail ');
					$adminEmail = $query->row_array();
					$fromname = $adminEmail['name'];
					$fromEmail = $adminEmail['email'];
					
					$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
					$this->email->to($email_id);
					$this->email->subject('Listing Approved');
					
					//Email Template Model
						$logolink = base_url()."images/logo.png";
						$emailmodel =& get_instance(); 
						$emailmodel->load->model("emailmodel");
						$mailbody = $this->emailmodel->weblistApprove($logolink,$usr_name,$prdname,$cat_name);
					//Email Template Model
						
					//$mailbody = $this->mailtemplate('Your review has beed approved!');
					$this->email->set_mailtype("html");
					$this->email->message($mailbody);
					$this->email->send();
				
				}
				///Email code 
			}
			else{
				///Email code 
				$toemailusrid = $usrid;
				$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
				$row = $query->row_array();
				$email_id = $row['email_id']; //review table auto gen id
				$usr_name = $row['usr_name']; //review table auto gen id
				if($email_id != '')
				{
					$query = $this->db->query('SELECT * FROM adminemail ');
					$adminEmail = $query->row_array();
					$fromname = $adminEmail['name'];
					$fromEmail = $adminEmail['email'];
					
					$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
					$this->email->to($email_id);
					$this->email->subject('Listing Disapproved');
					
					//Email Template Model
						$logolink = base_url()."images/logo.png";
						$emailmodel =& get_instance(); 
						$emailmodel->load->model("emailmodel");
						$mailbody = $this->emailmodel->weblistDisapproved($logolink,$usr_name,$prdname);
					//Email Template Model
						
					//$mailbody = $this->mailtemplate('Your review has beed approved!');
					$this->email->set_mailtype("html");
					$this->email->message($mailbody);
					$this->email->send();
				
				}
				///Email code 
			}
		}
		
        echo "1"; //updated
    }
	
	// public function ReviewStatusUpdate() {
        // $rev_id = $this->input->post('rev_id');
        // $stts = $this->input->post('stts');
        // $sql = "update `reviews` set status = '$stts' where rev_id = '$rev_id'";
        // $query = $this->db->query($sql);
		// echo "1"; //updated
    // }
	
	public function ReviewStatusUpdate() {
        $rev_id = $this->input->post('rev_id');
        $stts = $this->input->post('stts');
        $sql = "update `reviews` set status = '$stts' where rev_id = '$rev_id'";
        $query = $this->db->query($sql);
		
		///Email code 
		
		$query = $this->db->query("SELECT * from reviews where rev_id = $rev_id ");
		$usr_id = $query->row_array()['usr_id'];
		$prd_id = $query->row_array()['prd_id'];
		
		$query = $this->db->query("SELECT * from product where prd_id = $prd_id ");
		$usr_type = $query->row_array()['usr_type'];
		$added_by = $query->row_array()['added_by'];
		
		$prdname = $query->row_array()['prd_name'];
		
		
		
		
		$toemailusrid = $usr_id;
		$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
		$row = $query->row_array();
		$email_id = $row['email_id']; //review table auto gen id
		$usr_name = $row['usr_name']; //review table auto gen id
			
		if($stts == 1)
		{
			if($email_id != '')
			{
					
				$query = $this->db->query('SELECT * FROM adminemail ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
			
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($email_id);
				$this->email->subject('Review Approved');
				//Email Template Model
					$logolink = base_url()."images/logo.png";
					$emailmodel =& get_instance(); 
					$emailmodel->load->model("emailmodel");
					$mailbody = $this->emailmodel->ReviewApproved($logolink,$usr_name,$prdname,$prd_id,$rev_id);
				//Email Template Model
					
				//$mailbody = $this->mailtemplate('Your review has beed approved!');
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			}
			
			if(($usr_type != 'admin')&&($added_by != ''))
			{
				$query = $this->db->query("SELECT * from user_register where usr_id = $added_by ");
				$row = $query->row_array();
				$email_id = $row['email_id'];
				
				$prdowner = $email_id;
						
				$query = $this->db->query('SELECT * FROM adminemail ');
				$adminEmail = $query->row_array();
				$fromname = $adminEmail['name'];
				$fromEmail = $adminEmail['email'];
		
				$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
				$this->email->to($prdowner);
				$this->email->subject('Review Approved');
				//Email Template Model
				
				$logolink = base_url()."images/logo.png";
				$emailmodel =& get_instance(); 
				$emailmodel->load->model("emailmodel");
				$ReviewDetailLink ="http://www.weblistr.com/Review/revdetail/".$prd_id."/".$rev_id;
				$mailbody = $this->emailmodel->ReviewApprovedForCompany($logolink,$usr_name,$ReviewDetailLink);
				//Email Template Model
					
				//$mailbody = $this->mailtemplate('Your review has beed approved!');
				$this->email->set_mailtype("html");
				$this->email->message($mailbody);
				$this->email->send();
			
			}
		}
			
		///Email code 
		
        echo "1"; //updated
    }
	
	public function ReviewReject() {
        $rev_id = $this->input->post('rev_id');
        $sql = "update `reviews` set status = '2' where rev_id = '$rev_id'";
        $query = $this->db->query($sql);
		
		
		///Email code 
		
		$query = $this->db->query("SELECT * from reviews where rev_id = $rev_id ");
		$usr_id = $query->row_array()['usr_id'];
		$prd_id = $query->row_array()['prd_id'];
		
		$query = $this->db->query("SELECT * from product where prd_id = $prd_id ");
		$usr_type = $query->row_array()['usr_type'];
		$added_by = $query->row_array()['added_by'];
		if($usr_type != 'admin')
		{
			$prdowner = $added_by;
		}
		
		$toemailusrid = $usr_id;
		$query = $this->db->query("SELECT * from user_register where usr_id = $toemailusrid ");
		$row = $query->row_array();
		$email_id = $row['email_id']; //review table auto gen id
		$usr_name = $row['usr_name']; //review table auto gen id
		if($email_id != '')
		{
			$query = $this->db->query('SELECT * FROM adminemail ');
			$adminEmail = $query->row_array();
			$fromname = $adminEmail['name'];
			$fromEmail = $adminEmail['email'];
			
			$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
			$this->email->to($email_id,$prdowner);
			$this->email->subject('Review Rejected');
			
			//Email Template Model
				$logolink = base_url()."images/logo.png";
				$emailmodel =& get_instance(); 
				$emailmodel->load->model("emailmodel");
				$mailbody = $this->emailmodel->ReviewDisapproved($logolink,$usr_name);
			//Email Template Model
			
			//$mailbody = $this->mailtemplate('Your review has beed rejected!');
			$this->email->set_mailtype("html");
			$this->email->message($mailbody);
			$this->email->send();		
		}
		///Email code 
		
		
        echo "1"; //updated
    }
	
	public function FeatureStatusUpdate() {
        $prd_id = $this->input->post('prd_id');
        $stts = $this->input->post('stts');
        $sql = "update `product` set featured_status = '$stts' where prd_id = '$prd_id'";
        $query = $this->db->query($sql);
        echo "1"; //updated
    }

    function getSelectedProduct($prdId) { //Admin
        $sql = "SELECT * FROM `product`  where prd_id = $prdId";

		//$sql = "SELECT product.*,category.cat_name FROM `product` inner join category on product.cat_id = category.cat_id where product.prd_id = $prdId";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getProductTag($prdId) { //Admin
        $sql = "SELECT * FROM `product_tags` inner join tags on product_tags.tag_id = tags.tag_id where product_tags.prd_id = $prdId";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getProductAddedbyName($usr_type, $added_by) {
        switch ($usr_type) {
            case "user":
                $sql = "SELECT * FROM `user_register` where usr_id = $added_by";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                break;
            case "admin":
                $sql = "SELECT * FROM `user_register` where usr_id = $added_by ";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    return $query->result_array();
                }
                break;
        }
    }

    public function addwebList($user) {
        $name = $this->input->post('prd_name');
        $link = $this->input->post('prd_link');
        $cat_id = $this->input->post('cat_hidden');
        $address = $this->input->post('prd_address');
        $num = $this->input->post('prd_tel');
        $info = $this->input->post('prd_desc');
        
        $fname = $_FILES['file']['name'];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        
        $hidden_tag = $this->input->post('hidden_tag');
        
        $random = rand(1111, 9999);
        $newFileName = $random.$fname;

        $filepath = "images/product/" . $newFileName; //images/product/flipkart_logo.jpg
        $checked = $this->check_prd($name, $num, $link);
		
		
		///
		$windowApp=$this->input->post('windowApp');
		$iosApp=$this->input->post('iosApp');
		$androidApp=$this->input->post('androidApp');
		$deallink=$this->input->post('deallink');
		$servicesOffered=$this->input->post('servicesOffered');
		$customer_support_id=$this->input->post('custId');//customer_support_id
		
		if(isset($_POST['payoption'])){
			$payoption=implode(',',$_POST['payoption']);
		}
		
		//$payoption=$this->input->post('payoption');
		
		$locations=$this->input->post('locations');
		$deliveryTime=$this->input->post('deliveryTime');
		///
		
        if ($checked == false) {
            if (move_uploaded_file($fileTmpName, $filepath)) {
                $data = array(
                    'cat_id' => $cat_id,
                    'added_by' => $user,
                    'usr_type' => 'admin',
                    'prd_name' => $name,
                    'prd_link' => $link,
                    'prd_info' => $info,
                    'prd_address' => $address,
                    'prd_number' => $num,
                    'prd_image' => $filepath,
					
					'windows_app_url'=>$windowApp,
					'ios_app_url'=>$iosApp,
					'android_app_url'=>$androidApp,
					'deal_link'=>$deallink,
					'services_offered'=>$servicesOffered,
					'customer_support_id'=>$customer_support_id,
					'payment_option'=>$payoption,
					'locations'=>$locations,
					'delivery_time'=>$deliveryTime,
					
                    'status' => '0'
                );
                $this->db->insert('product', $data);
                $query = $this->db->query('SELECT LAST_INSERT_ID()');
                $row = $query->row_array();
                $prd_id = $row['LAST_INSERT_ID()'];

                $this->tag_process($hidden_tag, $prd_id);
                echo "1";
            } else {
                echo "2";
            }
        } else {
            echo "3";
        }
    }
    
    
    public function check_prd($name, $number, $link) {
        $where = "prd_name='$name' OR prd_number='$number' OR prd_link='$link'";
        $this->db->where($where); //$this->db->where("email_id",$email);
        $query = $this->db->get("product");
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

	
	
	function mailtemplate($message)
	{
		$html =" <style type='text/css'>
			img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
			a img { border: none; }
			table { border-collapse: collapse !important;}
			#outlook a { padding:0; }
			.ReadMsgBody { width: 100%; }
			.ExternalClass { width: 100%; }
			.backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
			table td { border-collapse: collapse; }
			.ExternalClass * { line-height: 115%; }
			.container-for-gmail-android { min-width: 600px; }

			* {
				font-family: Helvetica, Arial, sans-serif;
			}

			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100% !important;
				margin: 0 !important;
				height: 100%;
				color: #676767;
			}

			td {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 14px;
				color: #777777;
				text-align: center;
				line-height: 21px;
			}

			a {
				color: #676767;
				text-decoration: none !important;
			}

			.pull-left {
				text-align: left;
			}

			.pull-right {
				text-align: right;
			}

			.header-lg,
			.header-md,
			.header-sm {
				font-size: 32px;
				font-weight: 700;
				line-height: normal;
				padding: 35px 0 0;
				color: #4d4d4d;
			}

			.header-md {
				font-size: 24px;
			}

			.header-sm {
				padding: 5px 0;
				font-size: 18px;
				line-height: 1.3;
			}

			.content-padding {
				padding: 20px 0 30px;
			}

			.mobile-header-padding-right {
				width: 290px;
				text-align: right;
				padding-left: 10px;
			}

			.mobile-header-padding-left {
				width: 290px;
				text-align: left;
				padding-left: 10px;
			}

			.free-text {
				width: 100% !important;
				padding: 10px 60px 0px;
			}

			.block-rounded {
				border-radius: 5px;
				border: 1px solid #e5e5e5;
				vertical-align: top;
			}

			.button {
				padding: 30px 0;
			}

			.info-block {
				padding: 0 20px;
				width: 260px;
			}

			.block-rounded {
				width: 260px;
			}

			.info-img {
				width: 258px;
				border-radius: 5px 5px 0 0;
			}

			.force-width-gmail {
				min-width:600px;
				height: 0px !important;
				line-height: 1px !important;
				font-size: 1px !important;
			}

			.button-width {
				width: 228px;
			}

		</style>

		<style type='text/css' media='screen'>
			@import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
		</style>

		<style type='text/css' media='screen'>
			@media screen {
				* {
					font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
				}
			}
		</style>

		<style type='text/css' media='only screen and (max-width: 480px)'>
			@media only screen and (max-width: 480px) {
				table[class*='container-for-gmail-android'] {
					min-width: 290px !important;
					width: 100% !important;
				}

				table[class='w320'] {
					width: 320px !important;
				}

				img[class='force-width-gmail'] {
					display: none !important;
					width: 0 !important;
					height: 0 !important;
				}

				a[class='button-width'],
				a[class='button-mobile'] {
					width: 248px !important;
				}

				td[class*='mobile-header-padding-left'] {
					width: 160px !important;
					padding-left: 0 !important;
				}

				td[class*='mobile-header-padding-right'] {
					width: 160px !important;
					padding-right: 0 !important;
				}

				td[class='header-lg'] {
					font-size: 24px !important;
					padding-bottom: 5px !important;
				}

				td[class='header-md'] {
					font-size: 18px !important;
					padding-bottom: 5px !important;
				}

				td[class='content-padding'] {
					padding: 5px 0 30px !important;
				}

				td[class='button'] {
					padding: 5px !important;
				}

				td[class*='free-text'] {
					padding: 10px 18px 30px !important;
				}

				td[class='info-block'] {
					display: block !important;
					width: 280px !important;
					padding-bottom: 40px !important;
				}

				td[class='info-img'],
				img[class='info-img'] {
					width: 278px !important;
				}
			}
		</style>
		<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%' style='background-color:#f7f7f7' >
			<tr>
				<td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
					<center>
						<img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
							<table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
								<tr>
									<td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
									 
										<center>
											<table cellpadding='0' cellspacing='0' width='600' class='w320'>
												<tr>
													<td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
														<a href=''><img width='137' height='47' src='http://demo.dupleit.com/weblister_v2/images/logo.png' alt='logo'></a>
													</td>
													<td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
														<a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
														<a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
														<a href=''><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
													</td>
												</tr>
											</table>
										</center>
									 
									</td>
								</tr>
							</table>
					</center>
				</td>
			</tr>
			<tr>
				<td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
					<center>
						<table cellspacing='0' cellpadding='0' width='600' class='w320'>
							<tr>
								<td class='header-lg'>
									The Weblisters!
								</td>
							</tr>
							<tr>
								<td style='height:100px;'></td>
							</tr>
							<tr>
								<td >
									<table>
									<tr>
									<td>'$message'</td></tr>
									</table>
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
			
			<tr>
				<td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
					<center>
						<table cellspacing='0' cellpadding='0' width='600' class='w320'>
							<tr>
								<td style='padding: 25px 0 25px'>
									<strong>The Weblisters</strong><br />
									Kolkata <br />
									India <br /><br />
								</td>
							</tr>
						</table>
					</center>
				</td>
			</tr>
		</table>";
		return $html;
	}
}

?>