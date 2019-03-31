<div class="shiftBoards form">
<?php echo $this->Form->create('ShiftBoard'); ?>
	<fieldset>
		<legend><?php echo __('Edit Shift Board'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('board_id');
		echo $this->Form->input('shift_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ShiftBoard.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ShiftBoard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Shift Boards'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
