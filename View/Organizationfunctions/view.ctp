<div class="organizationfunctions view">
<h2><?php echo __('Organizationfunction'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizationfunction['Organizationfunction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationfunction['Organization']['title'], array('controller' => 'organizations', 'action' => 'view', $organizationfunction['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Branch'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organizationfunction['Branch']['id'], array('controller' => 'branches', 'action' => 'view', $organizationfunction['Branch']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($organizationfunction['Organizationfunction']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($organizationfunction['Organizationfunction']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($organizationfunction['Organizationfunction']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organizationfunction'), array('action' => 'edit', $organizationfunction['Organizationfunction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organizationfunction'), array('action' => 'delete', $organizationfunction['Organizationfunction']['id']), null, __('Are you sure you want to delete # %s?', $organizationfunction['Organizationfunction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizationfunctions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organizationfunction'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('controller' => 'branches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('controller' => 'branches', 'action' => 'add')); ?> </li>
	</ul>
</div>
