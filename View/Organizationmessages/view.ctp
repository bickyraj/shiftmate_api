<div class="organizationmessages view">
<h2><?php echo __('Organizationmessage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizationmessage['Organizationmessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationmessage['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationmessage['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationmessage['User']['id'], array('controller' => 'users', 'action' => 'view', $organizationmessage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($organizationmessage['Organizationmessage']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($organizationmessage['Organizationmessage']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($organizationmessage['Organizationmessage']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organizationmessage'), array('action' => 'edit', $organizationmessage['Organizationmessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organizationmessage'), array('action' => 'delete', $organizationmessage['Organizationmessage']['id']), null, __('Are you sure you want to delete # %s?', $organizationmessage['Organizationmessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationmessages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationmessage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
