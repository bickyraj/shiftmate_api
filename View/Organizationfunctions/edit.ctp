<div class="organizationfunctions form">
<?php echo $this->Form->create('Organizationfunction'); ?>
	<fieldset>
		<legend><?php echo __('Edit Organizationfunction'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('branch_id');
		echo $this->Form->input('date');
		echo $this->Form->input('note');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Organizationfunction.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Organizationfunction.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Organizationfunctions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
	</ul>
</div>
