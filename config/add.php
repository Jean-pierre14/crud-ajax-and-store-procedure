<?php

$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

$num = count($_POST['name']);

if($num > 1){
    for($i = 0; $i < $num; $i++){
        if(trim($_POST['name'][$i]) != ''){
            $sql = mysqli_query($con, "INSERT INTO children_tb(name) VALUE('".mysqli_real_escape_string($con, $_POST['name'][$i]) ."')");
            if($sql) {
                $out = '<p>Registerd</p>';
            }
        }
    }
}else{
    $out = '<p>Please entre the name</p>';
}

print $out;