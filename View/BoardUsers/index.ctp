<div class="boardUsers index">
	<h2><?php echo __('Board Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('board_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($boardUsers as $boardUser): ?>
	<tr>
		<td><?php echo h($boardUser['BoardUser']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($boardUser['Board']['title'], array('controller' => 'boards', 'action' => 'view', $boardUser['Board']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($boardUser['User']['id'], array('controller' => 'users', 'action' => 'view', $boardUser['User']['id'])); ?>
		</td>
		<td><?php echo h($boardUser['BoardUser']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $boardUser['BoardUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $boardUser['BoardUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $boardUser['BoardUser']['id']), null, __('Are you sure you want to delete # %s?', $boardUser['BoardUser']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Board User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
