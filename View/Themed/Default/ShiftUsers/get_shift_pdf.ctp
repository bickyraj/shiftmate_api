

<table>
	<tbody>
		<tr>
			<th>Sn</th>
			<th>Organization</th>
			<th>Board</th>
			<th>Shift</th>
			<th>From</th>
			<th>To</th>
			<th>Date</th>
		</tr>

		<?php $sn=1; foreach($shiftDetails['shiftDetail'] as $shiftDetail):?>
			<tr>
				<td><?php echo $sn++;?></td>
				<td><?php echo $shiftDetail['Organization'];?></td>
				<td><?php echo $shiftDetail['Board'];?></td>
				<td><?php echo $shiftDetail['Shift'];?></td>
				<td><?php echo $shiftDetail['From'];?></td>
				<td><?php echo $shiftDetail['To'];?></td>
				<td><?php echo $shiftDetail['Date'];?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>