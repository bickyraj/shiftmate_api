<?php
    date_default_timezone_set("Asia/Kathmandu");

class TemplateCheckinTask extends Shell {
        public $url="192.168.0.150/newshiftmate/webroot/files/user/image";
        public $uses = array('ShiftUser','Shift','User');
        public function execute() {
            $this->ShiftUser->Behaviors->load('Containable');
            
            $date1=new DateTime();
            $date2=$date1->format('Y-m-d');
            $datas=$this->ShiftUser->find('all',array('conditions'=>array('ShiftUser.shift_date'=>$date2),'contain'=>array('Shift','User','User.BoardUser','User.BoardUser.Board','User.BoardUser.Board.User','User.BranchUser','User.BranchUser.Branch','User.BranchUser.Branch.User','User.OrganizationUser','User.OrganizationUser.Organization','User.OrganizationUser.Organization.User')));
            $u=array();
            foreach($datas as $data){
                //return $u;
                //return $data;
                        $date3=new DateTime();
                        $date4=$date1->format('H:i:s');
                        if($date4>$data['Shift']['starttime'] && $data['ShiftUser']['check_status']==0){
                            
                            foreach($data['User']['OrganizationUser'] as $org){
                                $u[$org['Organization']['id']]['toorg']['message']="checkin";
                                $u[$org['Organization']['id']]['toorg']['name']=$org['Organization']['title'];
                                $u[$org['Organization']['id']]['toorg']['email']=$org['Organization']['User']['email'];  
                    
                                $u[$org['Organization']['id']]['toorg']['user'][$data['User']['id']]['name']= $data['User']['fname']." ".$data['User']['lname'];
                                $u[$org['Organization']['id']]['toorg']['user'][$data['User']['id']]['email']=$data['User']['email'];
                                $u[$org['Organization']['id']]['toorg']['user'][$data['User']['id']]['image']= $data['User']['image_dir']."/".$data['User']['image'];
                            }
                            foreach($data['User']['BranchUser'] as $bra){
                                $u[$bra['Branch']['id']]['tobranch']['message']="checkin";
                                $u[$bra['Branch']['id']]['tobranch']['name']=$bra['Branch']['title'];
                                $u[$bra['Branch']['id']]['tobranch']['email']=$bra['Branch']['User']['email']; 
                    
                                $u[$bra['Branch']['id']]['tobranch']['user'][$data['User']['id']]['name']= $data['User']['fname']." ".$data['User']['lname'];
                                $u[$bra['Branch']['id']]['tobranch']['user'][$data['User']['id']]['email']=$data['User']['email'];
                                $u[$bra['Branch']['id']]['tobranch']['user'][$data['User']['id']]['image']= $data['User']['image_dir']."/".$data['User']['image'];   
                            }
                            foreach($data['User']['BoardUser'] as $bu){ 
                                $u[$bu['Board']['id']]['toboard']['message']="checkin";
                                $u[$bu['Board']['id']]['toboard']['name']=$bu['Board']['title'];
                                $u[$bu['Board']['id']]['toboard']['email']=$bu['Board']['User']['email'];
                   
                                $u[$bu['Board']['id']]['toboard']['user'][$data['User']['id']]['name']= $data['User']['fname']." ".$data['User']['lname'];
                                $u[$bu['Board']['id']]['toboard']['user'][$data['User']['id']]['email']=$data['User']['email'];
                                $u[$bu['Board']['id']]['toboard']['user'][$data['User']['id']]['image']= $data['User']['image_dir']."/".$data['User']['image'];    
                            }
                            
                          //  $u[$data['User']['id']]['message']="checkin";
                          //  $u[$data['User']['id']]['name']=ucwords($data['User']['fname']." ".$data['User']['lname']);
                          //  $u[$data['User']['id']]['email']=$data['User']['email'];
                        };
                        if($date4>$data['Shift']['endtime'] && $data['ShiftUser']['check_status']==1){
                            foreach($data['User']['OrganizationUser'] as $org){
                                $u[$org['Organization']['id']]['toorg']['message']="checkout";
                                $u[$org['Organization']['id']]['toorg']['name']=$org['Organization']['title'];
                                $u[$org['Organization']['id']]['toorg']['email']=$org['Organization']['User']['email'];  
                    
                                $u[$org['Organization']['id']]['toorg']['user'][$data['User']['id']]['name']= $data['User']['fname']." ".$data['User']['lname'];
                                $u[$org['Organization']['id']]['toorg']['user'][$data['User']['id']]['email']=$data['User']['email'];
                                $u[$org['Organization']['id']]['toorg']['user'][$data['User']['id']]['image']= $data['User']['image_dir']."/".$data['User']['image'];
                            }
                            foreach($data['User']['BranchUser'] as $bra){
                                $u[$bra['Branch']['id']]['tobranch']['message']="checkout";
                                $u[$bra['Branch']['id']]['tobranch']['name']=$bra['Branch']['title'];
                                $u[$bra['Branch']['id']]['tobranch']['email']=$bra['Branch']['User']['email']; 
                    
                                $u[$bra['Branch']['id']]['tobranch']['user'][$data['User']['id']]['name']= $data['User']['fname']." ".$data['User']['lname'];
                                $u[$bra['Branch']['id']]['tobranch']['user'][$data['User']['id']]['email']=$data['User']['email'];
                                $u[$bra['Branch']['id']]['tobranch']['user'][$data['User']['id']]['image']= $data['User']['image_dir']."/".$data['User']['image'];   
                            }
                            foreach($data['User']['BoardUser'] as $bu){ 
                                $u[$bu['Board']['id']]['toboard']['message']="checkout";
                                $u[$bu['Board']['id']]['toboard']['name']=$bu['Board']['title'];
                                $u[$bu['Board']['id']]['toboard']['email']=$bu['Board']['User']['email'];
                   
                                $u[$bu['Board']['id']]['toboard']['user'][$data['User']['id']]['name']= $data['User']['fname']." ".$data['User']['lname'];
                                $u[$bu['Board']['id']]['toboard']['user'][$data['User']['id']]['email']=$data['User']['email'];
                                $u[$bu['Board']['id']]['toboard']['user'][$data['User']['id']]['image']= $data['User']['image_dir']."/".$data['User']['image'];    
                            }
                            
                            //$u[$data['User']['id']]['message']="checkout";
                            //$u[$data['User']['id']]['name']=ucwords($data['User']['fname']." ".$data['User']['lname']);
                            //$u[$data['User']['id']]['email']=$data['User']['email'];
                        }

            }
            return $u;
        }
        
    
    public function header($type){
        if($type=='toorg'){
            $maintype="Organization Mail";
        }elseif($type=='tobranch'){
            $maintype="Branch Mail";
        }elseif($type=='toboard'){
            $maintype="Board Mail";
        }
        return '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>checkin/checkout Notification</title>
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
	<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
	</td></tr>
	<!--header -->
	<tr><td align="center" bgcolor="#ffffff">
		<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
					<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">ShiftMate
						<!-- <img src="http://artloglab.com/metromail-shop/images/logo.gif" width="115" height="19" alt="Metronic" border="0" style="display: block;" />--></font></a> 
				</td>
			</tr>
            <tr><td align="center">
				<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
					<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
                    '.$maintype.'						 
				</td></tr>
		</table>
		<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
	</td></tr>
	<!--header END-->

	<!--goods -->
	<tr><td align="center" bgcolor="#ffffff">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;">&nbsp;</div>

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td align="center">
						<font face="Arial, Helvetica, sans-serif" size="5" color="#57697e" style="font-size: 22px;">
						<span style="font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: #57697e; text-transform: uppercase;">
							List of users who has not checkin / checkout on time.
						</span></font>
						<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
					</td></tr>			
				</table>
                <table width="100%" class="row" border="0" cellspacing="0" cellpadding="0">
					<tr><td align="center">';
    }
    public function footer(){
        return '</td></tr>			
				</table></td></tr>
			<tr><td><!-- padding --><div style="height: 10px; line-height: 10px; font-size: 10px;">&nbsp;</div></td></tr>
		</table>		
	</td></tr>
	<!--goods END-->
    <!--pre-footer -->
	<tr><td class="iage_footer" align="center" bgcolor="#fcfafb" style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #e8e8e8;">
		<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<div style="line-height: 27px;">
					<font face="Arial, Helvetica, sans-serif" size="3" color="#717171" style="font-size: 27px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 27px; color: #717171;">
					<!--	Need help? Call us! -->
					</span></font>
				</div>
				<!-- padding --><div style="height: 25px; line-height: 25px; font-size: 10px;">&nbsp;</div>
				<div style="line-height: 27px;">
					<font face="Arial, Helvetica, sans-serif" size="3" color="#f54c57" style="font-size: 27px;">
					<strong style="font-family: Arial, Helvetica, sans-serif; font-size: 27px; color: #f54c57;">
					<!--	873-426-0028 -->
					</strong></font>
				</div>
			</td></tr>
		</table>
		
		<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>	
	</td></tr>
	<!--pre-footer END-->

	<!--footer -->
	<tr><td class="iage_footer" align="center" bgcolor="#fcfafb" style="border-top-width: 1px; border-top-style: solid; border-top-color: #ffffff;">
		<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>	
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<font face="Arial, Helvetica, sans-serif" size="3" color="#717171" style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #717171;">
					Designed & Developed By: OnePlatinum Technology
				</span></font>				
			</td></tr>			
		</table>
		
		<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>	
	</td></tr>
	<!--footer END-->
	<tr><td>
	<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
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
    public function content($value2){
        $con="";
        if($value2['message']=='checkin'){
            $message="Has not CheckIn Yet";
        }elseif($value2['message']=='checkout'){
            $message="Has not CheckOut Yet";
        }
        foreach($value2 as $key=>$value){
            if($key=='user'){
                foreach($value as $ukey=>$user){
                    foreach($user as $ukey2=>$user2){
                        switch ($ukey2){
                            case 'name':
                                $name=$user2;
                            break;
                            case 'email':
                                $email=$user2;
                            break;
                            case 'image':
                                $image=$this->url.$user2;
                            break;
                        }
                    }
                    $con.='<table class="mob_100 col-md-5" width="100%" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
								<tr><td align="center" style="line-height: 14px; padding: 0 25px;">
									<div style="border-width: 1px; border-style: solid; border-color: #eff2f4;">
										<div style="line-height: 14px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
												<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
													<img src="'.$image.'" width="272" alt="Goods 1" border="0" style="display: block; width: 100%; height: auto;" /></font></a>
										</div>
										<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
										<div style="line-height: 21px; padding: 0 10px;">
											<font face="Arial, Helvetica, sans-serif" size="3" color="#727272" style="font-size: 15px;">
											<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #727272; text-transform: uppercase;">
												<a href="#" target="_blank" style="color: #727272; text-decoration: none;">'.$name.'</a>
											</span></font>
										</div>
                                        <div style="line-height: 21px; padding: 0 10px;">
											<font face="Arial, Helvetica, sans-serif" size="3" color="#727272" style="font-size: 15px;">
											<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #727272; text-transform: uppercase;">
												<a href="#" target="_blank" style="color: #727272; text-decoration: none;">'.$message.'</a>
											</span></font>
										</div>
										<!-- padding --><div style="height: 5px; line-height: 5px; font-size: 10px;">&nbsp;</div>
										<div style="line-height: 21px; padding: 0 10px;">
											<font face="Arial, Helvetica, sans-serif" size="5" color="#727272" style="font-size: 18px;">
											<strong style="font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 18px; color: #727272;">
												'.$email.'
											</strong></font>
										</div>
										<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
									</div>
									<!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
								</td></tr>
							</table>';
                }
            }
        }
        return $con;

    }
}