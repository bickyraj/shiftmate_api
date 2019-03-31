<div class="organizationUseravailabilities index">
	<h2><?php echo __('Organization Useravailabilities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('useravailability_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizationUseravailabilities as $organizationUseravailability): ?>
	<tr>
		<td><?php echo h($organizationUseravailability['OrganizationUseravailability']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organizationUseravailability['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationUseravailability['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationUseravailability['User']['id'], array('controller' => 'users', 'action' => 'view', $organizationUseravailability['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationUseravailability['Useravailability']['id'], array('controller' => 'useravailabilities', 'action' => 'view', $organizationUseravailability['Useravailability']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organizationUseravailability['OrganizationUseravailability']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organizationUseravailability['OrganizationUseravailability']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organizationUseravailability['OrganizationUseravailability']['id']), null, __('Are you sure you want to delete # %s?', $organizationUseravailability['OrganizationUseravailability']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
