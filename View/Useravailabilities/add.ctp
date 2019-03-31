<div class="useravailabilities form">
<?php echo $this->Form->create('Useravailability'); ?>
	<fieldset>
		<legend><?php echo __('Add Useravailability'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('day_id');
		echo $this->Form->input('starttime');
		echo $this->Form->input('endtime');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Days'), array('controller' => 'days', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day'), array('controller' => 'days', 'action' => 'add')); ?> </li>
	</ul>
</div>
