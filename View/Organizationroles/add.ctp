<div class="organizationroles form">
<?php echo $this->Form->create('Organizationrole'); ?>
	<fieldset>
		<legend><?php echo __('Add Organizationrole'); ?></legend>
	<?php
		echo $this->Form->input('organization_id');
		echo $this->Form->input('title');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Organizationroles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('controller' => 'organization_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
