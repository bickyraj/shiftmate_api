<div class="useravailabilities index">
	<h2><?php echo __('Useravailabilities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('day_id'); ?></th>
			<th><?php echo $this->Paginator->sort('starttime'); ?></th>
			<th><?php echo $this->Paginator->sort('endtime'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($useravailabilities as $useravailability): ?>
	<tr>
		<td><?php echo h($useravailability['Useravailability']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($useravailability['User']['id'], array('controller' => 'users', 'action' => 'view', $useravailability['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($useravailability['Day']['title'], array('controller' => 'days', 'action' => 'view', $useravailability['Day']['id'])); ?>
		</td>
		<td><?php echo h($useravailability['Useravailability']['starttime']); ?>&nbsp;</td>
		<td><?php echo h($useravailability['Useravailability']['endtime']); ?>&nbsp;</td>
		<td><?php echo h($useravailability['Useravailability']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $useravailability['Useravailability']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $useravailability['Useravailability']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $useravailability['Useravailability']['id']), null, __('Are you sure you want to delete # %s?', $useravailability['Useravailability']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Useravailability'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Days'), array('controller' => 'days', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day'), array('controller' => 'days', 'action' => 'add')); ?> </li>
	</ul>
</div>
