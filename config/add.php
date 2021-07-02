<?php

$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

$num = count($_POST['name']);
$id = $_POST['user_id'];

if ($num > 1) {
    for ($i = 0; $i < $num; $i++) {

        if (trim($_POST['name'][$i]) != '') {
            $sql = mysqli_query($con, "INSERT INTO children(users_id, `name`) VALUES($id, '" . mysqli_real_escape_string($con, $_POST['name'][$i]) . "')");
        }
    }
    if ($sql) {
        print '<p class="alert alert-success">Registerd</p>';
    }
} else {
    print 'error';
}
