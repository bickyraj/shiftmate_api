<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fname'); ?></th>
			<th><?php echo $this->Paginator->sort('lname'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('dob'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('zipcode'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lastlogin'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Role']['title'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['fname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['lname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['dob']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['address']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['phone']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['City']['title'], array('controller' => 'cities', 'action' => 'view', $user['City']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['state']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['zipcode']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Country']['title'], array('controller' => 'countries', 'action' => 'view', $user['Country']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['lastlogin']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Roles'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('controller' => 'boardmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('controller' => 'boardmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('controller' => 'boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('controller' => 'boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organization Useravailabilities'), array('controller' => 'organization_useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization Useravailability'), array('controller' => 'organization_useravailabilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationmessages'), array('controller' => 'organizationmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationmessage'), array('controller' => 'organizationmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Groups'), array('controller' => 'user_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Group'), array('controller' => 'user_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
