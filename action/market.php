<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
//$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_market WHERE sold IS NULL");
 //primary query
 $limit = getlimit(25,$_GET['p']);
 $query = "SELECT * FROM tbl_market WHERE sold IS NULL ORDER by id DESC $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,25);
?>
<h2>Marketplace</h2>

<?php
if($total==0) {
?>
<p> No items to sell. </p>
<?php
}
?>
  
  
<div id="poke-container" class="ui cards">
<?php
	while($xxx = mysql_fetch_md_assoc($q)) {
		
		$rowqpokes = loadpokev2($xxx['pokeid']);
?>	
		<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
		<div class='typedataholder'>
			<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
				
				<div class='typesdata <?php echo $tt; ?>'>
				<img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'>
				
				<?php echo ucfirst($tt); ?>
				</div>
			<?php } ?>	
		</div>
		
		   <div class="image">  
				<div class='mainchar flipme showchar' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>		   
		   </div>
		   <h4><?php echo $rowqpokes['pokename']; ?></h4>
		   <h5 style='font-weight:700;'>Amount:<?php echo number_format($xxx['amount'],2); ?></h5>
		   <p class='idsdata'>ID:#<?php echo $rowqpokes['hash']; ?></p>
		   <span>Level:<?php echo $rowqpokes['level']; ?></span>
		   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
		   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
		   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
		   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
		   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
		   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span><br/>	


		   <span>
		   
		   <?php 
		   $games = $rowqpokes['win'] + $rowqpokes['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$rowqpokes['win']."/".$games;
			}
		   echo "<br>";
		   
			
		   ?>
		   <a target='_newtab' href='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'>View Stats</a>
		   </span>
		   <br/>	
		   
		   
		   <?php if($xxx['user']!=$_SESSION['accounts_id']) { ?>
			<input class="btn btn-info btn-lg btnbattle" type="button" onclick="window.location='index.php?pages=buypoke&pokeid=<?php echo $rowqpokes['hash']; ?>'" name="battle" value="Buy Now">
		   <?php } else { ?>
			<span>This is your item</span>
		   <?php } ?>
		</div>
<?php
	}
?>	
</div>	
  
  
  
            <div class="row">
               <div class="col-sm-12">
                  <div class="dataTables_paginate paging_simple_numbers">
                     <ul class="pagination">
                      <?php
                        for($c=1;$c<=$pagecount;$c++)
                        {
                          $active = '';

                          if($_GET['p']=='' && $c==1)
                          {
                            $active = 'active';
                          }
                          if($c==$_GET['p'])
                          {
                            $active = 'active';
                          }
                          $url = "?search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
                      ?>
                        <li class="paginate_button <?php echo $active; ?>" aria-controls="dataTables-example" tabindex="0"><a href="<?php echo $url; ?>"><?php echo $c; ?></a></li>
                      <?php
                        }
                      ?>
                     </ul>
                  </div>
               </div>
            </div> 

