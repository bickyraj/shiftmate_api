<div class="organizations index">
	<h2><?php echo __('Organizations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('logo'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th><?php echo $this->Paginator->sort('website'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lat'); ?></th>
			<th><?php echo $this->Paginator->sort('long'); ?></th>
			<th><?php echo $this->Paginator->sort('day_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizations as $organization): ?>
	<tr>
		<td><?php echo h($organization['Organization']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organization['User']['id'], array('controller' => 'users', 'action' => 'view', $organization['User']['id'])); ?>
		</td>
		<td><?php echo h($organization['Organization']['title']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['logo']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['address']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['email']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['phone']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['fax']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['website']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organization['City']['title'], array('controller' => 'cities', 'action' => 'view', $organization['City']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($organization['Country']['title'], array('controller' => 'countries', 'action' => 'view', $organization['Country']['id'])); ?>
		</td>
		<td><?php echo h($organization['Organization']['lat']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['long']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($organization['Day']['title'], array('controller' => 'days', 'action' => 'view', $organization['Day']['id'])); ?>
		</td>
		<td><?php echo h($organization['Organization']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organization['Organization']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organization['Organization']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organization['Organization']['id']), null, __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Organization'), array('action' => 'add')); ?></li>
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
