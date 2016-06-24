<?php
require_once 'conn.php';
    //check for validity of id
    $checkid = mysql_query("SELECT * FROM staff_tb WHERE staff_contract_no ='".$_POST['manager']."' ");
    $rowx = mysql_fetch_assoc($checkid);
    $manager_id = $rowx['staff_contract_no'];
    
     //check for validity of id
    $checkid2 = mysql_query("SELECT * FROM seller_tb WHERE id ='".$_POST['seller']."' ");
    $rowx2 = mysql_fetch_assoc($checkid2);
    $seller_id = $rowx2['id'];
    
    if($seller_id == $seller  &&  $manager_id == $manager){
    
 mysql_query("INSERT INTO manager ( staff_id, seller_id) VALUES ( '".$_POST['manager']."', '".$_POST['seller']."')");
      
       
        // header("Location: success.html");
       //  die();
    }
        
        ?>
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
  </head>
    <body>
        <section  class="page-header">
            <a href="index.html" class="btn">HOME</a>
            
    <h1><?php echo $rowx['username']; ?> Successfully Assigned to <?php echo $rowx2['username']; ?></h1>

 </section>


    </body>

    
</html>