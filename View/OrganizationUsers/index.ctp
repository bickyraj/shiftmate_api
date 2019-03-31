<div class="organizationUsers index">
	<h2><?php echo __('Organization Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('branch_id'); ?></th>
			<th><?php echo $this->Paginator->sort('organizationrole_id'); ?></th>
			<th><?php echo $this->Paginator->sort('designation'); ?></th>
			<th><?php echo $this->Paginator->sort('hire_date'); ?></th>
			<th><?php echo $this->Paginator->sort('wage'); ?></th>
			<th><?php echo $this->Paginator->sort('max_weekly_hour'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizationUsers as $organizationUser): ?>
	<tr>
		<td><?php echo h($organizationUser['OrganizationUser']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organizationUser['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationUser['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationUser['User']['id'], array('controller' => 'users', 'action' => 'view', $organizationUser['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationUser['Branch']['id'], array('controller' => 'branches', 'action' => 'view', $organizationUser['Branch']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationUser['Organizationrole']['title'], array('controller' => 'organizationroles', 'action' => 'view', $organizationUser['Organizationrole']['id'])); ?>
		</td>
		<td><?php echo h($organizationUser['OrganizationUser']['designation']); ?>&nbsp;</td>
		<td><?php echo h($organizationUser['OrganizationUser']['hire_date']); ?>&nbsp;</td>
		<td><?php echo h($organizationUser['OrganizationUser']['wage']); ?>&nbsp;</td>
		<td><?php echo h($organizationUser['OrganizationUser']['max_weekly_hour']); ?>&nbsp;</td>
		<td><?php echo h($organizationUser['OrganizationUser']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organizationUser['OrganizationUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organizationUser['OrganizationUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organizationUser['OrganizationUser']['id']), null, __('Are you sure you want to delete # %s?', $organizationUser['OrganizationUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Organization User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationroles'), array('controller' => 'organizationroles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationrole'), array('controller' => 'organizationroles', 'action' => 'add')); ?> </li>
	</ul>
</div>
