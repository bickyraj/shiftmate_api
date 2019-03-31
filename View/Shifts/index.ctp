<div class="shifts index">
	<h2><?php echo __('Shifts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('starttime'); ?></th>
			<th><?php echo $this->Paginator->sort('endtime'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shifts as $shift): ?>
	<tr>
		<td><?php echo h($shift['Shift']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($shift['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $shift['Organization']['id'])); ?>
		</td>
		<td><?php echo h($shift['Shift']['title']); ?>&nbsp;</td>
		<td><?php echo h($shift['Shift']['starttime']); ?>&nbsp;</td>
		<td><?php echo h($shift['Shift']['endtime']); ?>&nbsp;</td>
		<td><?php echo h($shift['Shift']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shift['Shift']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $shift['Shift']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $shift['Shift']['id']), null, __('Are you sure you want to delete # %s?', $shift['Shift']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Shift'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Boards'), array('controller' => 'shift_boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift Board'), array('controller' => 'shift_boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Users'), array('controller' => 'shift_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift User'), array('controller' => 'shift_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
