<div class="shiftUsers view">
<h2><?php echo __('Shift User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shiftUser['ShiftUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shiftUser['Board']['title'], array('controller' => 'boards', 'action' => 'view', $shiftUser['Board']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shiftUser['Shift']['title'], array('controller' => 'shifts', 'action' => 'view', $shiftUser['Shift']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shiftUser['User']['id'], array('controller' => 'users', 'action' => 'view', $shiftUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($shiftUser['ShiftUser']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($shiftUser['ShiftUser']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shift User'), array('action' => 'edit', $shiftUser['ShiftUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shift User'), array('action' => 'delete', $shiftUser['ShiftUser']['id']), null, __('Are you sure you want to delete # %s?', $shiftUser['ShiftUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
