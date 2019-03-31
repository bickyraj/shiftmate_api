<div class="days view">
<h2><?php echo __('Day'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($day['Day']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($day['Day']['title']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Day'), array('action' => 'edit', $day['Day']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Day'), array('action' => 'delete', $day['Day']['id']), null, __('Are you sure you want to delete # %s?', $day['Day']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Days'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Day'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Useravailabilities'), array('controller' => 'useravailabilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Organizations'); ?></h3>
	<?php if (!empty($day['Organization'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Logo'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Lat'); ?></th>
		<th><?php echo __('Long'); ?></th>
		<th><?php echo __('Day Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($day['Organization'] as $organization): ?>
		<tr>
			<td><?php echo $organization['id']; ?></td>
			<td><?php echo $organization['user_id']; ?></td>
			<td><?php echo $organization['title']; ?></td>
			<td><?php echo $organization['logo']; ?></td>
			<td><?php echo $organization['address']; ?></td>
			<td><?php echo $organization['email']; ?></td>
			<td><?php echo $organization['phone']; ?></td>
			<td><?php echo $organization['fax']; ?></td>
			<td><?php echo $organization['website']; ?></td>
			<td><?php echo $organization['city_id']; ?></td>
			<td><?php echo $organization['country_id']; ?></td>
			<td><?php echo $organization['lat']; ?></td>
			<td><?php echo $organization['long']; ?></td>
			<td><?php echo $organization['day_id']; ?></td>
			<td><?php echo $organization['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'organizations', 'action' => 'view', $organization['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organizations', 'action' => 'edit', $organization['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organizations', 'action' => 'delete', $organization['id']), null, __('Are you sure you want to delete # %s?', $organization['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Useravailabilities'); ?></h3>
	<?php if (!empty($day['Useravailability'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Day Id'); ?></th>
		<th><?php echo __('Starttime'); ?></th>
		<th><?php echo __('Endtime'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($day['Useravailability'] as $useravailability): ?>
		<tr>
			<td><?php echo $useravailability['id']; ?></td>
			<td><?php echo $useravailability['user_id']; ?></td>
			<td><?php echo $useravailability['day_id']; ?></td>
			<td><?php echo $useravailability['starttime']; ?></td>
			<td><?php echo $useravailability['endtime']; ?></td>
			<td><?php echo $useravailability['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'useravailabilities', 'action' => 'view', $useravailability['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'useravailabilities', 'action' => 'edit', $useravailability['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'useravailabilities', 'action' => 'delete', $useravailability['id']), null, __('Are you sure you want to delete # %s?', $useravailability['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Useravailability'), array('controller' => 'useravailabilities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
