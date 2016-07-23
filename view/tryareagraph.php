<?php 
require_once 'conn.php';


$sql_data  = mysql_query("select * from transact_tb ");

$numrows = mysql_num_rows($sql_data);

//echo  $numrows;
$arr =  array('Type', 'Sales');

//echo json_encode($arr).",";
$counter = 0;

//$arrx =  array('purcahse', 50000);
//echo json_encode($arrx);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
          
          var jsonData = $.ajax({
          url: "http://ec2-54-191-230-33.us-west-2.compute.amazonaws.com/rainbow/view/datatest.php",
          dataType: "json",
          async: false
          }).responseText;
       /*
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          ['2013',  1000],
          ['2014',  1170],
          ['2015',  660],
          ['2016',  1030]
        ]); */

  
         // var data = google.visualization.arrayToDataTable(array);
          console.log(jsonData);
          var curry  = '"';
          var curryx = "'"
          var datax = jsonData.split(curry).join(curryx);
          console.log(JSON.parse(jsonData));
           var data = new google.visualization.DataTable();
          // var data = new google.visualization.DataTable(jsonData);
    data.addColumn('string', 'Card No');
    data.addColumn('number', 'Amount');
        //  data.addColumn('number', 'Balance');
           data.addRows(JSON.parse(jsonData));
         
          //parseInt(datax)
    var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          //BubbleChart
          //AreaChart
          //LineChart
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>