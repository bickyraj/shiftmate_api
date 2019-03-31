<div class="shifts form">
<?php echo $this->Form->create('Shift'); ?>
	<fieldset>
		<legend><?php echo __('Add Shift'); ?></legend>
	<?php
		echo $this->Form->input('organization_id');
		echo $this->Form->input('title');
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

		<li><?php echo $this->Html->link(__('List Shifts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Boards'), array('controller' => 'shift_boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift Board'), array('controller' => 'shift_boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Users'), array('controller' => 'shift_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift User'), array('controller' => 'shift_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
