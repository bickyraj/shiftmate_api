<div class="organizationUsers view">
<h2><?php echo __('Organization User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizationUser['OrganizationUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUser['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationUser['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUser['User']['id'], array('controller' => 'users', 'action' => 'view', $organizationUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Branch'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUser['Branch']['id'], array('controller' => 'branches', 'action' => 'view', $organizationUser['Branch']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organizationrole'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationUser['Organizationrole']['title'], array('controller' => 'organizationroles', 'action' => 'view', $organizationUser['Organizationrole']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Designation'); ?></dt>
		<dd>
			<?php echo h($organizationUser['OrganizationUser']['designation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hire Date'); ?></dt>
		<dd>
			<?php echo h($organizationUser['OrganizationUser']['hire_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wage'); ?></dt>
		<dd>
			<?php echo h($organizationUser['OrganizationUser']['wage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Weekly Hour'); ?></dt>
		<dd>
			<?php echo h($organizationUser['OrganizationUser']['max_weekly_hour']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($organizationUser['OrganizationUser']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organization User'), array('action' => 'edit', $organizationUser['OrganizationUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organization User'), array('action' => 'delete', $organizationUser['OrganizationUser']['id']), null, __('Are you sure you want to delete # %s?', $organizationUser['OrganizationUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationroles'), array('controller' => 'organizationroles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationrole'), array('controller' => 'organizationroles', 'action' => 'add')); ?> </li>
	</ul>
</div>
