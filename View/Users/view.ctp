<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Roles'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Roles']['title'], array('controller' => 'roles', 'action' => 'view', $user['Roles']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fname'); ?></dt>
		<dd>
			<?php echo h($user['User']['fname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lname'); ?></dt>
		<dd>
			<?php echo h($user['User']['lname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dob'); ?></dt>
		<dd>
			<?php echo h($user['User']['dob']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['City']['title'], array('controller' => 'cities', 'action' => 'view', $user['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($user['User']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zipcode'); ?></dt>
		<dd>
			<?php echo h($user['User']['zipcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Country']['title'], array('controller' => 'countries', 'action' => 'view', $user['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastlogin'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastlogin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Roles'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('controller' => 'boardmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('controller' => 'boardmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Useravailabilities'), array('controller' => 'organization_useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('controller' => 'organization_useravailabilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationmessages'), array('controller' => 'organizationmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationmessage'), array('controller' => 'organizationmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Groups'), array('controller' => 'user_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Group'), array('controller' => 'user_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Boardmessages'); ?></h3>
	<?php if (!empty($user['Boardmessage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Boardmessage'] as $boardmessage): ?>
		<tr>
			<td><?php echo $boardmessage['id']; ?></td>
			<td><?php echo $boardmessage['board_id']; ?></td>
			<td><?php echo $boardmessage['user_id']; ?></td>
			<td><?php echo $boardmessage['text']; ?></td>
			<td><?php echo $boardmessage['date']; ?></td>
			<td><?php echo $boardmessage['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'boardmessages', 'action' => 'view', $boardmessage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'boardmessages', 'action' => 'edit', $boardmessage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'boardmessages', 'action' => 'delete', $boardmessage['id']), null, __('Are you sure you want to delete # %s?', $boardmessage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Boardmessage'), array('controller' => 'boardmessages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Boards'); ?></h3>
	<?php if (!empty($user['Board'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Branch Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Board'] as $board): ?>
		<tr>
			<td><?php echo $board['id']; ?></td>
			<td><?php echo $board['organization_id']; ?></td>
			<td><?php echo $board['user_id']; ?></td>
			<td><?php echo $board['branch_id']; ?></td>
			<td><?php echo $board['title']; ?></td>
			<td><?php echo $board['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'boards', 'action' => 'view', $board['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'boards', 'action' => 'edit', $board['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'boards', 'action' => 'delete', $board['id']), null, __('Are you sure you want to delete # %s?', $board['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Branches'); ?></h3>
	<?php if (!empty($user['Branch'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Lat'); ?></th>
		<th><?php echo __('Long'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Branch'] as $branch): ?>
		<tr>
			<td><?php echo $branch['id']; ?></td>
			<td><?php echo $branch['organization_id']; ?></td>
			<td><?php echo $branch['user_id']; ?></td>
			<td><?php echo $branch['phone']; ?></td>
			<td><?php echo $branch['fax']; ?></td>
			<td><?php echo $branch['email']; ?></td>
			<td><?php echo $branch['address']; ?></td>
			<td><?php echo $branch['city_id']; ?></td>
			<td><?php echo $branch['country_id']; ?></td>
			<td><?php echo $branch['lat']; ?></td>
			<td><?php echo $branch['long']; ?></td>
			<td><?php echo $branch['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'branches', 'action' => 'view', $branch['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'branches', 'action' => 'edit', $branch['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'branches', 'action' => 'delete', $branch['id']), null, __('Are you sure you want to delete # %s?', $branch['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organization Useravailabilities'); ?></h3>
	<?php if (!empty($user['OrganizationUseravailability'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Useravailability Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['OrganizationUseravailability'] as $organizationUseravailability): ?>
		<tr>
			<td><?php echo $organizationUseravailability['id']; ?></td>
			<td><?php echo $organizationUseravailability['organization_id']; ?></td>
			<td><?php echo $organizationUseravailability['user_id']; ?></td>
			<td><?php echo $organizationUseravailability['useravailability_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organization_useravailabilities', 'action' => 'view', $organizationUseravailability['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organization_useravailabilities', 'action' => 'edit', $organizationUseravailability['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organization_useravailabilities', 'action' => 'delete', $organizationUseravailability['id']), null, __('Are you sure you want to delete # %s?', $organizationUseravailability['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('controller' => 'organization_useravailabilities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organizationmessages'); ?></h3>
	<?php if (!empty($user['Organizationmessage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Organizationmessage'] as $organizationmessage): ?>
		<tr>
			<td><?php echo $organizationmessage['id']; ?></td>
			<td><?php echo $organizationmessage['organization_id']; ?></td>
			<td><?php echo $organizationmessage['user_id']; ?></td>
			<td><?php echo $organizationmessage['text']; ?></td>
			<td><?php echo $organizationmessage['date']; ?></td>
			<td><?php echo $organizationmessage['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organizationmessages', 'action' => 'view', $organizationmessage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organizationmessages', 'action' => 'edit', $organizationmessage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organizationmessages', 'action' => 'delete', $organizationmessage['id']), null, __('Are you sure you want to delete # %s?', $organizationmessage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organizationmessage'), array('controller' => 'organizationmessages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organizations'); ?></h3>
	<?php if (!empty($user['Organization'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Logo'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Lat'); ?></th>
		<th><?php echo __('Long'); ?></th>
		<th><?php echo __('Day Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Organization'] as $organization): ?>
		<tr>
			<td><?php echo $organization['id']; ?></td>
			<td><?php echo $organization['user_id']; ?></td>
			<td><?php echo $organization['title']; ?></td>
			<td><?php echo $organization['logo']; ?></td>
			<td><?php echo $organization['address']; ?></td>
			<td><?php echo $organization['email']; ?></td>
			<td><?php echo $organization['phone']; ?></td>
			<td><?php echo $organization['fax']; ?></td>
			<td><?php echo $organization['website']; ?></td>
			<td><?php echo $organization['city_id']; ?></td>
			<td><?php echo $organization['country_id']; ?></td>
			<td><?php echo $organization['lat']; ?></td>
			<td><?php echo $organization['long']; ?></td>
			<td><?php echo $organization['day_id']; ?></td>
			<td><?php echo $organization['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organizations', 'action' => 'view', $organization['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organizations', 'action' => 'edit', $organization['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organizations', 'action' => 'delete', $organization['id']), null, __('Are you sure you want to delete # %s?', $organization['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Groups'); ?></h3>
	<?php if (!empty($user['UserGroup'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserGroup'] as $userGroup): ?>
		<tr>
			<td><?php echo $userGroup['id']; ?></td>
			<td><?php echo $userGroup['user_id']; ?></td>
			<td><?php echo $userGroup['group_id']; ?></td>
			<td><?php echo $userGroup['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_groups', 'action' => 'view', $userGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_groups', 'action' => 'edit', $userGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_groups', 'action' => 'delete', $userGroup['id']), null, __('Are you sure you want to delete # %s?', $userGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Group'), array('controller' => 'user_groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Useravailabilities'); ?></h3>
	<?php if (!empty($user['Useravailability'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Day Id'); ?></th>
		<th><?php echo __('Starttime'); ?></th>
		<th><?php echo __('Endtime'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Useravailability'] as $useravailability): ?>
		<tr>
			<td><?php echo $useravailability['id']; ?></td>
			<td><?php echo $useravailability['user_id']; ?></td>
			<td><?php echo $useravailability['day_id']; ?></td>
			<td><?php echo $useravailability['starttime']; ?></td>
			<td><?php echo $useravailability['endtime']; ?></td>
			<td><?php echo $useravailability['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'useravailabilities', 'action' => 'view', $useravailability['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'useravailabilities', 'action' => 'edit', $useravailability['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'useravailabilities', 'action' => 'delete', $useravailability['id']), null, __('Are you sure you want to delete # %s?', $useravailability['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Userleaves'); ?></h3>
	<?php if (!empty($user['Userleave'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('Shift Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Userleave'] as $userleave): ?>
		<tr>
			<td><?php echo $userleave['id']; ?></td>
			<td><?php echo $userleave['user_id']; ?></td>
			<td><?php echo $userleave['organization_id']; ?></td>
			<td><?php echo $userleave['board_id']; ?></td>
			<td><?php echo $userleave['shift_id']; ?></td>
			<td><?php echo $userleave['date']; ?></td>
			<td><?php echo $userleave['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'userleaves', 'action' => 'view', $userleave['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'userleaves', 'action' => 'edit', $userleave['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'userleaves', 'action' => 'delete', $userleave['id']), null, __('Are you sure you want to delete # %s?', $userleave['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
