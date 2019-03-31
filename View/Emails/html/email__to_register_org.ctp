
Hi <?php echo $userinfo['User']['username']; ?><br>

Click the given link for activation:<br>
<a href="<?php echo URL_VIEW; ?>organizations/activateOrg?<?php echo base64_encode('userid'); ?>=<?php echo base64_encode($userinfo['User']['id']); ?>&<?php echo base64_encode('roleid'); ?>=<?php echo base64_encode($userinfo['User']['role_id']); ?>&<?php echo base64_encode('random_activation'); ?>=<?php echo base64_encode($userinfo['User']['random_activation']);  ?>">Click Here</a><br>
or copy following link and paste in browser:<br>
<?php echo URL_VIEW; ?>organizations/activateOrg?<?php echo base64_encode('userid'); ?>=<?php echo base64_encode($userinfo['User']['id']); ?>&<?php echo base64_encode('roleid'); ?>=<?php echo base64_encode($userinfo['User']['role_id']); ?>&<?php echo base64_encode('random_activation'); ?>=<?php echo base64_encode($userinfo['User']['random_activation']);  ?>
