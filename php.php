<?php
    include_once "./config/config.php";
    $sql = mysqli_query($con, "SELECT * FROM users");
    $row = mysqli_fetch_assoc($sql);

    print count($row);
    // for($n=0;$n<=count($row);$i++){
        
    // }

    for($i=0;$i<=5;$i++){
        print "X";
    }

?>