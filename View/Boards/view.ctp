<div class="boards view">
<h2><?php echo __('Board'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($board['Board']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($board['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $board['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($board['User']['id'], array('controller' => 'users', 'action' => 'view', $board['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Branch'); ?></dt>
		<dd>
			<?php echo $this->Html->link($board['Branch']['id'], array('controller' => 'branches', 'action' => 'view', $board['Branch']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($board['Board']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($board['Board']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Board'), array('action' => 'edit', $board['Board']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Board'), array('action' => 'delete', $board['Board']['id']), null, __('Are you sure you want to delete # %s?', $board['Board']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boards'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Board Users'), array('controller' => 'board_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Board User'), array('controller' => 'board_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('controller' => 'boardmessages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('controller' => 'boardmessages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Users'), array('controller' => 'shift_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift User'), array('controller' => 'shift_users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userleaves'), array('controller' => 'userleaves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userleave'), array('controller' => 'userleaves', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Board Users'); ?></h3>
	<?php if (!empty($board['BoardUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($board['BoardUser'] as $boardUser): ?>
		<tr>
			<td><?php echo $boardUser['id']; ?></td>
			<td><?php echo $boardUser['board_id']; ?></td>
			<td><?php echo $boardUser['user_id']; ?></td>
			<td><?php echo $boardUser['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'board_users', 'action' => 'view', $boardUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'board_users', 'action' => 'edit', $boardUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'board_users', 'action' => 'delete', $boardUser['id']), null, __('Are you sure you want to delete # %s?', $boardUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Board User'), array('controller' => 'board_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Boardmessages'); ?></h3>
	<?php if (!empty($board['Boardmessage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Board Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($board['Boardmessage'] as $boardmessage): ?>
		<tr>
			<td><?php echo $boardmessage['id']; ?></td>
			<td><?php echo $boardmessage['board_id']; ?></td>
			<td><?php echo $boardmessage['user_id']; ?></td>
			<td><?php echo $boardmessage['text']; ?></td>
			<td><?php echo $boardmessage['date']; ?></td>
			<td><?php echo $boardmessage['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'boardmessages', 'action' => 'view', $boardmessage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'boardmessages', 'action' => 'edit', $boardmessage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'boardmessages', 'action' => 'delete', $boardmessage['id']), null, __('Are you sure you want to delete # %s?', $boardmessage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Boardmessage'), array('controller' => 'boardmessages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Shift Users'); ?></h3>
	<?php if (!empty($board['ShiftUser'])): ?>
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
	<?php foreach ($board['ShiftUser'] as $shiftUser): ?>
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
	<?php if (!empty($board['Userleave'])): ?>
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
	<?php foreach ($board['Userleave'] as $userleave): ?>
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
