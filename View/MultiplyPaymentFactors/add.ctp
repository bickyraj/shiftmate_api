<div class="multiplyPaymentFactors form">
<?php echo $this->Form->create('MultiplyPaymentFactor'); ?>
	<fieldset>
		<legend><?php echo __('Add Multiply Payment Factor'); ?></legend>
	<?php
		echo $this->Form->input('organization_id');
		echo $this->Form->input('multiplypaymentfactortype_id');
		echo $this->Form->input('multiply_factor');
		echo $this->Form->input('implement_date');
		echo $this->Form->input('end_date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Multiply Payment Factors'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Multiplypaymentfactortypes'), array('controller' => 'multiplypaymentfactortypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiplypaymentfactortype'), array('controller' => 'multiplypaymentfactortypes', 'action' => 'add')); ?> </li>
	</ul>
</div>
