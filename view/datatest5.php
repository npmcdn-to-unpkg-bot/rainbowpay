<?php 
require_once 'conn.php';
//header('Allow-Control-Allow-Origin:*');//allowing
header('Access-Control-Allow-Origin: *');
//external resource access
/****************************/
/** STRICTLY RESEARCH WORK **/
/*****************************/

//$sql_data  = mysql_query("select * from transact_tb where type = 'purchase' AND card_no = '2016' limit 200");
//$sql_data  = mysql_query("select * from purchase_tb  limit 100,300");
//pending_tb
$sql_data  = mysql_query("select * from pending_tb ");

$numrows = mysql_num_rows($sql_data);

//echo  $numrows;
//$arr =  array('Type', 'Sales');
$month_array =  array();
 $amount_array =  array();
echo '[';
echo json_encode($arr).",";
$counter = 0;
 while ($row_pending = mysql_fetch_assoc($sql_data) AND $counter <300)
{
        echo   json_encode(array(substr($row_pending['time_stamp'], 5, -12),(int)$row_pending['amount'])).",";
     $counter++;
     array_push($month_array,substr($row_pending['time_stamp'], 5, -12));
  array_push($amount_array,(int)$row_pending['amount']);
     }
$arrx =  array('2016-05-12',0);
echo json_encode($arrx);

echo ']';



//echo '**************New arrays for months';
//echo '**************New arrays for months';
//echo json_encode($month_array);
//echo '**************New arrays for months count';
//echo json_encode(array_count_values($month_array));
//good to count how many people/Sites are trading per month

//echo '**************New arrays for amounts';
//echo json_encode($amount_array);
//echo '**************New arrays for amounts count';
//echo json_encode(array_count_values($amount_array));

//sort all arrays
//sort($month_array,1);
//sort($amount_array,1);

//echo '**************New sorted arrays for amounts';
//echo json_encode($amount_array);
//echo '**************New sorted arrays for months count';
//echo json_encode($month_array);
//create a new array with only ynique values

$unique_month = array_unique($month_array);
$unique_amount = array_unique($amount_array);

//combine the arrays to form a 2d array
$combined_array =  array(
$month_array,$amount_array
);
//echo '**************New combined array';
//echo  json_encode($combined_array);
//echo '**************Check Key value Pairs';
//$bar = each($combined_array);
//echo json_encode($bar);
//echo '**************Tests********************';
//true to print on value
//echo json_encode(array_values($month_array)[0]) ;

/*echo values of the unique set arrays
echo '**************Tests for unique months********************';
echo json_encode($unique_month);
echo '**************Tests for unique amount********************';
echo json_encode($unique_amount);
echo '**************Tests Occurances********************';
*/
//count occurances of an indvidual item
$element_count_month  =  count(array_keys($month_array, array_values($unique_month)[4]));

//echo '**************Testscounting variable********************';
//echo $element_count_month ;

// echo '**************Tests number of elements in months unique array********************';
//print and set  number of elements in the unique array
$number_of_elements =  count($unique_month);
//echo count($unique_month);

//amount sum totaling tool
//echo '**************Tests amount per count variable********************';
$amount_total=0;

$counter = 0;
/*echo '**************Tests Brian and Ezama********************';
/*
echo '**************Tests Matching********************';
$result = array();
for ($i=0; $i<count($month_array); $i++) {
    $result[] = array($month_array[$i] => $amount_array[$i]);
}

echo  json_encode($result);
echo '**************Tests Matching with one value********************';
$month4 =  array();
 array_push($month4,$result['04']);

echo json_encode($month4);

//"04"
echo '**************Tests Matching Ending********************';
///*************
//add counter
*/
//create new totals array
$totals_array = array();

for($n=0;$n<$number_of_elements;$n++){  
     $amount_total=0;
    
for ($i=0;$i<count(array_keys($month_array, array_values($unique_month)[$n]));$i++){
    
   echo "*******</br>";
    echo $amount_total;
    
    //get the amount when month is 5 or 4 or 3
    
   $amount_total = $amount_total + $amount_array[$i];
    
    echo "***"; echo $n;echo "***";echo $i;echo "***"; echo $amount_array[$i];echo "***"; echo $amount_total;
  
    
    // echo  $amount_array[$i];
     //echo "*******</br>";
    // echo $combined_array[0][0];
   // echo $combined_array[$n];
    
  } 
    array_push($totals_array,$amount_total);
   /*
  //$amount_total=0;*/
   // echo json_encode($n);
   // echo json_encode($month_array[$n]);
   // $number =  count(array_keys($month_array, array_values($unique_month)[$n]));
   // echo  $number;
  //  echo count(array_keys($month_array, array_values($unique_month)[$n]));
    
}

echo "*******</br>";
//print the toal amount
echo $amount_total;

echo '**************Tests amount per individual count variable********************';
//print the array of new data with totals
echo json_encode($totals_array);

echo '**************Tests elements in months unique array raw data*******************';
//print the array of unique months
echo json_encode($unique_month);
   echo '**************Tests elements in months unique array imploded*******************';              
$new_array = implode(', ', $unique_month);
 echo json_encode($new_array);
 
echo '*****************TEST for both data sets togeteher , months and amounts in order';
echo json_encode($totals_array);
echo json_encode($new_array);

$new_amount_array = array($new_array);

$combined_new_data = array();
array_push($combined_new_data,$new_amount_array ,$totals_array);
echo "*******</br>";
echo json_encode($combined_new_data); 
echo "*******</br>";
for ($z=0;$z<count($new_amount_array);$z++){
    echo json_encode(array($new_amount_array[$z],$totals_array[$z]));
}



/*
sort(array,sortingtype);

Parameter	Description
array	Required. Specifies the array to sort
sortingtype	Optional. Specifies how to compare the array elements/items. Possible values:
0 = SORT_REGULAR - Default. Compare items normally (don't change types)
1 = SORT_NUMERIC - Compare items numerically
2 = SORT_STRING - Compare items as strings
3 = SORT_LOCALE_STRING - Compare items as strings, based on current locale
4 = SORT_NATURAL - Compare items as strings using natural ordering
5 = SORT_FLAG_CASE -
*/
//echo $counter;
/*
array_merge
$arr =array( array(
    'Year', 'Sales', 'Expenses'
), array(
    '2013', '1000', '460'
), array(
    '2012', '1170', '460'
));



echo json_encode($arr);
*/

?>