Dear Sir/Madam,
 	<?php foreach ($userinfo['OrganizationUser'] as $orgUser) { ?>
	 You have been assigned by <?php echo $orgUser['Organization']['title']; ?> Company,<br/>
	Click the given link for activation:<br/>
	<a href="<?php echo URL_VIEW; ?>employees/registerByEmail?<?php echo base64_encode('orgUserId'); ?>=<?php echo base64_encode($orgUser['id']); ?>&<?php echo base64_encode('userId'); ?>=<?php echo base64_encode($orgUser['user_id']); ?>">Click Here</a><br>
or copy following link and paste in browser:<br>
	<?php echo URL_VIEW; ?>employees/registerByEmail?<?php echo base64_encode('orgUserId'); ?>=<?php echo base64_encode($orgUser['id']); ?>&<?php echo base64_encode('userId'); ?>=<?php echo base64_encode($orgUser['user_id']); ?>
	<?php } ?>