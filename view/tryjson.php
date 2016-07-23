<?php
//array for google area charts
$arr =array( array(
    'Year', 'Sales', 'Expenses'
), array(
    '2013', '1000', '460'
), array(
    '2012', '1170', '460'
));



echo json_encode($arr);
/*

          ['Year', 'Sales', 'Expenses'],
          ['2013',  1000,      400],
          ['2014',  1170,      460],
          ['2015',  660,       1120],
          ['2016',  1030,      540]
     *******************finished for area charts*****************
     //array for google area charts
$arr =array( array(
    'Year', 'Sales', 'Expenses'
), array(
    '2013', '1000', '460'
), array(
    '2012', '1170', '460'
));

******************************************
          
          
          
          //finished
          **************************done bar chart google data source *******************
          
          //array for google bar charts
$arr = array(
    
        "columns" => array(
        "id" => "1",
        "label" => "label1",
        "pattern" => "patternx",
        "type" => "string",
    ),
        "rows" => array(
        "c" => array(array(
        "v" => "Mushrooms",
        "f" => "null"
    ),array(
        "v" => "3",
        "f" => "null"
    ))        
        )
    
);

********************************************************
{
  "cols": [
        {"id":"",
        "label":"Topping",
        "pattern":"",
        "type":"string"}
      ],
  "rows": [
        {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null}]},
        {"c":[{"v":"Onions","f":null},{"v":1,"f":null}]},
        {"c":[{"v":"Olives","f":null},{"v":1,"f":null}]},
        {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null}]},
        {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null}]}
      ]
}

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
); */
?>