<div class="useravailabilities form">
    
    <?php $days = array(
    1 => 'Sunday',
    2 => 'Monday',
    3 => 'Tuesday',
    4 => 'Wednesday',
    5 => 'Thrusday',
    6 => 'Friday',
    7 => 'Saturday',
);?>
<?php echo $this->Form->create('Useravailability'); ?>
    
<?php echo $this->Form->create('Useravailability'); ?>
   
    <fieldset>
        <legend>Add Useravailability</legend>

<?php foreach($days as $key=>$day):?>
        <?php echo $day;?>
        <select name="data[Useravailability][<?php echo $key;?>][availabilities]" id="UseravailabilityEndtimeMeridian" required="required">
                <option value="0" selected="selected">Available</option>
                <option value="1">Avaliable time</option>
                <option value="2">Not Avaliable</option>
            </select>
        
        
        <div class="input time required">
            <label for="UseravailabilityStarttimeHour">Starttime</label>
            <select name="data[Useravailability][<?php echo $key;?>][time][0][starttime][hour]" id="UseravailabilityStarttimeHour" required="required">
<?php for ($hours = 1; $hours <= 12; $hours++) { ?>
                    <option value="<?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>

            </select>:<select name="data[Useravailability][<?php echo $key;?>][time][0][starttime][min]" id="UseravailabilityStarttimeMin" required="required">
<?php for ($min = 0; $min < 60; $min+=15) { ?>
                    <option value="<?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>
            <select name="data[Useravailability][<?php echo $key;?>][time][0][starttime][meridian]" id="UseravailabilityStarttimeMeridian" required="required">
                <option value="am" selected="selected">am</option>
                <option value="pm">pm</option>
            </select>
        </div>
        <div class="input time required">
            <label for="UseravailabilityEndtimeHour">Endtime</label>
            <select name="data[Useravailability][<?php echo $key;?>][time][0][endtime][hour]" id="UseravailabilityEndtimeHour" required="required">
<?php for ($hours = 1; $hours <= 12; $hours++) { ?>
                    <option value="<?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>:<select name="data[Useravailability][<?php echo $key;?>][time][0][endtime][min]" id="UseravailabilityEndtimeMin" required="required">
                <?php for ($min = 0; $min < 60; $min+=15) { ?>
                    <option value="<?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>
            <select name="data[Useravailability][<?php echo $key;?>][time][0][endtime][meridian]" id="UseravailabilityEndtimeMeridian" required="required">
                <option value="am" selected="selected">am</option>
                <option value="pm">pm</option>
            </select>
        </div>
        <?php if($key == 2){?>
        <div class="input time required">
            <label for="UseravailabilityStarttimeHour">Starttime</label>
            <select name="data[Useravailability][<?php echo $key;?>][time][1][starttime][hour]" id="UseravailabilityStarttimeHour" required="required">
<?php for ($hours = 1; $hours <= 12; $hours++) { ?>
                    <option value="<?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>

            </select>:<select name="data[Useravailability][<?php echo $key;?>][time][1][starttime][min]" id="UseravailabilityStarttimeMin" required="required">
<?php for ($min = 0; $min < 60; $min+=15) { ?>
                    <option value="<?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>
            <select name="data[Useravailability][<?php echo $key;?>][time][1][starttime][meridian]" id="UseravailabilityStarttimeMeridian" required="required">
                <option value="am" selected="selected">am</option>
                <option value="pm">pm</option>
            </select>
        </div>
        <div class="input time required">
            <label for="UseravailabilityEndtimeHour">Endtime</label>
            <select name="data[Useravailability][<?php echo $key;?>][time][1][endtime][hour]" id="UseravailabilityEndtimeHour" required="required">
<?php for ($hours = 1; $hours <= 12; $hours++) { ?>
                    <option value="<?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($hours, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>:<select name="data[Useravailability][<?php echo $key;?>][time][1][endtime][min]" id="UseravailabilityEndtimeMin" required="required">
                <?php for ($min = 0; $min < 60; $min+=15) { ?>
                    <option value="<?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($min, 2, '0', STR_PAD_LEFT); ?></option>
                <?php } ?>
            </select>
            <select name="data[Useravailability][<?php echo $key;?>][time][1][endtime][meridian]" id="UseravailabilityEndtimeMeridian" required="required">
                <option value="am" selected="selected">am</option>
                <option value="pm">pm</option>
            </select>
        </div>
        <?php }?>
        
        <br/>
        <?php endforeach;?>

    </fieldset>
    <div class="submit">
        <input  type="submit" name="submit" value="Submit"/>
    </div>
</form>




</div>
