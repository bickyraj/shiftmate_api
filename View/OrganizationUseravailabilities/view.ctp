<div class="organizationUseravailabilities view">
<h2><?php echo __('Organization Useravailability'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizationUseravailability['OrganizationUseravailability']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUseravailability['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationUseravailability['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUseravailability['User']['id'], array('controller' => 'users', 'action' => 'view', $organizationUseravailability['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Useravailability'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUseravailability['Useravailability']['id'], array('controller' => 'useravailabilities', 'action' => 'view', $organizationUseravailability['Useravailability']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organization Useravailability'), array('action' => 'edit', $organizationUseravailability['OrganizationUseravailability']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organization Useravailability'), array('action' => 'delete', $organizationUseravailability['OrganizationUseravailability']['id']), null, __('Are you sure you want to delete # %s?', $organizationUseravailability['OrganizationUseravailability']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Useravailabilities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
