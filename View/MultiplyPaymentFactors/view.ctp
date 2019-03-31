<div class="multiplyPaymentFactors view">
<h2><?php echo __('Multiply Payment Factor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($multiplyPaymentFactor['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $multiplyPaymentFactor['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Multiplypaymentfactortype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($multiplyPaymentFactor['Multiplypaymentfactortype']['title'], array('controller' => 'multiplypaymentfactortypes', 'action' => 'view', $multiplyPaymentFactor['Multiplypaymentfactortype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Multiply Factor'); ?></dt>
		<dd>
			<?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['multiply_factor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Implement Date'); ?></dt>
		<dd>
			<?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['implement_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($multiplyPaymentFactor['MultiplyPaymentFactor']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Multiply Payment Factor'), array('action' => 'edit', $multiplyPaymentFactor['MultiplyPaymentFactor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Multiply Payment Factor'), array('action' => 'delete', $multiplyPaymentFactor['MultiplyPaymentFactor']['id']), array(), __('Are you sure you want to delete # %s?', $multiplyPaymentFactor['MultiplyPaymentFactor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Multiply Payment Factors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiply Payment Factor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Multiplypaymentfactortypes'), array('controller' => 'multiplypaymentfactortypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiplypaymentfactortype'), array('controller' => 'multiplypaymentfactortypes', 'action' => 'add')); ?> </li>
	</ul>
</div>
