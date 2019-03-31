<?php
	$userid= base64_encode('userid');
	$roleid= base64_encode('roleid');
	$random_activation= base64_encode('random_activation');
?>
<?php 
	if($userinfo['User']['fname'] || $userinfo['User']['lname']){
?>

Hi <?php echo $userinfo['User']['fname'].' '.$userinfo['User']['lname']; ?><br>
<?php
}
else{
	?>
Hi <?php echo $userinfo['User']['username']; ?><br>
<?php
}
?>
Click the given link for activation:<br>
<a href="<?php echo URL_VIEW; ?>employees/activateNewUser?<?php echo $userid; ?>=<?php echo base64_encode($userinfo['User']['id']); ?>&<?php echo $roleid; ?>=<?php echo base64_encode($userinfo['User']['role_id']); ?>&<?php echo $random_activation ?>=<?php echo base64_encode($userinfo['User']['random_activation']);  ?>">Click Here</a><br>
or copy following link and paste in browser:<br>
<?php echo URL_VIEW; ?>employees/activateNewUser?<?php echo $userid; ?>=<?php echo base64_encode($userinfo['User']['id']); ?>&<?php echo $roleid; ?>=<?php echo base64_encode($userinfo['User']['role_id']); ?>&<?php echo $random_activation ?>=<?php echo base64_encode($userinfo['User']['random_activation']);  ?>