

Hi <?php echo $userinfo['User']['fname'].' '.$userinfo['User']['lname']; ?><br>

You have been assigned in <?php echo $userinfo['Organization']['title']; ?>,Click the given link for activation: <br>
<a href="<?php echo URL_VIEW; ?>organizationUsers/activeAssignUser?<?php echo base64_encode('orgUserid'); ?>=<?php echo base64_encode($userinfo['OrganizationUser']['id']); ?>&<?php echo base64_encode('orgid'); ?>=<?php echo base64_encode($userinfo['Organization']['id']); ?>&<?php echo base64_encode('userid'); ?>=<?php echo base64_encode($userinfo['User']['id']); ?>">Click Here</a><br>
or copy following link and paste in browser:<br>
<?php echo URL_VIEW; ?>organizationUsers/activeAssignUser?<?php echo base64_encode('orgUserid'); ?>=<?php echo base64_encode($userinfo['OrganizationUser']['id']); ?>&<?php echo base64_encode('orgid'); ?>=<?php echo base64_encode($userinfo['Organization']['id']); ?>&<?php echo base64_encode('userid'); ?>=<?php echo base64_encode($userinfo['User']['id']); ?><br>
and your pin number is:<br>
<?php echo $userinfo['OrganizationUser']['pin_number']; ?>.