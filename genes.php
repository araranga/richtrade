<?php
session_start();
require_once("connect.php");
require_once("function.php");

$levelimit = $_SESSION['level'] + 9;
$path = $_SESSION['path'];
$aid = $_SESSION['accounts_id'];



if(!empty($_REQUEST['aid'])){

  $aid = $_GET['aid'];
  $path = $_GET['path'];
  $levelimit = $_GET['level'] + 9;

}




$query = "SELECT * FROM `tbl_accounts` WHERE path LIKE '{$path}%' AND level <= $levelimit ORDER BY `accounts_id` ASC";

                       $q = mysql_query_md($query);
                                    $person = array();


                                    while($row=mysql_fetch_md_array($q))
                                    {

                                    	if($row['parent']==0){
                                    		$row['parent'] = '';
                                    	}

                                    	if($row['accounts_id']==$aid){

                                    		$row['parent'] = '';
                                    	}

                                        foreach($row as $key=>$val){
                                            $person[$row['accounts_id']][$key] = $val;
                                        }

                                    }


?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <div id="chart_div"></div>
   <script>
          google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          <?php 
          foreach ($person as $d) { 
              $html = "<div style=\"color:green\">Active</div>";

              if(empty($d['deadline'])){
                  $html = "<div style=\"color:red\">Inactive</div>";
              }else{

$today = date("Y-m-d h:i:s");
$expire = $d['deadline']; //from database

$today_time = strtotime($today);
$expire_time = strtotime($expire);

if ($expire_time < $today_time) { 

     $html = "<div style=\"color:red\">Inactive</div>";
 }


              }
            ?>
          [{'v':'<?php echo $d['accounts_id']; ?>', 'f':'<?php echo $d['fullname']; ?><?php echo $html; ?>'},'<?php echo $d['parent']; ?>', ''],
         <?php } ?>
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,'size':'LARGE'});
      }
</script>