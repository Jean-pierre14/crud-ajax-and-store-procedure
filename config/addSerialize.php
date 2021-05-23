<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

$errors = array();
$username = mysqli_real_escape_string($con, trim($_POST['username']));
$fullname = mysqli_real_escape_string($con, trim($_POST['fullname']));

if(empty($username)){array_push($errors, "Username is empty");}
if(empty($fullname)){array_push($errors, "Fullname is empty");}

if(count($errors) == 0){
    $query = "CALL insertUser('" . $username . "', '" . $fullname . "')";
    print 'User registed';
}else{
    print 'empty field';
}