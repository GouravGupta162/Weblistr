<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class contact_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form'));
    }
	function PostContact()
	{
		
		$name =  $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');
			
		/************** email to user on signup  **************************************/  
		$query = $this->db->query('SELECT * FROM adminemail ');
		$adminEmail = $query->row_array();
		$fromname = $adminEmail['name'];
		$fromEmail = $adminEmail['email'];
		
		$this->email->from($fromEmail, ucwords($fromname));//ucwords($this->input->post('uname')));
		$this->email->to($email,$fromEmail);
		$this->email->subject('Contact Us');
		
		$mailbody = $this->contactemailhtml($name,$email,$phone,$message,base_url());
		$this->email->set_mailtype("html");
		
		$this->email->message($mailbody);
		
		//$this->email->message($message.'<br/>'.$phone.'<br/>'.$email.'<br/>'.$name);
		
		$this->email->send();
		//email End
		echo '0';
	}	

	/*function fetchup()
	{
		//$this->db->where("id",$user_id);
		//$data = array(
			//'image' => $userfile['file_name']
		//);
		//$this->db->update('user',$data);
		//return true;
		return "fetchu up ";
	}*/
/////email template
	function contactemailhtml($name,$email,$phone,$message,$baselink)
	{
		return '<style type="text/css">
            /* Take care of image borders and formatting, client hacks */
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


            /* General styling */
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

        <style type="text/css" media="screen">
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type="text/css" media="screen">
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: "Oxygen", "Helvetica Neue", "Arial", "sans-serif" !important;
                }
            }
        </style>

        <style type="text/css" media="only screen and (max-width: 480px)">
            /* Mobile styles */
            @media only screen and (max-width: 480px) {

                table[class*="container-for-gmail-android"] {
                    min-width: 290px !important;
                    width: 100% !important;
                }

                table[class="w320"] {
                    width: 320px !important;
                }

                img[class="force-width-gmail"] {
                    display: none !important;
                    width: 0 !important;
                    height: 0 !important;
                }

                a[class="button-width"],
                a[class="button-mobile"] {
                    width: 248px !important;
                }

                td[class*="mobile-header-padding-left"] {
                    width: 160px !important;
                    padding-left: 0 !important;
                }

                td[class*="mobile-header-padding-right"] {
                    width: 160px !important;
                    padding-right: 0 !important;
                }

                td[class="header-lg"] {
                    font-size: 24px !important;
                    padding-bottom: 5px !important;
                }

                td[class="header-md"] {
                    font-size: 18px !important;
                    padding-bottom: 5px !important;
                }

                td[class="content-padding"] {
                    padding: 5px 0 30px !important;
                }

                td[class="button"] {
                    padding: 5px !important;
                }

                td[class*="free-text"] {
                    padding: 10px 18px 30px !important;
                }

                td[class="info-block"] {
                    display: block !important;
                    width: 280px !important;
                    padding-bottom: 40px !important;
                }

                td[class="info-img"],
                img[class="info-img"] {
                    width: 278px !important;
                }
            }
        </style>
  


        <table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%" style="background-color:#f7f7f7" >
            <tr>
                <td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
                    <center>
                        <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
                            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
                                <tr>
                                    <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
                                     
                                        <center>
                                            <table cellpadding="0" cellspacing="0" width="600" class="w320">
                                                <tr>
                                                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
                                                        <a href=""><img width="137" height="47" src="http://demo.dupleit.com/weblister_v2/images/logo.png" alt="logo"></a>
                                                    </td>
                                                    <td class="pull-right mobile-header-padding-right" style="color: #4d4d4d;">
                                                        <a href=""><img width="44" height="47" src="http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif" alt="twitter" /></a>
                                                        <a href=""><img width="38" height="47" src="http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif" alt="facebook" /></a>
                                                        <a href=""><img width="40" height="47" src="http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif" alt="rss" /></a>
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
                <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
                    <center>
                        <table cellspacing="0" cellpadding="0" width="600" class="w320">
                            <tr>
                                <td class="header-lg">
							The Weblisters!
                                </td>
                            </tr>
                            <tr>
                                <td class="free-text">
                                    Thank you for contacting us, our team will contact you soon.
                                </td>
                            </tr>
                            <tr>
                                <td style="height:100px;"></td>
                            </tr>
                            <tr>
                                <td >
                                    <table>
									<tr>
									<td>Name</td><td>'.$name.'</td></tr>
									<tr><td>Email</td><td>'.$email.'</td></tr>
									<tr><td>Phone</td><td>'.$phone.'</td></tr>
									<tr><td>Message</td><td>'.$message.'</td></tr>
									</table>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
                    <center>
                        <table cellspacing="0" cellpadding="0" width="600" class="w320">
                            <tr>
                                <td style="padding: 25px 0 25px">
                                    <strong>The Weblisters</strong><br />
                                    Kolkata <br />
                                    India <br /><br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>';
	}
	function ratingNewWrite($main,$dot)
	{	
		$arrayvalue = "0";
		if($dot <= 3)
		{
			$dot = "0";
			$arrayvalue = $main;
		}
		else if(($dot > 3)&&($dot <=7))
		{
			$dot = "5";
			$arrayvalue = $main.'.'.$dot;
		}
		else if(($dot > 7)&&($dot <=9))
		{
			if($main <= 4)
			{
				$main = $main+1;
			}	
			$arrayvalue = $main;
		}
		
		?>
<!--<fieldset class="rating323">
	<input type="radio" <?php if($arrayvalue==5){ ?> checked="checked" <?php } ?> id="star5" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==4.5){ ?> checked="checked" <?php } ?> id="star4half" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==4){ ?> checked="checked" <?php } ?> id="star4" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==3.5){ ?> checked="checked" <?php } ?> id="star3half"  value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==3){ ?> checked="checked" <?php } ?> id="star3"  value="3"  /><label class = "full" for="star3" title="Meh - 3 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==2.5){ ?> checked="checked" <?php } ?> id="star2half" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==2){ ?> checked="checked" <?php } ?> id="star2" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==1.5){ ?> checked="checked" <?php } ?> id="star1half" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==1){ ?> checked="checked" <?php } ?> id="star1" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
	
	<input type="radio" <?php if($arrayvalue==.5){ ?> checked="checked" <?php } ?> id="starhalf" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
	
	<input type="radio" <?php if($arrayvalue==0){ ?> <?php } ?> id="star0" value="0" /><label class="full" for="star0" title="" ></label>
