<div class="shifts view">
<h2><?php echo __('Shift'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shift['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $shift['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Starttime'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['starttime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endtime'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['endtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($shift['Shift']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shift'), array('action' => 'edit', $shift['Shift']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shift'), array('action' => 'delete', $shift['Shift']['id']), null, __('Are you sure you want to delete # %s?', $shift['Shift']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shifts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Boards'), array('controller' => 'shift_boards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift Board'), array('controller' => 'shift_boards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Users'), array('controller' => 'shift_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift User'), array('controller' => 'shift_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Shift Boards'); ?></h3>
	<?php if (!empty($shift['ShiftBoard'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('Shift Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shift['ShiftBoard'] as $shiftBoard): ?>
		<tr>
			<td><?php echo $shiftBoard['id']; ?></td>
			<td><?php echo $shiftBoard['board_id']; ?></td>
			<td><?php echo $shiftBoard['shift_id']; ?></td>
			<td><?php echo $shiftBoard['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shift_boards', 'action' => 'view', $shiftBoard['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shift_boards', 'action' => 'edit', $shiftBoard['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shift_boards', 'action' => 'delete', $shiftBoard['id']), null, __('Are you sure you want to delete # %s?', $shiftBoard['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shift Board'), array('controller' => 'shift_boards', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Shift Users'); ?></h3>
	<?php if (!empty($shift['ShiftUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('Shift Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shift['ShiftUser'] as $shiftUser): ?>
		<tr>
			<td><?php echo $shiftUser['id']; ?></td>
			<td><?php echo $shiftUser['board_id']; ?></td>
			<td><?php echo $shiftUser['shift_id']; ?></td>
			<td><?php echo $shiftUser['user_id']; ?></td>
			<td><?php echo $shiftUser['date']; ?></td>
			<td><?php echo $shiftUser['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shift_users', 'action' => 'view', $shiftUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shift_users', 'action' => 'edit', $shiftUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shift_users', 'action' => 'delete', $shiftUser['id']), null, __('Are you sure you want to delete # %s?', $shiftUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shift User'), array('controller' => 'shift_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Userleaves'); ?></h3>
	<?php if (!empty($shift['Userleave'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('Shift Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shift['Userleave'] as $userleave): ?>
		<tr>
			<td><?php echo $userleave['id']; ?></td>
			<td><?php echo $userleave['user_id']; ?></td>
			<td><?php echo $userleave['organization_id']; ?></td>
			<td><?php echo $userleave['board_id']; ?></td>
			<td><?php echo $userleave['shift_id']; ?></td>
			<td><?php echo $userleave['date']; ?></td>
			<td><?php echo $userleave['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'userleaves', 'action' => 'view', $userleave['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'userleaves', 'action' => 'edit', $userleave['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'userleaves', 'action' => 'delete', $userleave['id']), null, __('Are you sure you want to delete # %s?', $userleave['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
