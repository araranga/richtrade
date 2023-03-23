<?php



$field[] = array("type"=>"text","value"=>"package_name","label"=>"Package Name");
$field[] = array("type"=>"number","value"=>"possible_earning","label"=>"Possible Earnings");
$field[] = array("type"=>"number","value"=>"account_count","label"=>"Account Counts");
$field[] = array("type"=>"number","value"=>"cycle_earn","label"=>"Earning per Cycle");
?>
<h2>Package</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
         <table width="100%">
            <?php
               $is_editable_field = 1;
               foreach($field as $inputs)
               {
               						if($inputs['label']!='')
               						{
               						$label = $inputs['label'];
               						}
               						else
               						{
               						$label = ucwords($inputs['value']);
               						}
               ?>
            <tr>
               <td style="width:180px;" class="key" valign="top" ><label for="accounts_name"><?php echo $label; ?><?php echo $req_fld?>:</label></td>
               <?php if ( $is_editable_field ) { ?>
               <td>
                  <?php
                     if ($inputs['type']=='select')
                     {																																
                     	?>
                  <select name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" required <?php echo $inputs['attr']; ?>
                     >
                     <?php
                        foreach($inputs['option'] as $val)
                        {
                        	?>
                     <option <?php if($$inputs['value']==$val){echo"selected='selected'";} ?> value='<?php echo $val;?>'><?php echo $val;?></option>
                     <?php
                        }
                        ?>
                  </select>
                  <span class="validation-status"></span>
                  <?php
                     }
                     else
                     {
                     	?>
                  <input required <?php echo $inputs['attr']; ?> type="<?php echo $inputs['type']; ?>" name="<?php echo $inputs['value']; ?>" id="<?php echo $inputs['value']; ?>" size="40" maxlength="255" value="<?php echo $$inputs['value']; ?>" />
                  <span class="validation-status"></span>												
                  <?php
                     }
                     ?>
               </td>
               <?php } else { ?>
               <td><?php echo $$inputs['value']; ?></td>
               <?php } ?>                                                                                                    
            </tr>
            <?php
               }
               ?>
         </table>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 
