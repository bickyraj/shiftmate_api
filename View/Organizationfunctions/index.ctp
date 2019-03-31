<div class="organizationfunctions index">
	<h2><?php echo __('Organizationfunctions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('branch_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('note'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizationfunctions as $organizationfunction): ?>
	<tr>
		<td><?php echo h($organizationfunction['Organizationfunction']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organizationfunction['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationfunction['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organizationfunction['Branch']['id'], array('controller' => 'branches', 'action' => 'view', $organizationfunction['Branch']['id'])); ?>
		</td>
		<td><?php echo h($organizationfunction['Organizationfunction']['date']); ?>&nbsp;</td>
		<td><?php echo h($organizationfunction['Organizationfunction']['note']); ?>&nbsp;</td>
		<td><?php echo h($organizationfunction['Organizationfunction']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organizationfunction['Organizationfunction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organizationfunction['Organizationfunction']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organizationfunction['Organizationfunction']['id']), null, __('Are you sure you want to delete # %s?', $organizationfunction['Organizationfunction']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Organizationfunction'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
	</ul>
</div>
