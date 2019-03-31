<div class="boardmessages index">
	<h2><?php echo __('Boardmessages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('board_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($boardmessages as $boardmessage): ?>
	<tr>
		<td><?php echo h($boardmessage['Boardmessage']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($boardmessage['Board']['title'], array('controller' => 'boards', 'action' => 'view', $boardmessage['Board']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($boardmessage['User']['id'], array('controller' => 'users', 'action' => 'view', $boardmessage['User']['id'])); ?>
		</td>
		<td><?php echo h($boardmessage['Boardmessage']['text']); ?>&nbsp;</td>
		<td><?php echo h($boardmessage['Boardmessage']['date']); ?>&nbsp;</td>
		<td><?php echo h($boardmessage['Boardmessage']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $boardmessage['Boardmessage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $boardmessage['Boardmessage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $boardmessage['Boardmessage']['id']), null, __('Are you sure you want to delete # %s?', $boardmessage['Boardmessage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
