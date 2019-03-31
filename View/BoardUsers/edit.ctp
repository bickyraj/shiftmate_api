<div class="boardUsers form">
<?php echo $this->Form->create('BoardUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Board User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('board_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BoardUser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BoardUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Board Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
