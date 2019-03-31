

Dear <?php echo $userinfo['User']['fname'].' '.$userinfo['User']['lname']; ?>

Please Click This link to reset your password:


<?php

$query_string = base64_encode('userId=' . base64_encode($userinfo['User']['id']) . '&fname=' . base64_encode($userinfo['User']['fname']). '&lname=' . base64_encode($userinfo['User']['lname']));

?>

<a href="<?php echo URL_VIEW;?>employees/enterNewPassword?A1=<?php echo $query_string; ?>">Click Here</a><br>
or copy link below:<br>
<?php echo URL_VIEW;?>employees/enterNewPassword?A1=<?php echo $query_string;?>


