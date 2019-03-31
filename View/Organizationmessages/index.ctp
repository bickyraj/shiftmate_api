<div class="organizationmessages index">
	<h2><?php echo __('Organizationmessages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizationmessages as $organizationmessage): ?>
	<tr>
		<td><?php echo h($organizationmessage['Organizationmessage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organizationmessage['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationmessage['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationmessage['User']['id'], array('controller' => 'users', 'action' => 'view', $organizationmessage['User']['id'])); ?>
		</td>
		<td><?php echo h($organizationmessage['Organizationmessage']['text']); ?>&nbsp;</td>
		<td><?php echo h($organizationmessage['Organizationmessage']['date']); ?>&nbsp;</td>
		<td><?php echo h($organizationmessage['Organizationmessage']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organizationmessage['Organizationmessage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organizationmessage['Organizationmessage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organizationmessage['Organizationmessage']['id']), null, __('Are you sure you want to delete # %s?', $organizationmessage['Organizationmessage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Organizationmessage'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
