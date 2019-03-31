<div class="branches view">
<h2><?php echo __('Branch'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($branch['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $branch['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($branch['User']['id'], array('controller' => 'users', 'action' => 'view', $branch['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($branch['City']['title'], array('controller' => 'cities', 'action' => 'view', $branch['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($branch['Country']['title'], array('controller' => 'countries', 'action' => 'view', $branch['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Branch'), array('action' => 'edit', $branch['Branch']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Branch'), array('action' => 'delete', $branch['Branch']['id']), null, __('Are you sure you want to delete # %s?', $branch['Branch']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('controller' => 'organization_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationfunctions'), array('controller' => 'organizationfunctions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationfunction'), array('controller' => 'organizationfunctions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Boards'); ?></h3>
	<?php if (!empty($branch['Board'])): ?>
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
	<?php foreach ($branch['Board'] as $board): ?>
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
	<h3><?php echo __('Related Organization Users'); ?></h3>
	<?php if (!empty($branch['OrganizationUser'])): ?>
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
	<?php foreach ($branch['OrganizationUser'] as $organizationUser): ?>
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
	<?php if (!empty($branch['Organizationfunction'])): ?>
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
	<?php foreach ($branch['Organizationfunction'] as $organizationfunction): ?>
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
