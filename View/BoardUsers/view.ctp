<div class="boardUsers view">
<h2><?php echo __('Board User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($boardUser['BoardUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Board'); ?></dt>
		<dd>
			<?php echo $this->Html->link($boardUser['Board']['title'], array('controller' => 'boards', 'action' => 'view', $boardUser['Board']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($boardUser['User']['id'], array('controller' => 'users', 'action' => 'view', $boardUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($boardUser['BoardUser']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Board User'), array('action' => 'edit', $boardUser['BoardUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Board User'), array('action' => 'delete', $boardUser['BoardUser']['id']), null, __('Are you sure you want to delete # %s?', $boardUser['BoardUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
