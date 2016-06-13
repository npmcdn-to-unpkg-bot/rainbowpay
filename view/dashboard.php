<!DOCTYPE html>
<html lang="en-us">
      <head>
    <meta charset="UTF-8">
    <title>Rainbow by Amonsoft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="stylesheets/github-light.css" media="screen">
          
          
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
/*
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};
          */
            <?php
require_once 'conn.php';
$sql_pending = mysqli_query($db_conn,"SELECT * FROM pending_tb Limit 1");
$numrows = mysqli_num_rows($sql_pending);
$a = array();
$v =0;
$row_pending = $sql_pending)
            ?>
          
          
          
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales','Sales'],
      
             
            ['456', 456, 795 ]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year', 
                  titleTextStyle: {color: '#333'}
                 },
          vAxis: {minValue: 0}
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        //  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        // BAR CHART---  google.visualization.BarChart
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <section  class="page-header">
        <a href="index.html" class="btn">HOME</a>

         <div id="chart_div"></div>
         </section>
       
<script lang="javascript" type="application/javascript"> 
   
    
  
function approve(){
 var invoice_no = document.getElementById('invoice').value;
    var numberx =  document.getElementById('number').value;
    
//console.log("1");
  //  console.log(numberx);
    
    
     
     var xhttp =  new XMLHttpRequest();
        
      xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            window.alert(xhttp.responseText);
            window.location.reload();
            }
        }
    
      var site = "check.php?status=approved&id=";
      
      var sitex = site.concat(numberx);
    
    var sitexx = sitex.concat("&invoice=");
    
    var finalx = sitexx.concat(invoice_no);
      xhttp.open("GET",finalx,true); 
    
   // xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
   xhttp.send();
        
    
   
        
};
    function decline(){
    //console.log("Declined");
         var invoice_no = document.getElementById('invoice').value;
    var numberx =  document.getElementById('number').value;
         
        var xhttp =  new XMLHttpRequest();
        
     xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            window.alert(xhttp.responseText);
                 window.location.reload();
            }
        }
      var site = "check.php?status=decline&id=";
      
      var sitex = site.concat(numberx);
    
    var sitexx = sitex.concat("&invoice=");
    
    var finalx = sitexx.concat(invoice_no);
      xhttp.open("GET",finalx,true);  

    xhttp.send();
   
};
    
        

</script>
       </body>
</html>



