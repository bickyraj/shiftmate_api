<?php
//for email sending
App::uses('CakeEmail','Network/Email');
class LateNotificationShell extends AppShell{

	public $uses = array('ShiftUser','Shift','User');
	public function main(){

		$shiftusers = $this->ShiftUser->find('all',array(
			'conditions'=>array('ShiftUser.latestatus'=>1)
			));

			$id = array();
				//$this->out(print_r($late_status,true));
		foreach($shiftusers as $shiftuser){

			$id[$shiftuser['User']['id']][] = $shiftuser['User']['id'];

			// foreach($shiftuser as $user){
			// 	$this->out(print_r($user,true));
			// }

		}
		foreach($id as $i=>$c){
			$co=0;
			foreach($c as $k=>$v){
				$co++;
			}
			$count[$i]['count']=$co;
			$shiftusername = $this->User->find('first',array('conditions'=>array('User.id'=>$i)));
			$count[$i]['name']=ucwords($shiftusername['User']['fname']." ".$shiftusername['User']['lname']);
			$count[$i]['email']=$shiftusername['User']['email'];
		}
		 foreach($count as $c)
		 {
		 	if($c['count']>=3){
		 		$count = $c['count'];
				$name = $c['name'];
				$notification = 'Late Notification';
				$message = 'You are late '.$count.' times in last six month.We request you to come on right time';


		 		$body='
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to the Metronic | A Responsive Email Template</title>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tbody><tr><td align="center" bgcolor="#eff3f8">


<!--[if gte mso 10]>
<table width="680" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<![endif]-->



<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
	<!--header -->
	<tbody><tr><td align="center" bgcolor="#eff3f8">
		<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
		<table width="96%" border="0" cellspacing="0" cellpadding="0">
			<tbody><tr><td align="left"><!-- 

				Item --><div class="mob_center_bl" style="float: left; display: inline-block; width: 115px;">
					<table class="mob_center" width="115" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
						<tbody><tr><td align="left" valign="middle">
							<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
							<table width="115" border="0" cellspacing="0" cellpadding="0">
								<tbody><tr><td align="left" valign="top" class="mob_center">
									<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
									<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
									<img src="http://artloglab.com/metromail2/images/logo.gif" width="115" height="19" alt="Metronic" border="0" style="display: block;"></font></a>
								</td></tr>
							</tbody></table>						
						</td></tr>
					</tbody></table></div><!-- Item END--><!--[if gte mso 10]>
					</td>
					<td align="right">
				<![endif]--><!-- 

				Item --><div class="mob_center_bl" style="float: right; display: inline-block; width: 88px;">
					<table width="88" border="0" cellspacing="0" cellpadding="0" align="right" style="border-collapse: collapse;">
						<tbody><tr><td align="right" valign="middle">
							<!-- padding --><div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tbody><tr><td align="right">
									<!--social -->
									<div class="mob_center_bl" style="width: 88px;">
									<table border="0" cellspacing="0" cellpadding="0">
										<tbody><tr><td width="30" align="center" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#596167">
											<img src="http://artloglab.com/metromail2/images/facebook.gif" width="10" height="19" alt="Facebook" border="0" style="display: block;"></font></a>
										</td><td width="39" align="center" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#596167">
											<img src="http://artloglab.com/metromail2/images/twitter.gif" width="19" height="16" alt="Twitter" border="0" style="display: block;"></font></a>
										</td><td width="29" align="right" style="line-height: 19px;">
											<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
											<font face="Arial, Helvetica, sans-serif" size="2" color="#596167">
											<img src="http://artloglab.com/metromail2/images/dribbble.gif" width="19" height="19" alt="Dribbble" border="0" style="display: block;"></font></a>
										</td></tr>
									</tbody></table>
									</div>
									<!--social END-->
								</td></tr>
							</tbody></table>
						</td></tr>
					</tbody></table></div><!-- Item END--></td>
			</tr>
		</tbody></table>
		<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
	</td></tr>
	<!--header END-->

	<!--content 1 -->
	<tr><td align="center" bgcolor="#ffffff">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tbody><tr><td align="center">
				<!-- padding --><div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
				<div style="line-height: 44px;">
					<font face="Arial, Helvetica, sans-serif" size="5" color="#57697e" style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
						'.$notification.'
					</span></font>
				</div>
				<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
			</td></tr>
			<tr><td align="center">
				<div style="line-height: 30px;">
					<font face="Arial, Helvetica, sans-serif" size="5" color="#4db3a4" style="font-size: 17px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; color: #4db3a4;">
						Hi, <?php echo $name; ?>
					</span></font>
				</div>
				<!-- padding --><div style="height: 35px; line-height: 35px; font-size: 10px;">&nbsp;</div>
			</td></tr>
			<tr><td align="center">
						<table width="80%" align="center" border="0" cellspacing="0" cellpadding="0">
							<tbody><tr><td align="center">
								<div style="line-height: 24px;">
									<font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 16px;">
									<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
										'.$message.'
									</span></font>
								</div>
							</td></tr>
						</tbody></table>
				<!-- padding --><div style="height: 45px; line-height: 45px; font-size: 10px;">&nbsp;</div>
			</td></tr>
			<!--<tr><td align="center">
				<div style="line-height:24px;">
					<a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
						<font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
							<img src="http://artloglab.com/metromail2/images/confirm-reg.gif" width="225" height="43" alt="CONFIRM REGISTRATION" border="0" style="display: block;"></font></a>
				</div>
				<div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
			</td></tr>-->
		</tbody></table>		
	</td></tr>
	<!--content 1 END-->

	<!--links -->
	<tr><td align="center" bgcolor="#f9fafc">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody><tr><td align="center">
				<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
        <table width="80%" align="center" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td align="center" valign="middle" style="font-size: 12px; line-height:22px;">
            	<font face="Tahoma, Arial, Helvetica, sans-serif" size="2" color="#282f37" style="font-size: 12px;">
								<span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #5b9bd1;">
		              <a href="#" target="_blank" style="color: #5b9bd1; text-decoration: none;">GENERAL QUESTIONS</a>
		              &nbsp;&nbsp;&nbsp;&nbsp;<img src="http://artloglab.com/metromail2/images/dot.gif" alt="|" width="6" height="9" class="mob_display_none">&nbsp;&nbsp;&nbsp;&nbsp;
		              <a href="#" target="_blank" style="color: #5b9bd1; text-decoration: none;">TERMS &amp; CONDITIONS</a>
		              &nbsp;&nbsp;&nbsp;&nbsp;<img src="http://artloglab.com/metromail2/images/dot.gif" alt="|" width="6" height="9" class="mob_display_none">&nbsp;&nbsp;&nbsp;&nbsp;
		              <a href="#" target="_blank" style="color: #5b9bd1; text-decoration: none;">UNSUBSCRIBE EMAIL</a>
              </span></font>
            </td>
          </tr>                                        
        </tbody></table>
			</td></tr>
			<tr><td><!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div></td></tr>
		</tbody></table>		
	</td></tr>
	<!--links END-->

	<!--footer -->
	<tr><td class="iage_footer" align="center" bgcolor="#eff3f8">
		<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>	
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody><tr><td align="center">
				<font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
					2015 © Metronic. ALL Rights Reserved.
				</span></font>				
			</td></tr>			
		</tbody></table>
		
		<!-- padding --><div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>	
	</td></tr>
	<!--footer END-->
</tbody></table>
<!--[if gte mso 10]>
</td></tr>
</table>
<![endif]-->
 
</td></tr>
</tbody></table>
			
</div> 
</body></html>
';

		//to send email
 		//$this->out(print_r($c['email'],true));
		$to = $c['email'];
		$subject = 'About late arrival at office';
		$from = 'me@example.com';
		$site = 'My Site';
		//$this->out($to);
		$Email = new CakeEmail('gmail');
		$Email->from(array($from => $site))
		->to($to)
		->subject($subject)
		->send($body);


		 	}
		 }
		
	}

} 
?>