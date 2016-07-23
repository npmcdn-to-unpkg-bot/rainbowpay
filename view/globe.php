<?php
header('Access-Control-Allow-Origin: *');
require_once 'conn.php';

$arr = array(
    array(
        "region" => "valore",
        "price" => "valore2"
    ),
    array(
        "region" => "valore",
        "price" => "valore2"
    ),
    array(
        "region" => "valore",
        "price" => "valore2"
    )
);

///**********************start fetching data
$result  = mysql_query("select * from place_db");

 $arrz = array(6,159,0.001); //init array

while ($row_pending = mysql_fetch_assoc($result)){

//add to array cordinates for globe
//$new_item = $row_pending['latitude'], $row_pending['longitude'],3;
array_push($arrz,floatval($row_pending['latitude']), floatval($row_pending['longitude']),3 );
}


///************finished fetching data

 $arry = array('1900',$arrz);
$arrx = array($arry);

//echo json_encode($arr);
//echo json_encode($arrx);
echo json_encode($arrz);
//echo "[['1990',[6,159,0.001]]]";



/*latitude ,  longitude 
echo mysql_num_rows($result);
echo "</br>";
echo 'lets start';
echo "</br>";
*/

$fp = fopen('data.json', 'w');
fwrite($fp, json_encode($arrz));
fclose($fp);

?>