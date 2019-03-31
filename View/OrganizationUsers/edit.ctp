<div class="organizationUsers form">
<?php echo $this->Form->create('OrganizationUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Organization User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('branch_id');
		echo $this->Form->input('organizationrole_id');
		echo $this->Form->input('designation');
		echo $this->Form->input('hire_date');
		echo $this->Form->input('wage');
		echo $this->Form->input('max_weekly_hour');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrganizationUser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OrganizationUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('action' => 'index')); ?></li>
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
