<?php
date_default_timezone_set("Asia/Kathmandu");

class TemplateReviewTask extends Shell {
    public $url="http://shiftmate.com.au/dev/???";
    public $url_view="http://shiftmate.com.au/dev/";
    public $uses = array('OrganizationUser');
    
    /**
     * TemplateReviewTask::execute()
     * 
     * @return
     */
    public function execute() {
        $allReviews = $this->OrganizationUser->getReviews();
        $count = 0;
        if(isset($allReviews) && !empty($allReviews)){
        foreach($allReviews as $data){
            $result[$data['OrganizationUser']['organization_id']]['org']['id']=$data['OrganizationUser']['organization_id'];
            $result[$data['OrganizationUser']['organization_id']]['org']['title']=$data['Organization']['title'];
            $result[$data['OrganizationUser']['organization_id']]['org']['email']=$data['Organization']['email'];
            $result[$data['OrganizationUser']['organization_id']]['org']['image']=$this->url."webroot/files/organization/logo/".$data['Organization']['logo_dir']."/thumb_".$data['Organization']['logo'];
            
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['id']=$data['User']['id'];
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['name']=ucwords($data['User']['fname']." ".$data['User']['lname']);
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['email']=$data['User']['email'];
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['image']=$this->url."webroot/files/user/image/".$data['User']['image_dir']."/thumb2_".$data['User']['image'];
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['reviewdate'] = $data['OrganizationUser']['reviewdate'];
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['reviewperiod'] = $data['OrganizationUser']['reviewperiod']; 
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["details"]['OrganizationUserId'] = $data['OrganizationUser']['id'];        
                        
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["role"]['id']=$data['Organizationrole']['id'];
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["role"]['title']=$data['Organizationrole']['title'];
            
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["group"]['id']=$data['Group']['id'];
            $result[$data['OrganizationUser']['organization_id']]['user'][$count]["group"]['title']=$data['Group']['title'];                                                            
            
            $count++;
        }
        }else{
            $result = "";
        }
        return $result;
    }
    
    public function header($org){
        return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Metronic | A Responsive Email Template</title>
<style type="text/css">
html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
@media only screen and (max-device-width: 680px), only screen and (max-width: 680px) { 
	*[class="table_width_100"] {
		width: 96% !important;
	}
	*[class="border-right_mob"] {
		border-right: 1px solid #dddddd;
	}
	*[class="mob_100"] {
		width: 100% !important;
	}
	*[class="mob_center"] {
		text-align: center !important;
		padding: 0 !important;
	}
	*[class="mob_center_bl"] {
		float: none !important;
		display: block !important;
		margin: 0px auto;
	}	
	.iage_footer a {
		text-decoration: none;
		color: #929ca8;
	}
	img.mob_display_none {
		width: 0px !important;
		height: 0px !important;
		display: none !important;
	}
	img.mob_width_50 {
		width: 40% !important;
		height: auto !important;
	}
	img.mob_width_80 {
		width: 80% !important;
		height: auto !important;
	}
	img.mob_width_80_center {
		width: 80% !important;
		height: auto !important;
		margin: 0px auto;
	}
	.img_margin_bottom {
		font-size: 0;
		height: 25px;
		line-height: 25px;
	}
}
.table_width_100 {
	width: 680px;
}
</style>
</head>

<body style="padding: 0px; margin: 0px;">
<div id="mailsub" class="notification" align="center">

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">


<!--[if gte mso 10]>
<table width="680" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<![endif]-->

<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
	<tr><td>
	<!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;">&nbsp;</div>
	</td></tr>
	<!--header -->
	<tr><td align="center" bgcolor="#ffffff">
		<!-- padding --><div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div>
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="left"><!-- 

				Item --><div class="mob_center_bl" style="float: left; display: inline-block; width: 115px;">
					<table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
						<tr><td align="left" valign="middle">
							<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
							<table width="115" border="0" cellspacing="0" cellpadding="0" >
								<tr><td align="left" valign="top" class="mob_center">
									<a href="'.$this->url_view.'" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
									<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
									<img src="'.$this->url.'webroot/img/logo.jpeg" width="115" height="19" alt="Shiftmate" border="0" style="display: block;" /></font></a>
								</td></tr>
							</table>						
						</td></tr>
					</table></div><!-- Item END--><!--[if gte mso 10]>
					</td>
					<td align="right">
				<![endif]--><!-- 

				Item --><div class="mob_center_bl" style="float: right; display: inline-block; width: 88px;">
					<table width="88" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;">
						<tr><td align="right" valign="middle">
							<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" >
								<tr><td align="right">
									<!--social -->
									<div class="mob_center_bl" style="width: 88px;">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr><td width="30" align="center" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#596167">
											<img src="http://artloglab.com/metromail3/images/facebook.gif" width="10" height="19" alt="Facebook" border="0" style="display: block;" /></font></a>
										</td><td width="39" align="center" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#596167">
											<img src="http://artloglab.com/metromail3/images/twitter.gif" width="19" height="16" alt="Twitter" border="0" style="display: block;" /></font></a>
										</td><td width="29" align="right" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#596167">
											<img src="http://artloglab.com/metromail3/images/dribbble.gif" width="19" height="19" alt="Dribbble" border="0" style="display: block;" /></font></a>
										</td></tr>
									</table>
									</div>
									<!--social END-->
								</td></tr>
							</table>
						</td></tr>
					</table></div><!-- Item END--></td>
			</tr>
		</table>
		<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
	</td></tr>
	<!--header END-->

	<!--content 1 -->
	<tr><td align="center" bgcolor="#f8f8f8">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;">&nbsp;</div>
				<div style="line-height: 44px;">
					<font face="Arial, Helvetica, sans-serif" size="5" color="#6b6b6b" style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #6b6b6b;">
						Remainder for <strong>Review</strong> of <a href="'.$this->url_view.'organizations/organizationProfile?org_id='.$org['id'].'"><strong>'.$org['title'].'</strong>
					</span></font>
				</div>
				<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
			</td></tr>
			<tr><td align="center">
				<div style="line-height: 24px;">
					<font face="Arial, Helvetica, sans-serif" size="4" color="#9c9c9c" style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #9c9c9c;">
						Reviews that are to be done in predefined interval <br/>as stated while assigning users to the organization
					</span></font>
				</div>
				<!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
			</td></tr>
		</table>		
	</td></tr>
	<!--content 1 END-->';
    }
    
