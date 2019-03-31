<div class="shiftBoards index">
	<h2><?php echo __('Shift Boards'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('board_id'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shiftBoards as $shiftBoard): ?>
	<tr>
		<td><?php echo h($shiftBoard['ShiftBoard']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($shiftBoard['Board']['title'], array('controller' => 'boards', 'action' => 'view', $shiftBoard['Board']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($shiftBoard['Shift']['title'], array('controller' => 'shifts', 'action' => 'view', $shiftBoard['Shift']['id'])); ?>
		</td>
		<td><?php echo h($shiftBoard['ShiftBoard']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shiftBoard['ShiftBoard']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $shiftBoard['ShiftBoard']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $shiftBoard['ShiftBoard']['id']), null, __('Are you sure you want to delete # %s?', $shiftBoard['ShiftBoard']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Shift Board'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
