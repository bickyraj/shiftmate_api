<div class="multiplypaymentfactortypes form">
<?php echo $this->Form->create('Multiplypaymentfactortype'); ?>
	<fieldset>
		<legend><?php echo __('Add Multiplypaymentfactortype'); ?></legend>
	<?php
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Multiplypaymentfactortypes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Multiply Payment Factors'), array('controller' => 'multiply_payment_factors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Multiply Payment Factor'), array('controller' => 'multiply_payment_factors', 'action' => 'add')); ?> </li>
	</ul>
</div>
