<div class="userleaves index">
	<h2><?php echo __('Userleaves'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('board_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userleaves as $userleave): ?>
	<tr>
		<td><?php echo h($userleave['Userleave']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userleave['User']['id'], array('controller' => 'users', 'action' => 'view', $userleave['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userleave['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $userleave['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userleave['Board']['title'], array('controller' => 'boards', 'action' => 'view', $userleave['Board']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userleave['Shift']['title'], array('controller' => 'shifts', 'action' => 'view', $userleave['Shift']['id'])); ?>
		</td>
		<td><?php echo h($userleave['Userleave']['date']); ?>&nbsp;</td>
		<td><?php echo h($userleave['Userleave']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userleave['Userleave']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userleave['Userleave']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userleave['Userleave']['id']), null, __('Are you sure you want to delete # %s?', $userleave['Userleave']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Userleave'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
