<?php
class Emailmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('email','session'));
		$this->load->helper(array("url","form","string"));
	}
	
	function companyfirstlogin($logolink,$usr_name)
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Congratulations on completing your registration successfully! You can start by listing your company on our platform by simply filling this form - 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Weblistr is a platform where users rate and review online companies based on their experiences. For you, it is a medium to communicate with your clients, understand their problems and provide them with a simple solution.  
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    We want customers to discover new and latest start-up which you can too be a part of. 
                                </td>
                            </tr>
                            
                            <tr>
                            	
                            	<td>
                                	<table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                    <tr>
                                    	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                        	Here are the ways in which you can get started on Weblistr:
                                        	<ul style='list-style:outside number; width: 100% !important;'>
                                            	<li>Reply to Customer reviews: Remember to be gentle and polite. You may get bad reviews, but your responses should be well structured so that you do not offend the customers. </li>
                                                
                                            </ul>
                                        </td>
                                    </tr>
                                        
                                        
                                       
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Are you not satisfied with the service you received? No problem! Use our platform to make sure you are not taken for granted (We abide by rule that consumer is god and all that ;) ). Share your experiences and feel free to add any images or videos as well (Nothing obscene please). That’s not all; you can also try out new and innovative websites and apps - Fun fact there are over 3000 websites and apps to choose from! This is why you need us, to simplify the online shopping process for you! 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Start by Rating a Webiste/App.</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Start by writing your VERY FIRST REVIEW!</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Discover new websites and apps.</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Create your own Weblists.  Here are some Weblists that might interest you</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>So we won’t bore you anymore! Start exploring here</a> 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Digital Hugs xoxo
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<strong style='color:#4d4d4d; margin-right:5px;'>PS:</strong> For all the Q's you may have, we got the A's ready! Simply hop over to our <a href='Faq' style='text-decoration:none;'>FAQs</a> (we promise it's a fun read).
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<strong style='color:#4d4d4d; margin-right:5px;'>PPS:</strong> We're living off of feedback these days and we need you to keep feeding us. For anything you want to tell us, please use the feedback button on the bottom right of the screen.
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function userfirsttimelogin($logolink,$usr_name)
	{
		$html = " <style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Welcome to the most exciting way of discovering the web! Weblistr is a platform for you to share your online shopping experience. You can rate and review websites and apps. What’s more is that you can bookmark your favourite websites and create your own ‘Weblists’ which can be shared with your family and friends. Our platform is the best way for you to discover new websites and apps every day. 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Are you not satisfied with the service you received? No problem! Use our platform to make sure you are not taken for granted (We abide by rule that consumer is god and all that ;) ). Share your experiences and feel free to add any images or videos as well (Nothing obscene please). That’s not all; you can also try out new and innovative websites and apps - Fun fact there are over 3000 websites and apps to choose from! This is why you need us, to simplify the online shopping process for you!  
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Congratulations on completing your registration successfully! Now that you are one of us, how would you like to embark upon this journey?  
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Start by Rating a Webiste/App.</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Start by writing your VERY FIRST REVIEW!</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Discover new websites and apps.</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>Create your own Weblists.  Here are some Weblists that might interest you</a>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<a href='#' style='text-decoration:none;'>So we won’t bore you anymore! Start exploring here</a> 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Digital Hugs xoxo
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<strong style='color:#4d4d4d; margin-right:5px;'>PS:</strong> For all the Q's you may have, we got the A's ready! Simply hop over to our <a href='#' style='text-decoration:none;'>FAQs</a> (we promise it's a fun read).
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<strong style='color:#4d4d4d; margin-right:5px;'>PPS:</strong> We're living off of feedback these days and we need you to keep feeding us. For anything you want to tell us, please use the feedback button on the bottom right of the screen.
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function weblistDisapproved($logolink,$usr_name,$prdname) //pending
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style> <body bgcolor='#f7f7f7'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    We regret informing you that your listing of $prdname company has been disapproved by our team. There are some details that seem to be a mismatch. We request you to recheck the information you had provided are team with. 
 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Here are a few things we think went wrong with your listing:
                                    <ul style='list-style:outside number; width: 100% !important;'>
                                    	<li>Logo of the startup is incorrect </li>
                                        <li>Details like shipping, payment incorrect </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Don’t let this stop you from listing another company. You can always ask our team of experts for help if you are facing any problems    
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email.   
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Have fun discovering the web and happy shopping!   
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Digital hugs xoxo 
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function weblistApprove($logolink,$usr_name,$prdname,$cat_name)
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style> <body bgcolor='#f7f7f7'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Thankyou for providing us with information about $prdname Company. We cross checked the details and your LISTING HAS BEEN APPROVED! You can find your listed company under ($cat_name) or simply click on this link to see it.  
 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You can also list another company with the correct details here.     
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Keep informing us about new and innovative start-ups like $prdname. We love to share details of new start-ups with our customers. Your reviews, ratings and listings help us build our base! Thankyou for trusting Weblistr to be your online shopping guide!   
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email.  
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Have fun discovering the web and happy shopping!
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Digital hugs xoxo 
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function ReviewDisapproved($logolink,$usr_name)
	{
		$html = " <style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style>  <body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    We regret to inform you that we could not approve your review. Our team read your review and it is not in line with our review guild lines (link). 
 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                            	Here are some pointers that will help you get going:
												<ul style='list-style:outside number; width: 100% !important;'>
                                    				<li>To avoid spam and fake reviews, we have set a minimum number of characters, ie, 140 characters while writing a review. Kindly ensure that any review you wish to write, you atleast have 140 characters.</li>
													<li>We understand you are angry, however, please ensure that no foul / abusive language , threats, and lewdness out of it. We, just like you, hate junk. We shall have to reject your review if such is the case, and we do not like doing that.</li> 
													<li>Feel free to add images but ensure that they are appropriate. We do not like seeing obscene images.</li>
                                    			</ul>
                                            </td>

                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                   We do not like to reject your reviews, so don’t give us a chance to do so.    
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Don’t let this stop you from writing another review. If you are facing any troubles contact our team of experts and they will guide you through the process.  
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	We hope you will keep writing to us to let other shoppers learn from your experience.  
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email. 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Have fun discovering the web and happy shopping! 
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Digital hugs xoxo 
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}	
	function ReviewSubmit($logolink,$usr_name)
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
		

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Congratulations on writing your FIRST REVIEW! We are so excited to have read it because we love to hear from you! 
 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You are probably wondering where did my review go? Well, each time you write to us, the review undergoes a confirmation process to ensure that they are in line with the <a href='#' style='text-decoration:none;'>review guidelines</a>. So don’t worry, we will let you know when your review has been approved.    
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Keep writing reviews to make your voices heard. Other shoppers can learn from your experiences, so always try and add images. You can check out our <a href='#' style='text-decoration:none;'>Featured Weblists</a> and also create your own by simply bookmarking your favourite websites and apps.   
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email.   
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Have fun discovering the web and happy shopping!
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
									Digital hugs xoxo
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function NewBookmark($logolink,$usr_name)
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style>  <body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg' style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You have been bookmarked by a new user! Way to go! Click on the link below to see who bookmarked you. (link)  
 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    A bookmark means that you have been added to a ‘Weblist’ by a user. This helps the user remember who you are. We have a few customized Weblists which can be viewed here.     
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Always appreciate users who bookmark you by giving them a thumbsup!   
                                </td>
                            </tr>
                            
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email.  
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function InformationSuccessEditApprove($logolink,$usr_name) // not in use now
	{
		$html = "<style type='text/css'>
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
			td.team_bg {
				
			}
			.bg_box {
    			background: hsl(0, 0%, 100%) none repeat scroll 0 0;
    			border: 1px solid hsl(0, 0%, 93%);
    			box-shadow: 1px 2px 2px hsl(0, 0%, 93%);
    			padding-bottom: 50px;
			}

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                                                        <a href=''><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                                                        <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href=''><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320 bg_box'>
                            <tr>
                                <td class='header-lg'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                                    <tr>
                                    	<td class='free-text'>
                                        	We are happy to inform you that your request to edit the following information has been approved:
                                        	<ul style='list-style:outside number'>
                                            	<li>FROM TO</li>
                                            </ul>
                                        </td>
                                    </tr>
                                        
                                        
                                       
                                    </table>
                                   
 

  
 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text'>
                                    Our team has crosschecked the information and the new information requested by you will now be displayed.      
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320 bg_box'>
                            <tr>
                                <td style='padding: 20px 0 20px' class='team_bg'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	function ReplyComment($logolink,$usr_name)
	{
		$html ="<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style>  <body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg' style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                          


                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You have one new comment on your reply given to this review:       
                                </td>
                            </tr>
 

                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
									(Review + Reply)
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Click here to view the comment given by the user.       
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    <strong style='color:#4d4d4d; margin-right:5px;'>Tip:</strong> Always give a positive response, even to bad reviews. ‘Customer is God’ – abide by this rule.       
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You can also view your comment history with this user here.      
                                </td>
                            </tr>
                            
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	
	function ReviewApprovedForCompany($logolink,$usr_name,$ReviewDetailLink)
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg' style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You have 1 new review from a user. The review has been proof-read and approved by our team. 
<a href='$ReviewDetailLink' target='_blank' >Click here</a> to read the review: 
 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    We encourage you to respond to this review and let them know that their problems will be solved by you. Users often write more reviews for your website/app, if they see an interest from the management as well.    
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Please note that WE DO NOT REMOVE BAD REVIEWS OR RATINGS AT THE REQUEST OF COMPANIES.  
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	<strong style='color:#4d4d4d; margin-right:5px;'>Tip:</strong> Always give a positive response, even to bad reviews. ‘Customer is God’ – abide by this rule.  
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email. 
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	
	function ReviewApproved($logolink,$usr_name,$prdname,$prdid,$rev_id) // for users 
	{
		$html = "<style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Dear $usr_name,
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    CONGRATULATIONS!! We read your review about <a href='http://www.weblistr.com/Review/revdetail/$prdid/$rev_id'>$prdname</a> and simply loved it! Your review has been approved. You can check it out here: 
 
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Keep sending in more reviews to keep other shoppers updated about your experience. You can share your reviews with your friends too! If you wish to edit your review, feel free to do so anytime.    
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Weblistr is a free review and rating platform to connect the online users to the start-ups. It’s your one stop platform to let the companies know whether you loved / disliked their service and why!   
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	If you ever have any questions or feedback for us, please don't hesitate to give us a shout out by simply sending us a feedback email.  
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Have fun discovering the web and happy shopping!
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                	Digital hugs xoxo
                                </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	
	function RegistrationEmailConfirmation($verifylink,$logolink)
	{
		$html = " <style type='text/css'>
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
            /** {
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
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
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
				text-align:left;
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
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
            }*/
			

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style> <body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td class='header-lg'  style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You’re almost there!
                                </td>
                            </tr>
                            <tr>
                                <td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Thanks for trying out Weblistr. You can embark on your journey to discover the web by simply clicking on the link below and confirming your email id. 
                                </td>
                            </tr>
                            <tr>
                                <td style='text-align:center;'><a href='http://www.w3schools.com/howto/img_fjords.jpg'><img style='width:300px; height:200px; margin-top:15px;' src='http://www.w3schools.com/howto/img_fjords.jpg' /></a></td>
                            </tr>
                            <tr>
                                <td class='button' style='padding: 30px 0;'>
                                    <center>
                                    <div><!--[if mso]>
                                      <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                                        <w:anchorlock/>
                                        <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>My Account</center>
                                      </v:roundrect>
                                    <![endif]--><a class='button-mobile' href='$verifylink'
                                                       style='text-align:center;'><img src='http://www.weblistr.com/images/verify-btn.jpg' width='155' height='45' /></a>
                                    </div>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>We are grateful that you have chosen Weblistr your trusted guide for online shopping! </td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>Have fun discovering the web and happy shopping!</td>
                            </tr>
                            <tr>
                            	<td class='free-text' style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>Digital hugs xoxo</td>
                            </tr>

                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
	return $html;
	}
	
	function companyemailverification($link,$logolink)
	{
		$html = "<style type='text/css'>
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
			/** {
                font-family: Helvetica, Arial, sans-serif;
            }*/
			
            /*body {
                -webkit-font-smoothing: antialiased;
                -webkit-text-size-adjust: none;
                width: 100% !important;
                margin: 0 !important;
                height: 100%;
                color: #676767;
            }*/

            /*td {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
            }*/
            /*a {
                color: #676767;
                text-decoration: none !important;
            }*/

            /*.pull-left {
                text-align: left;
            }*/

            /*.pull-right {
                text-align: right;
            }*/

            /*.header-lg,
            .header-md,
            .header-sm {
                font-size: 18px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
            }*/

            /*.header-md {
                font-size: 24px;
            }

            .header-sm {
                padding: 5px 0;
                font-size: 18px;
                line-height: 1.3;
            }*/

            /*.content-padding {
                padding: 20px 0 30px;
            }*/

            /*.mobile-header-padding-right {
                width: 290px;
                text-align: right;
                padding-left: 10px;
            }*/

            /*.mobile-header-padding-left {
                width: 290px;
                text-align: left;
                padding-left: 10px;
            }*/

            

            /*.block-rounded {
                border-radius: 5px;
                border: 1px solid #e5e5e5;
                vertical-align: top;
            }*/

            

            /*.info-block {
                padding: 0 20px;
                width: 260px;
            }*/

            /*.block-rounded {
                width: 260px;
            }*/

            /*.info-img {
                width: 258px;
                border-radius: 5px 5px 0 0;
            }*/

            .force-width-gmail {
                min-width:600px;
                height: 0px !important;
                line-height: 1px !important;
                font-size: 1px !important;
            }

            /*.button-width {
                width: 228px;
			}*/

        </style>

        <style type='text/css' media='screen'>
            @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
        </style>

        <style type='text/css' media='screen'>
            @media screen {
                /* Thanks Outlook 2013! */
                * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
            }
        </style>

        <style type='text/css' media='only screen and (max-width: 480px)'>
            /* Mobile styles */
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
        </style><body bgcolor='#f7f7f7' style='-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; margin: 0 !important; height: 100%; color: #676767;'>
        <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
            <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                    <center>
                        <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                                <tr>
                                    <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                                        <!--[if gte mso 9]>
                                        <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                                          <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                                          <v:textbox inset='0,0,0,0'>
                                        <![endif]-->
                                        <center>
                                            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                                                <tr>
                                                    <td class='pull-left mobile-header-padding-left' style='vertical-align:middle; text-align:left; padding-left:10px; width:290px;'>
                                                        <a href='#'><img src='$logolink' width='120' height='64' alt='logo' /></a>
                                                    </td>
                                                    <td class='pull-right mobile-header-padding-right' style='color:#4d4d4d; width:290px; text-align:right; padding-left:10px;'>
                                                        <a href='#'><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                                                        <a href='#'><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                                                        <a href='#'><img width='40' height='47' src='http://s3.amazonaws.com/swu-filepicker/hR33ye5FQXuDDarXCGIW_social_10.gif' alt='rss' /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        <!--[if gte mso 9]>
                                        </v:textbox>
                                      </v:rect>
                                      <![endif]-->
                                    </td>
                                </tr>
                            </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; padding: 20px 0 30px;' class='content-padding'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                        	
    			
    			
    			
                            <tr>
                                <td style='font-size: 17px;
                font-weight: 700;
                line-height: normal;
                padding: 35px 0 0 60px;
                color: #4d4d4d;
				text-align:left;
                font-family:Arial, Helvetica, sans-serif;'>
                                    You’re almost there! 
                                </td>
                            </tr>
                            <tr>
                                <td style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>
                                    Thanks for trying out Weblistr. Your registration process is almost complete. All you need to do is click on the link below and you can embark upon your journey. 
                                </td>
                            </tr>
                            <tr>
                                <td style='text-align:center;'><a href='http://www.w3schools.com/howto/img_fjords.jpg'sty><img style='width:300px;min-height:200px;margin-top:15px' src='http://www.w3schools.com/howto/img_fjords.jpg' /></a></td>
                            </tr>
                            <tr>
                                <td class='button' style='padding: 30px 0;'>
                                    <center>
                                    <div><!--[if mso]>
                                      <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                                        <w:anchorlock/>
                                        <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>My Account</center>
                                      </v:roundrect>
                                    <![endif]--><a href='$link'
                                                       style='text-align:center;'><img src='http://www.weblistr.com/images/verify-btn.jpg' width='155' height='45' /></a>
                                    </div>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                            	<td style='width: 100% !important;
                padding: 10px 60px 0px;
				text-align:left;
                font-size: 14px;
                color: #777777;
                line-height: 21px;
                font-family:Arial, Helvetica, sans-serif;'>We are grateful that you have chosen Weblistr as a platform to connect with your customers. </td>
                            </tr>
                            <tr>
                                <td style='height:50px;'>
                                         
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            
            <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
                    <center>
                        <table cellspacing='0' cellpadding='0' width='600' class='w320' style='background:#fff; border: 1px solid #eee;'>
                            <tr>
                                <td style='padding:20px 0; font-family:Arial, Helvetica, sans-serif; font-size: 14px;
                color: #777777;
                line-height: 21px;
                text-align:center;'>
                                    <strong>Team Weblistr</strong><br />
                                    Kolkata <br />
                                    India <br />
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>
    </body>";
		return $html;
	}
	
}
?>