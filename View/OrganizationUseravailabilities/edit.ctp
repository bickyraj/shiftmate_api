<div class="organizationUseravailabilities form">
<?php echo $this->Form->create('OrganizationUseravailability'); ?>
	<fieldset>
		<legend><?php echo __('Edit Organization Useravailability'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('useravailability_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrganizationUseravailability.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OrganizationUseravailability.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Organization Useravailabilities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
