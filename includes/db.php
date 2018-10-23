<?php 

$db["db_host"] = "localhost";
$db["db_user"] = "root";
$db["db_pwd"] = "";
$db["db_database"] = "cms";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$con = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE);

// get options and load into an array. also in regular functions (duplicate)
$optionResults = mysqli_query($con,"SELECT option_name, option_value FROM options");
//confirm($optionResults);
while($row = mysqli_fetch_assoc($optionResults)){
    $config[$row['option_name']] = $row['option_value'];
//    $name=$row['option_name'];
//    $value=$row['option_value'];
//    $$name=$value;
}

?>