<div class="branches form">
<?php echo $this->Form->create('Branch'); ?>
	<fieldset>
		<legend><?php echo __('Add Branch'); ?></legend>
	<?php
		echo $this->Form->input('organization_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('email');
		echo $this->Form->input('address');
		echo $this->Form->input('city_id');
		echo $this->Form->input('country_id');
		echo $this->Form->input('lat');
		echo $this->Form->input('long');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Branches'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('controller' => 'organization_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationfunctions'), array('controller' => 'organizationfunctions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationfunction'), array('controller' => 'organizationfunctions', 'action' => 'add')); ?> </li>
	</ul>
</div>
