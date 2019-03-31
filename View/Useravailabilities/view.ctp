<div class="useravailabilities view">
<h2><?php echo __('Useravailability'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($useravailability['Useravailability']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($useravailability['User']['id'], array('controller' => 'users', 'action' => 'view', $useravailability['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day'); ?></dt>
		<dd>
			<?php echo $this->Html->link($useravailability['Day']['title'], array('controller' => 'days', 'action' => 'view', $useravailability['Day']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Starttime'); ?></dt>
		<dd>
			<?php echo h($useravailability['Useravailability']['starttime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endtime'); ?></dt>
		<dd>
			<?php echo h($useravailability['Useravailability']['endtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($useravailability['Useravailability']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Useravailability'), array('action' => 'edit', $useravailability['Useravailability']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Useravailability'), array('action' => 'delete', $useravailability['Useravailability']['id']), null, __('Are you sure you want to delete # %s?', $useravailability['Useravailability']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Days'), array('controller' => 'days', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day'), array('controller' => 'days', 'action' => 'add')); ?> </li>
	</ul>
</div>