</fieldset>-->


<fieldset class="rating323">
<label class = "full <?php if($arrayvalue>=5){ echo 'rating323_color'; } ?>" for="star5" title="Awesome - 5 stars"></label>
<label class="half <?php if($arrayvalue>=4.5){ echo 'rating323_color'; } ?>" for="star4half" title="Pretty good - 4.5 stars"></label>
<label class = "full <?php if($arrayvalue>=4){ echo 'rating323_color'; } ?>" for="star4" title="Pretty good - 4 stars"></label>
<label class="half <?php if($arrayvalue>=3.5){ echo 'rating323_color'; } ?>" for="star3half" title="Meh - 3.5 stars"></label>
<label class = "full <?php if($arrayvalue>=3){ echo 'rating323_color'; } ?>" for="star3" title="Meh - 3 stars"></label>
<label class="half <?php if($arrayvalue>=2.5){ echo 'rating323_color'; } ?>" for="star2half" title="Kinda bad - 2.5 stars"></label>
<label class = "full <?php if($arrayvalue>=2){ echo 'rating323_color'; } ?>" for="star2" title="Kinda bad - 2 stars"></label>
<label class="half <?php if($arrayvalue>=1.5){ echo 'rating323_color'; } ?>" for="star1half" title="Meh - 1.5 stars"></label>
<label class = "full <?php if($arrayvalue>=1){ echo 'rating323_color'; } ?>" for="star1" title="Sucks big time - 1 star"></label>
<label class="half <?php if($arrayvalue>=0.5){ echo 'rating323_color'; } ?>" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset>
		<?php
	}
}
?>