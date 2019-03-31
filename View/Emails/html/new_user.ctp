
Hi <?php echo $userinfo['User']['fname'].' '.$userinfo['User']['lname']; ?><br>


You have been assigned in <?php echo $userinfo['OrganizationUser']['0']['Organization']['title']; ?>,Click the given link for activation:<br>

<?php foreach ($userinfo['OrganizationUser'] as $userOrg) {
	if($userOrg['organization_id'] == $orgId)
	{
?>

<a href="<?php echo URL_VIEW; ?>users/orgRegisterActivation?<?php echo base64_encode('orgUserId'); ?>=<?php echo base64_encode($userOrg['id']); ?>&<?php echo base64_encode('userId'); ?>=<?php echo base64_encode($userOrg['user_id']); ?>">Click Here</a><br>
or copy following link and paste in browser:<br>
<?php echo URL_VIEW; ?>users/orgRegisterActivation?<?php echo base64_encode('orgUserId'); ?>=<?php echo base64_encode($userOrg['id']); ?>&<?php echo base64_encode('userId'); ?>=<?php echo base64_encode($userOrg['user_id']); ?><br>
your pin number is: <br>
<?php echo $userOrg['pin_number']; ?><br>
your password is: <br>
<?php echo $password; ?><br>
<?php		
	}
	else{
?>
	<h5>Something Went Wrong</h5>
<?php
	}
} ?>




