<div class="shiftBoards view">
<h2><?php echo __('Shift Board'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shiftBoard['ShiftBoard']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shiftBoard['Board']['title'], array('controller' => 'boards', 'action' => 'view', $shiftBoard['Board']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shiftBoard['Shift']['title'], array('controller' => 'shifts', 'action' => 'view', $shiftBoard['Shift']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($shiftBoard['ShiftBoard']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shift Board'), array('action' => 'edit', $shiftBoard['ShiftBoard']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shift Board'), array('action' => 'delete', $shiftBoard['ShiftBoard']['id']), null, __('Are you sure you want to delete # %s?', $shiftBoard['ShiftBoard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Boards'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift Board'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
