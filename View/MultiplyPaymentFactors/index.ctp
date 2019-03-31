<div class="multiplyPaymentFactors index">
	<h2><?php echo __('Multiply Payment Factors'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('multiplypaymentfactortype_id'); ?></th>
			<th><?php echo $this->Paginator->sort('multiply_factor'); ?></th>
			<th><?php echo $this->Paginator->sort('implement_date'); ?></th>
			<th><?php echo $this->Paginator->sort('end_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($multiplyPaymentFactors as $multiplyPaymentFactor): ?>
	<tr>
		<td><?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($multiplyPaymentFactor['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $multiplyPaymentFactor['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($multiplyPaymentFactor['Multiplypaymentfactortype']['title'], array('controller' => 'multiplypaymentfactortypes', 'action' => 'view', $multiplyPaymentFactor['Multiplypaymentfactortype']['id'])); ?>
		</td>
		<td><?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['multiply_factor']); ?>&nbsp;</td>
		<td><?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['implement_date']); ?>&nbsp;</td>
		<td><?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['end_date']); ?>&nbsp;</td>
		<td><?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $multiplyPaymentFactor['MultiplyPaymentFactor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $multiplyPaymentFactor['MultiplyPaymentFactor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $multiplyPaymentFactor['MultiplyPaymentFactor']['id']), array(), __('Are you sure you want to delete # %s?', $multiplyPaymentFactor['MultiplyPaymentFactor']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
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
		<li><?php echo $this->Html->link(__('New Multiply Payment Factor'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Multiplypaymentfactortypes'), array('controller' => 'multiplypaymentfactortypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiplypaymentfactortype'), array('controller' => 'multiplypaymentfactortypes', 'action' => 'add')); ?> </li>
	</ul>
</div>
