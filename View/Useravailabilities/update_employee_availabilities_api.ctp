<div class="useravailabilities form">
    <?php echo $this->Form->create('Useravailability'); ?>
   <?php //debug($datas);?>
    
    <?php foreach($availabilities as $key=>$availability):?>
         
        <select name="data[Useravailability][<?php echo $key;?>][availabilities]" id="UseravailabilityEndtimeMeridian" required="required">
                <option value="0" <?php echo ($availability['data']['status'] == 0)?"selected = 'selected'":'';?>>Available</option>
                <option value="1" <?php echo ($availability['data']['status'] == 1)?"selected = 'selected'":'';?>>Avaliable time</option>
                <option value="2" <?php echo ($availability['data']['status'] == 2)?"selected = 'selected'":'';?>>Not Avaliable</option>
        </select> <br>
    
    <?php if($availability['data']['status'] == 1){
    $i = 0;
    foreach($availability['time'] as $time):?>
         
    <select name="data[Useravailability][<?php echo $key; ?>][time][<?php echo $i;?>][starttime][hour] size="1" class="hourBox">
                <?php for ($hours = 1; $hours <= 12; $hours++) { ?>
                    <option value="<?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?>" <?php echo ($time['starttime']['hour'] == str_pad($hours, 2, '0', STR_PAD_LEFT))?"selected = 'selected'":'';?>><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>: 
            <select name="data[Useravailability][<?php echo $key; ?>][time][<?php echo $i;?>][starttime][min] size="1" class="hourBox">
                <?php for ($min = 0; $min < 60; $min+=15) { ?>
                    <option value="<?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?>" <?php echo ($time['starttime']['min'] == str_pad($min, 2, '0', STR_PAD_LEFT))?"selected = 'selected'":'';?>><?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>
            <select name="data[Useravailability][<?php echo $key; ?>][time][<?php echo $i;?>][starttime][meridian]" size="1" class="hourBox">
                <option value="am" <?php echo ($time['starttime']['meridian'] == 'am')?"selected = 'selected'":'';?>>am</option>
                <option value="pm" <?php echo ($time['starttime']['meridian'] == 'pm')?"selected = 'selected'":'';?>>pm</option>
            </select>
            <br>
            
            <select name="data[Useravailability][<?php echo $key; ?>][time][<?php echo $i;?>][endtime][hour] size="1" class="hourBox">
                <?php for ($hours = 1; $hours <= 12; $hours++) { ?>
                    <option value="<?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?>" <?php echo ($time['endtime']['hour'] == str_pad($hours, 2, '0', STR_PAD_LEFT))?"selected = 'selected'":'';?>><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>: 
            <select name="data[Useravailability][<?php echo $key; ?>][time][<?php echo $i;?>][endtime][min] size="1" class="hourBox">
                <?php for ($min = 0; $min < 60; $min+=15) { ?>
                    <option value="<?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?>" <?php echo ($time['endtime']['min'] == str_pad($min, 2, '0', STR_PAD_LEFT))?"selected = 'selected'":'';?>><?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>
            <select name="data[Useravailability][<?php echo $key; ?>][time][<?php echo $i;?>][endtime][meridian]" size="1" class="hourBox">
                <option value="am" <?php echo ($time['endtime']['meridian'] == 'am')?"selected = 'selected'":'';?>>am</option>
                <option value="pm" <?php echo ($time['endtime']['meridian'] == 'pm')?"selected = 'selected'":'';?>>pm</option>
            </select>
            <br>
    <?php 
    $i++;
    endforeach;
    
    }?>
            <br>
    <?php endforeach;
    
    ?>
            
            <div class="submit">
        <input  type="submit" name="submit" value="Submit"/>
    </div>
</form>
</div>
