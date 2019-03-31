<div class="organizations form">
<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend><?php echo __('Edit Organization'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('logo');
		echo $this->Form->input('address');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('fax');
		echo $this->Form->input('website');
		echo $this->Form->input('city_id');
		echo $this->Form->input('country_id');
		echo $this->Form->input('lat');
		echo $this->Form->input('long');
		echo $this->Form->input('day_id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Organization.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Organization.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Days'), array('controller' => 'days', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day'), array('controller' => 'days', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Useravailabilities'), array('controller' => 'organization_useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('controller' => 'organization_useravailabilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Users'), array('controller' => 'organization_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization User'), array('controller' => 'organization_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationfunctions'), array('controller' => 'organizationfunctions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationfunction'), array('controller' => 'organizationfunctions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationmessages'), array('controller' => 'organizationmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationmessage'), array('controller' => 'organizationmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationroles'), array('controller' => 'organizationroles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationrole'), array('controller' => 'organizationroles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('controller' => 'shifts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('controller' => 'shifts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
