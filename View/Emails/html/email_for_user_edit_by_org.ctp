Hi <?php echo $result['name'];?>,<br>

Your profile information is changed by <?php echo $result['organization']; ?><br>
<div class="container">
<h4>Changes Lists</h4><hr>    

  <?php if(isset($result['role']) && !empty($result['role'])): ?>
  	<dl >
  	<dt style="float: left; padding-right:10px; font-weight: 700;">Organization Role (Current) : </dt>
  	<dd><?php echo $result['role']; ?></dd>

  	<dt style="float: left; padding-right:10px; font-weight: 700;">Organization Role (Previous) : </dt>
  	<dd><?php echo $result['role_pre']; ?></dd>
  	</dl>
  <?php endif; ?>
  
  <?php if(isset($result['wage']) && !empty($result['wage'])): ?>
    <dl >
  	<dt style="float: left; padding-right:10px; font-weight: 700;">BASE HOURLY RATE (Current) : </dt>
  	<dd><?php echo $result['wage']; ?></dd>

  	<dt style="float: left; padding-right:10px; font-weight: 700;">BASE HOURLY RATE (Previous) : </dt>
  	<dd><?php echo $result['wage_pre']; ?></dd>
    </dl>
  <?php endif; ?>
  
  <?php if(isset($result['max_weekly_hour']) && !empty($result['max_weekly_hour'])): ?>
    <dl >
  	<dt style="float: left; padding-right:10px; font-weight: 700;">MAX HOURS / WEEKS (Current) : </dt>
  	<dd><?php echo $result['max_weekly_hour']; ?></dd>

  	<dt style="float: left; padding-right:10px; font-weight: 700;">MAX HOURS / WEEKS (Previous) : </dt>
  	<dd><?php echo $result['max_weekly_hour_pre']; ?></dd>
    </dl>
  <?php endif; ?>
 

  <?php if(isset($result['removed']) && !empty($result['removed'])): ?>
    <dl >
  	<?php foreach($result['removed'] as $r) { ?>
  		<?php if(!empty($r['Board'])) { ?>
	  	<dt style="float: left; padding-right:10px; font-weight: 700;">Removed From Department : </dt>
	  	<dd><?php echo $r['Board']['title'];?> </dd>

  	<?php } ?>
    <?php } ?>
    </dl>
  <?php endif; ?>

  <?php if(isset($result['addedd']) && !empty($result['added'])): ?>
    <dl >
  	<?php foreach($result['addedd'] as $r) { ?>
  		<?php if(!empty($r['Board'])) { ?>
	  	<dt style="float: left; padding-right:10px; font-weight: 700;">Added to Department : </dt>
	  	<dd><?php echo $r['Board']['title'];?> </dd>
  	<?php } } ?>
    </dl>
  <?php endif; ?>  
</div>
<hr>
If you think this change was an error, please contact the management immediately. 