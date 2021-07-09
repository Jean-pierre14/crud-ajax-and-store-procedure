<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("Can't be connect to this DB");


$output = '';
if(isset($_POST['action'])){
    if($_POST['action'] == 'select'){
        $sql = mysqli_query($con, "SELECT * FROM users");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '<ul class="list-group">';
            while($row = mysqli_fetch_array($sql)):
                $dateNow = date('Y-m-d');
                $att = mysqli_query($con, "SELECT * FROM attendance");
                $d = mysqli_fetch_array($att);
                $output .= '
                <li class="list-group-item d-flex justify-content-between align-item-center">
                <span>'.$row['fullname'].' '.$dateNow.'</span>
                <span class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                    <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                </span>
                </li>';
            endwhile;
            $output .= '</ul>';
        }else{
            $output .= '<p class="alert alert-danger">There no data into this table</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'yes'){
        $id = $_POST['id'];
        $sql = mysqli_query($con, "INSERT INTO attendance(`user_id`, attended) VALUES('$id', now())");
        if($sql){
            print 'success';
        }else{
            print 'Error';
        }
    }
}