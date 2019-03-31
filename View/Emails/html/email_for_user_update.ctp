
Hi <?php echo $OrgUserInfo['User']['fname'].' '.$OrgUserInfo['User']['lname']; ?>,<br>

Your  organization information is changed by<?php echo $OrgUserInfo['Organization']['title']; ?><br>
<table border="1">
	<tbody>
		<tr>
			<td>Username:</td>
			<td><?php echo $OrgUserInfo['User']['fname'].' '.$OrgUserInfo['User']['lname']; ?></td>
		</tr>
		<tr>
			<td>Designation</td>
			<?php if(!empty($OrgUserInfo['OrganizationUser']['designation'])){ ?>
			 	<td><?php echo $OrgUserInfo['OrganizationUser']['designation']; ?></td>
			<?php } else { ?>
				<td>Not Assigned</td>
			<?php } ?>
		</tr>
		
		<tr>
			<td>Branch</td>
			<?php if(!empty($OrgUserInfo['Branch']['title'])){ ?>
				<td><?php echo $OrgUserInfo['Branch']['title']; ?></td>
			<?php } else { ?>
				<td>Not Assigned</td>
			<?php } ?>
		</tr>
		<tr>
			<td>Group</td>
			<?php if(!empty($OrgUserInfo['Group']['title'])){ ?>
				<td><?php echo $OrgUserInfo['Group']['title']; ?></td>
			<?php } else { ?>
				<td>Not Assigned</td>
			<?php } ?>
		</tr>
		<tr>
			<td>Organization Role</td>
			<?php if(!empty($OrgUserInfo['Organizationrole']['title'])){ ?>
				<td><?php echo $OrgUserInfo['Organizationrole']['title']; ?></td>
			<?php } else { ?>
				<td>Not Assigned</td>
			<?php } ?>
		</tr>
		<tr>
			<td>Wage</td>
			<?php if(!empty($OrgUserInfo['OrganizationUser']['wage'])){ ?>
				<td><?php echo $OrgUserInfo['OrganizationUser']['wage']; ?></td>
			<?php } else { ?>
				<td>Not Assigned</td>
			<?php } ?>
		</tr>
		<tr>
			<td>Working hour</td>
			<?php if(!empty($OrgUserInfo['OrganizationUser']['max_weekly_hour'])){ ?>
				<td><?php echo $OrgUserInfo['OrganizationUser']['max_weekly_hour']; ?></td>
			<?php } else { ?>
				<td>Not Assigned</td>
			<?php } ?>
		</tr>
		<tr>
			<td>Employee Status</td>
			<td>
				<?php 
					if($OrgUserInfo['OrganizationUser']['designation']== '1'){
						echo "Permanent";
					} 
					else{
						echo "Temporary";
					}
				?>
			</td>
		</tr>
	</tbody>
</table><br>
If any issue then contact to your board manager

