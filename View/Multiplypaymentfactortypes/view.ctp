<div class="multiplypaymentfactortypes view">
<h2><?php echo __('Multiplypaymentfactortype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($multiplypaymentfactortype['Multiplypaymentfactortype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($multiplypaymentfactortype['Multiplypaymentfactortype']['title']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Multiplypaymentfactortype'), array('action' => 'edit', $multiplypaymentfactortype['Multiplypaymentfactortype']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Multiplypaymentfactortype'), array('action' => 'delete', $multiplypaymentfactortype['Multiplypaymentfactortype']['id']), array(), __('Are you sure you want to delete # %s?', $multiplypaymentfactortype['Multiplypaymentfactortype']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Multiplypaymentfactortypes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiplypaymentfactortype'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Multiply Payment Factors'), array('controller' => 'multiply_payment_factors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiply Payment Factor'), array('controller' => 'multiply_payment_factors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Multiply Payment Factors'); ?></h3>
	<?php if (!empty($multiplypaymentfactortype['MultiplyPaymentFactor'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Multiplypaymentfactortype Id'); ?></th>
		<th><?php echo __('Multiply Factor'); ?></th>
		<th><?php echo __('Implement Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($multiplypaymentfactortype['MultiplyPaymentFactor'] as $multiplyPaymentFactor): ?>
		<tr>
			<td><?php echo $multiplyPaymentFactor['id']; ?></td>
			<td><?php echo $multiplyPaymentFactor['organization_id']; ?></td>
			<td><?php echo $multiplyPaymentFactor['multiplypaymentfactortype_id']; ?></td>
			<td><?php echo $multiplyPaymentFactor['multiply_factor']; ?></td>
			<td><?php echo $multiplyPaymentFactor['implement_date']; ?></td>
			<td><?php echo $multiplyPaymentFactor['end_date']; ?></td>
			<td><?php echo $multiplyPaymentFactor['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'multiply_payment_factors', 'action' => 'view', $multiplyPaymentFactor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'multiply_payment_factors', 'action' => 'edit', $multiplyPaymentFactor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'multiply_payment_factors', 'action' => 'delete', $multiplyPaymentFactor['id']), array(), __('Are you sure you want to delete # %s?', $multiplyPaymentFactor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Multiply Payment Factor'), array('controller' => 'multiply_payment_factors', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
