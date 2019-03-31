<div class="days form">
<?php echo $this->Form->create('Day'); ?>
	<fieldset>
		<legend><?php echo __('Add Day'); ?></legend>
	<?php
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Days'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
