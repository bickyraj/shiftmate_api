<div class="organizationroles view">
<h2><?php echo __('Organizationrole'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizationrole['Organizationrole']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationrole['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationrole['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($organizationrole['Organizationrole']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($organizationrole['Organizationrole']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organizationrole'), array('action' => 'edit', $organizationrole['Organizationrole']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organizationrole'), array('action' => 'delete', $organizationrole['Organizationrole']['id']), null, __('Are you sure you want to delete # %s?', $organizationrole['Organizationrole']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationroles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationrole'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('controller' => 'organization_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Organization Users'); ?></h3>
	<?php if (!empty($organizationrole['OrganizationUser'])): ?>
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
	<?php foreach ($organizationrole['OrganizationUser'] as $organizationUser): ?>
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
