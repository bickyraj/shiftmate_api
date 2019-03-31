<div class="userleaves view">
<h2><?php echo __('Userleave'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userleave['Userleave']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userleave['User']['id'], array('controller' => 'users', 'action' => 'view', $userleave['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userleave['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $userleave['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userleave['Board']['title'], array('controller' => 'boards', 'action' => 'view', $userleave['Board']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userleave['Shift']['title'], array('controller' => 'shifts', 'action' => 'view', $userleave['Shift']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($userleave['Userleave']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($userleave['Userleave']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userleave'), array('action' => 'edit', $userleave['Userleave']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userleave'), array('action' => 'delete', $userleave['Userleave']['id']), null, __('Are you sure you want to delete # %s?', $userleave['Userleave']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
	</ul>
</div>
