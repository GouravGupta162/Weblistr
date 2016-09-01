<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form','file','string'));
    }

    function getAllcategoryForAdmin() { //Admin
//        $sql = "SELECT * FROM `category` ";
$sql = "SELECT * FROM `category` order by cat_id desc limit 0,8 ";
        // $this->db->select('*'); // <-- There is never any reason to write this line!
        // $this->db->from('category');
        // $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
        // $query = $this->db->get();
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllcategoryForAdminNew() { //Admin
//        $sql = "SELECT * FROM `category` ";
$sql = "SELECT * FROM `category` order by cat_id desc  ";
        // $this->db->select('*'); // <-- There is never any reason to write this line!
        // $this->db->from('category');
        // $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
        // $query = $this->db->get();
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

	function getAllcategoryForAdminOnScroll() { //Admin
		$getresult = $this->input->post('getresult');
        $sql = "SELECT * FROM `category` order by cat_id desc limit $getresult,8";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    function getSelectedcategoryForAdmin($catId) { //Admin
    $sql ="SELECT category.*, category_attribute.banner ,category_attribute.bg_color ,category_attribute.icon "
            . "FROM category,`category_attribute` where category_attribute.cat_id= $catId and category.cat_id = $catId";

        //$sql = "SELECT * FROM `category` where cat_id = $catId ";

        // $this->db->select('*'); // <-- There is never any reason to write this line!
        // $this->db->from('category');
        // $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
        // $query = $this->db->get();
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function CategoryStatusUpdate() { //Admin
        $cat_id = $this->input->post('cat_id');
        $stts = $this->input->post('stts');

        $sql = "update `category` set status = '$stts' where cat_id = '$cat_id'";

        // $this->db->select('*'); // <-- There is never any reason to write this line!
        // $this->db->from('category');
        // $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
        // $query = $this->db->get();
        $query = $this->db->query($sql);
        echo "1"; //updated
    }

	function CategoryPopularUpdate() { //Admin
        $cat_id = $this->input->post('cat_id');
        $stts = $this->input->post('stts');

        $sql = "update `category` set popular_status = '$stts' where cat_id = '$cat_id'";

        // $this->db->select('*'); // <-- There is never any reason to write this line!
        // $this->db->from('category');
        // $this->db->join('category_attribute', 'category_attribute.cat_id = category.cat_id');
        // $query = $this->db->get();
        $query = $this->db->query($sql);
        echo "1"; //updated
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

    function  category_add($admid)
    {
        $status = "0";
        $random=rand(1111,9999);
        //under process
        $cat_name = $this->input->post('cat_name');
        $catstatus = $this->check_category($cat_name);
        if($catstatus == false)
        {
            $cat_desc = $this->input->post('cat_desc');

            $bgcolor = $this->input->post('bgcolor');
            #banner file save
           // echo $cat_name; exit;
            $fname = $_FILES['file']['name']; 
            $fileTmpName=$_FILES["file"]["tmp_name"]; 
			$newFileName=$random.$fname;
			$resizefilename="images/category/full/".$newFileName;
			$this->resizesave($fileTmpName,$resizefilename,300,300);
			
			
            $targetpath="images/category/";
            $banner = $targetpath.'full/'.$newFileName;
            //move_uploaded_file($fileTmpName,$banner);

            #icon file save
            $iconfname = $_FILES['iconfile']['name']; 
            $iconfileTmpName = $_FILES["iconfile"]["tmp_name"]; 

            $iconFileName=$targetpath.'icon/'.$random.$iconfname;
            //move_uploaded_file($iconfileTmpName,$iconFileName);
			
			//resizing for icon
			$this->resizesave($iconfileTmpName,$iconFileName,65,65);
			
            $date = date('Y-m-d H:i:s');
            $sql = "insert into `category` (adm_id,cat_name,cat_image,cat_desctiption,date,status) values ('$admid','$cat_name','$banner','$cat_desc','$date','1') ";
            $query = $this->db->query($sql);

            $query = $this->db->query('SELECT LAST_INSERT_ID()');
            $row = $query->row_array();
            $cat_id = $row['LAST_INSERT_ID()'];


            $sql = "insert into `category_attribute` (cat_id,adm_id,banner,bg_color,icon,date,status)  values('$cat_id','$admid','$banner','$bgcolor','$iconFileName','$date','1')";
            $query = $this->db->query($sql);

            $status = "1";
        }
        else {
            $status = "";
        }
        echo $status ;
        
    }
            
    
    function category_update()
    {
        $random=rand(1111,9999);
        
        $cat_id = $this->input->post('cat_id');
        $cat_name = $this->input->post('cat_name');
        $cat_desc = $this->input->post('cat_desc');
        
        $bgcolor = $this->input->post('bgcolor');
        #banner file save
       // echo $cat_name; exit;
        $fname = $_FILES['file']['name']; 
        $fileTmpName=$_FILES["file"]["tmp_name"]; 
        $newFileName=$random.$fname;
        
        $targetpath="images/category/";
        $banner = $targetpath.'full/'.$newFileName;
        //move_uploaded_file($fileTmpName,$banner);
       
        #icon file save
        $iconfname = $_FILES['iconfile']['name']; 
        $iconfileTmpName = $_FILES["iconfile"]["tmp_name"]; 
     
        $iconFileName=$targetpath.'icon/'.$random.$iconfname;
       // move_uploaded_file($iconfileTmpName,$iconFileName);
        $status = "0";
        if($bgcolor != "")
        {
            $sql = "update `category_attribute` set  bg_color = '$bgcolor' where cat_id = '$cat_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if($fileTmpName)		
        {
			$resizestatus = $this->resizesave($fileTmpName,$banner,300,300);
			if($resizestatus == 1)
			{
				$date = date('Y-m-d H:i:s');
				$sql = "update `category_attribute` set banner = '$banner' where cat_id = '$cat_id'";
				$query = $this->db->query($sql);
				$sql = "update `category` set cat_image = '$banner',date = '$date' where cat_id = '$cat_id'";
				$query = $this->db->query($sql);
				$status = "1";
			}
        }
        if($iconfileTmpName)
        {
			$resizestatus = $this->resizesave($iconfileTmpName,$iconFileName,65,65);
			if($resizestatus == 1)
			{
				$date = date('Y-m-d H:i:s');
				$sql = "update `category_attribute` set icon = '$iconFileName' where cat_id = '$cat_id'";
				$query = $this->db->query($sql);
				$status = "1";
			}
        }
        
        if($cat_name != "")
        {
            $date = date('Y-m-d H:i:s');
            $sql = "update `category` set cat_name = '$cat_name' ,date = '$date' where cat_id = '$cat_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        if($cat_desc != "")
        {
            $date = date('Y-m-d H:i:s');
            $sql = "update `category` set cat_desctiption = '$cat_desc',date = '$date' where cat_id = '$cat_id'";
            $query = $this->db->query($sql);
            $status = "1";
        }
        echo $status ;
    }
	
	
	function resizesave($fileTempNmae,$filepath,$compresswidth,$compressheight)
	{
		//resizing
		$bannertempname = $fileTempNmae;//file temp name
		$size = getimagesize($bannertempname);
		$type = $size['mime'];                        
		$width = $size[0];
		$height = $size[1];
		
		$newwidth = $compresswidth;
		$newheight = $compressheight;
		$tmp = imagecreatetruecolor($newwidth, $newheight);
		
		$resizefilename=$filepath;//"images/category/full/".$newFileName; path with file name and its extenstion
		$status = "0";
		if ($size[2] == IMAGETYPE_GIF) 
		{
			$src = imagecreatefromgif($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagegif($tmp, $resizefilename, 100);
			$status = "1";
		}
		elseif ($size[2] == IMAGETYPE_JPEG)
		{
			$src = imagecreatefromjpeg($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($tmp, $resizefilename, 100);
			$status = "1";
		}
		elseif ($size[2] == IMAGETYPE_PNG)
		{
			$src = imagecreatefrompng($bannertempname);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagepng($tmp, $resizefilename, 9);
			$status = "1";
		}
		imagedestroy($src);
		imagedestroy($tmp);
		//resizing
		
		return $status;
	}
}

?>