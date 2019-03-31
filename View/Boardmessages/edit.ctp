<div class="boardmessages form">
<?php echo $this->Form->create('Boardmessage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Boardmessage'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('board_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('text');
		echo $this->Form->input('date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Boardmessage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Boardmessage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
