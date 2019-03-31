<div class="countries view">
<h2><?php echo __('Country'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($country['Country']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($country['Country']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($country['Country']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Country'), array('action' => 'edit', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Country'), array('action' => 'delete', $country['Country']['id']), null, __('Are you sure you want to delete # %s?', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Branches'); ?></h3>
	<?php if (!empty($country['Branch'])): ?>
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
	<?php foreach ($country['Branch'] as $branch): ?>
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
	<h3><?php echo __('Related Cities'); ?></h3>
	<?php if (!empty($country['City'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($country['City'] as $city): ?>
		<tr>
			<td><?php echo $city['id']; ?></td>
			<td><?php echo $city['country_id']; ?></td>
			<td><?php echo $city['title']; ?></td>
			<td><?php echo $city['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cities', 'action' => 'delete', $city['id']), null, __('Are you sure you want to delete # %s?', $city['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Organizations'); ?></h3>
	<?php if (!empty($country['Organization'])): ?>
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
	<?php foreach ($country['Organization'] as $organization): ?>
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
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($country['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Roles Id'); ?></th>
		<th><?php echo __('Fname'); ?></th>
		<th><?php echo __('Lname'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Dob'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zipcode'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Lastlogin'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($country['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['roles_id']; ?></td>
			<td><?php echo $user['fname']; ?></td>
			<td><?php echo $user['lname']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['dob']; ?></td>
			<td><?php echo $user['address']; ?></td>
			<td><?php echo $user['phone']; ?></td>
			<td><?php echo $user['city_id']; ?></td>
			<td><?php echo $user['state']; ?></td>
			<td><?php echo $user['zipcode']; ?></td>
			<td><?php echo $user['country_id']; ?></td>
			<td><?php echo $user['lastlogin']; ?></td>
			<td><?php echo $user['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
