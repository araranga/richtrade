<?php
$primary = "accounts_id";
$pid = $_GET['id'];
$tbl = "tbl_accounts";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
while($row=mysql_fetch_md_assoc($query))
{
	foreach($row as $key=>$val)
	{
		$$key = $val;
	}
}
$packrowq = mysql_query_md("SELECT * FROM tbl_package");
while($packrow = mysql_fetch_md_assoc($packrowq))
{
	$options[$packrow['package_id']] = $packrow['package_name'];
}
$field[] = array("type"=>"text","value"=>"username","label"=>"Username");
$field[] = array("type"=>"text","value"=>"password","label"=>"Password");
$field[] = array("type"=>"email","value"=>"email","label"=>"Email");
#$field[] = array("type"=>"select","value"=>"package_id","label"=>"Package","option"=>$options,"attr"=>"disabled");
?>
<h2>Users</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
	  <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $$primary;?>'>
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
                        foreach($inputs['option'] as $key=>$val)
                        {
                        	?>
                     <option <?php if($$inputs['value']==$key){echo"selected='selected'";} ?> value='<?php echo $key;?>'><?php echo $val;?></option>
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