    public function footer(){
        return '<!--footer -->
	<tr><td align="center" bgcolor="#ffffff">
		<!-- padding --><div style="height: 15px; line-height: 15px; font-size: 10px;">&nbsp;</div>
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="left"><!-- 

				Item --><div class="mob_center_bl" style="float: left; display: inline-block; width: 115px;">
					<table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
						<tr><td align="left" valign="middle">
							<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
							<table width="115" border="0" cellspacing="0" cellpadding="0" >
								<tr><td align="left" valign="top" class="mob_center">
									<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
									<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
									<img src="'.$this->url.'webroot/img/logo.jpeg" width="115" height="19" alt="SHIFTMATE" border="0" style="display: block;" /></font></a>
								</td></tr>
							</table>						
						</td></tr>
					</table></div><!-- Item END--><!--[if gte mso 10]>
					</td>
					<td align="right">
				<![endif]--><!-- 

				Item --><div class="mob_center_bl" style="float: right; display: inline-block; width: 150px;">
					<table class="mob_center" width="150" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;">
						<tr><td align="right" valign="middle">
							<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" >
								<tr><td align="right">
									<!--social -->
									<div class="mob_center_bl">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr><td align="center" style="line-height: 19px; padding-right: 20px;">
											<a href="#" target="_blank" style="color: #9c9c9c; font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-decoration: none;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#9c9c9c">
											About</font></a>
										</td><td align="center" style="line-height: 19px; padding-right: 20px;">
											<a href="#" target="_blank" style="color: #9c9c9c; font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-decoration: none;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#9c9c9c">
											Blog</font></a>
										</td><td align="right" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #9c9c9c; font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-decoration: none;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#9c9c9c">
											Contact</font></a>
										</td></tr>
									</table>
									</div>
									<!--social END-->
								</td></tr>
							</table>
						</td></tr>
					</table></div><!-- Item END--></td>
			</tr>
		</table>
		<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
	</td></tr>
	<!--footer END-->


	<tr><td>
	<!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;">&nbsp;</div>
	</td></tr>
</table>
<!--[if gte mso 10]>
</td></tr>
</table>
<![endif]-->
 
</td></tr>
</table>
			
</div> 
</body>
</html>';
    }
    
    public function content($user){
        $con = "";
        if(isset($user) && !empty($user)){
        foreach($user as $usr){
            $con.='<tr><td align="center" bgcolor="#ffffff" style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #eff2f4;">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<!-- padding --><div style="height: 74px; line-height: 74px; font-size: 10px;">&nbsp;</div>

				<div class="mob_100" style="float: left; display: inline-block; width: 35%;">
					<table class="mob_100" width="100%" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
						<tr><td class="mob_center" style="line-height: 14px; padding: 0 25px 0 0;">
							<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
							<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
							<img src="'.$usr["details"]['image'].'" width="185" height="130" alt="PP" border="0" class="mob_center_bl" style="display: block; width: 100%; height: auto;" /></font></a>
							<div class="img_margin_bottom">&nbsp;</div>
						</td></tr>
					</table>
				</div>
				<div class="mob_100" style="float: left; display: inline-block; width: 65%;">
					<table class="mob_100" width="100%" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
						<tr><td style="line-height: 14px;" class="mob_center">
							<div style="line-height: 18px;">
								<font face="Arial, Helvetica, sans-serif" size="3" color="#6b6b6b" style="font-size: 18px;">
								<strong style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #6b6b6b;">
									<a href="#2" target="_blank" style="color: #6b6b6b; text-decoration: none;">'.$usr['details']['name'].'</a>
								</strong></font>
							</div>
							<!-- padding --><div style="height: 13px; line-height: 13px; font-size: 10px;">&nbsp;</div>
							<div style="line-height: 21px;">
								<font face="Arial, Helvetica, sans-serif" size="3" color="#9c9c9c" style="font-size: 15px;">
								<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #9c9c9c;">
									Email : '.$usr['details']['email'].'<br/>
                                    Review Date : '.$usr['details']['reviewdate'].'<br/>
                                    Review frequency : '.$usr['details']['reviewperiod'].'<br/>
                                    Role : '.$usr["role"]['title'].'<br/>
                                    Group : '.$usr["group"]['title'].'
								</span></font>
							</div>
						</td></tr>
					</table>
				</div>							
			</td></tr>
			<tr><td><!-- padding --><div style="height: 35px; line-height: 35px; font-size: 10px;">&nbsp;</div></td></tr>
		</table>		
	</td></tr>';
        }
        }
        return $con;
    }
    
    public function manageDates($user){
        if(isset($user) && !empty($user)){
            foreach($user as $usr){
                $this->OrganizationUser->updateReviews($usr['details']['OrganizationUserId']);
            }
        }
    }
            
}
?>