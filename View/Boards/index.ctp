<div class="boards index">
	<h2><?php echo __('Boards'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('branch_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($boards as $board): ?>
	<tr>
		<td><?php echo h($board['Board']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($board['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $board['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($board['User']['id'], array('controller' => 'users', 'action' => 'view', $board['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($board['Branch']['id'], array('controller' => 'branches', 'action' => 'view', $board['Branch']['id'])); ?>
		</td>
		<td><?php echo h($board['Board']['title']); ?>&nbsp;</td>
		<td><?php echo h($board['Board']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $board['Board']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $board['Board']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $board['Board']['id']), null, __('Are you sure you want to delete # %s?', $board['Board']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Board'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Users'), array('controller' => 'board_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board User'), array('controller' => 'board_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('controller' => 'boardmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('controller' => 'boardmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Users'), array('controller' => 'shift_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift User'), array('controller' => 'shift_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
