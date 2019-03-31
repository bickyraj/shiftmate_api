<div class="organizations view">
<h2><?php echo __('Organization'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organization['User']['id'], array('controller' => 'users', 'action' => 'view', $organization['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['logo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organization['City']['title'], array('controller' => 'cities', 'action' => 'view', $organization['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organization['Country']['title'], array('controller' => 'countries', 'action' => 'view', $organization['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organization['Day']['title'], array('controller' => 'days', 'action' => 'view', $organization['Day']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organization'), array('action' => 'edit', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organization'), array('action' => 'delete', $organization['Organization']['id']), null, __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Days'), array('controller' => 'days', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day'), array('controller' => 'days', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Useravailabilities'), array('controller' => 'organization_useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('controller' => 'organization_useravailabilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('controller' => 'organization_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationfunctions'), array('controller' => 'organizationfunctions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationfunction'), array('controller' => 'organizationfunctions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationmessages'), array('controller' => 'organizationmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationmessage'), array('controller' => 'organizationmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationroles'), array('controller' => 'organizationroles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationrole'), array('controller' => 'organizationroles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Boards'); ?></h3>
	<?php if (!empty($organization['Board'])): ?>
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
	<?php foreach ($organization['Board'] as $board): ?>
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
	<?php if (!empty($organization['Branch'])): ?>
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
	<?php foreach ($organization['Branch'] as $branch): ?>
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
	<h3><?php echo __('Related Groups'); ?></h3>
	<?php if (!empty($organization['Group'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Group'] as $group): ?>
		<tr>
			<td><?php echo $group['id']; ?></td>
			<td><?php echo $group['organization_id']; ?></td>
			<td><?php echo $group['title']; ?></td>
			<td><?php echo $group['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, __('Are you sure you want to delete # %s?', $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organization Useravailabilities'); ?></h3>
	<?php if (!empty($organization['OrganizationUseravailability'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Useravailability Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['OrganizationUseravailability'] as $organizationUseravailability): ?>
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
	<h3><?php echo __('Related Organization Users'); ?></h3>
	<?php if (!empty($organization['OrganizationUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Branch Id'); ?></th>
		<th><?php echo __('Organizationrole Id'); ?></th>
		<th><?php echo __('Designation'); ?></th>
		<th><?php echo __('Hire Date'); ?></th>
		<th><?php echo __('Wage'); ?></th>
		<th><?php echo __('Max Weekly Hour'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['OrganizationUser'] as $organizationUser): ?>
		<tr>
			<td><?php echo $organizationUser['id']; ?></td>
			<td><?php echo $organizationUser['organization_id']; ?></td>
			<td><?php echo $organizationUser['user_id']; ?></td>
			<td><?php echo $organizationUser['branch_id']; ?></td>
			<td><?php echo $organizationUser['organizationrole_id']; ?></td>
			<td><?php echo $organizationUser['designation']; ?></td>
			<td><?php echo $organizationUser['hire_date']; ?></td>
			<td><?php echo $organizationUser['wage']; ?></td>
			<td><?php echo $organizationUser['max_weekly_hour']; ?></td>
			<td><?php echo $organizationUser['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organization_users', 'action' => 'view', $organizationUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organization_users', 'action' => 'edit', $organizationUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organization_users', 'action' => 'delete', $organizationUser['id']), null, __('Are you sure you want to delete # %s?', $organizationUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organizationfunctions'); ?></h3>
	<?php if (!empty($organization['Organizationfunction'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Branch Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Organizationfunction'] as $organizationfunction): ?>
		<tr>
			<td><?php echo $organizationfunction['id']; ?></td>
			<td><?php echo $organizationfunction['organization_id']; ?></td>
			<td><?php echo $organizationfunction['branch_id']; ?></td>
			<td><?php echo $organizationfunction['date']; ?></td>
			<td><?php echo $organizationfunction['note']; ?></td>
			<td><?php echo $organizationfunction['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organizationfunctions', 'action' => 'view', $organizationfunction['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organizationfunctions', 'action' => 'edit', $organizationfunction['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organizationfunctions', 'action' => 'delete', $organizationfunction['id']), null, __('Are you sure you want to delete # %s?', $organizationfunction['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organizationfunction'), array('controller' => 'organizationfunctions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organizationmessages'); ?></h3>
	<?php if (!empty($organization['Organizationmessage'])): ?>
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
	<?php foreach ($organization['Organizationmessage'] as $organizationmessage): ?>
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
	<h3><?php echo __('Related Organizationroles'); ?></h3>
	<?php if (!empty($organization['Organizationrole'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Organizationrole'] as $organizationrole): ?>
		<tr>
			<td><?php echo $organizationrole['id']; ?></td>
			<td><?php echo $organizationrole['organization_id']; ?></td>
			<td><?php echo $organizationrole['title']; ?></td>
			<td><?php echo $organizationrole['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organizationroles', 'action' => 'view', $organizationrole['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organizationroles', 'action' => 'edit', $organizationrole['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organizationroles', 'action' => 'delete', $organizationrole['id']), null, __('Are you sure you want to delete # %s?', $organizationrole['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organizationrole'), array('controller' => 'organizationroles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Shifts'); ?></h3>
	<?php if (!empty($organization['Shift'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Starttime'); ?></th>
		<th><?php echo __('Endtime'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Shift'] as $shift): ?>
		<tr>
			<td><?php echo $shift['id']; ?></td>
			<td><?php echo $shift['organization_id']; ?></td>
			<td><?php echo $shift['title']; ?></td>
			<td><?php echo $shift['starttime']; ?></td>
			<td><?php echo $shift['endtime']; ?></td>
			<td><?php echo $shift['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shifts', 'action' => 'view', $shift['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shifts', 'action' => 'edit', $shift['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shifts', 'action' => 'delete', $shift['id']), null, __('Are you sure you want to delete # %s?', $shift['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Userleaves'); ?></h3>
	<?php if (!empty($organization['Userleave'])): ?>
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
	<?php foreach ($organization['Userleave'] as $userleave): ?>
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
