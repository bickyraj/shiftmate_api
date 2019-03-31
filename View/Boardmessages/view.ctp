<div class="boardmessages view">
<h2><?php echo __('Boardmessage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo $this->Html->link($boardmessage['Board']['title'], array('controller' => 'boards', 'action' => 'view', $boardmessage['Board']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($boardmessage['User']['id'], array('controller' => 'users', 'action' => 'view', $boardmessage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Boardmessage'), array('action' => 'edit', $boardmessage['Boardmessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Boardmessage'), array('action' => 'delete', $boardmessage['Boardmessage']['id']), null, __('Are you sure you want to delete # %s?', $boardmessage['Boardmessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
