<?php
    include("../connect.php");
    include("../function.php");


                       $q = mysql_query_md("SELECT * FROM `tbl_accounts` ORDER BY `accounts_id` DESC");
                                    $person = array();

$person[0]['accounts_id'] = 0;

$person[0]['email'] = 'CEO';
$person[0]['parent'] = '';
                                    while($row=mysql_fetch_md_array($q))
                                    {

                                        foreach($row as $key=>$val){
                                            $person[$row['accounts_id']][$key] = $val;
                                        }

                                    }

echo "<pre>";
print_r($person);

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
          <?php foreach ($person as $d) { ?>
          [{'v':'<?php echo $d['accounts_id']; ?>', 'f':'<?php echo $d['email']; ?><div><a href=\"\">test</a></div>'},'<?php echo $d['parent']; ?>', ''],
         <?php } ?>
        ]);

 data.setRowProperty(3, 'style', 'border: 1px solid green');
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,'size':'small'});
      }
</script>