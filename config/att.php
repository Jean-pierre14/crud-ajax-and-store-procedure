<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");
$ouput = '';
if(isset($_POST['action'])){
    if($_POST['action'] == 'select'){
        $sql = mysqli_query($con, "SELECT * FROM users ORDER BY id DESC");
        if(@mysqli_num_rows($sql) > 0){
            $ouput .= '
            
                <ul class="list-group mt-3">';
            while($row = mysqli_fetch_array($sql)){
                if($row['today'] != ''){
                        $ouput .= '<li id="'.$row['id'].'" class="list-group-item d-flex justify-content-between align-item-center">'.$row['today'].'
                    <span>'.$row['fullname'].'</span>
                    <span class="btn-group">
                        <button type="button" class="btn btn-sm btn-success yes" id="'.$row['id'].'">Yes</button>
                        <button type="button" class="btn btn-sm btn-secondary no" id="'.$row['id'].'">No</button>
                    </span>
                    </li>';
                }else{
                    $ouput .= '<li id="'.$row['id'].'" class="list-group-item d-flex justify-content-between align-item-center">'.$row['today'].'
                <span>'.$row['fullname'].'</span>
                <span class="btn-group">
                    <button class="btn btn-sm btn-success" id="'.$row['id'].'">Yes</button>
                    <button class="btn btn-sm btn-secondary" id="'.$row['id'].'">No</button>
                </span>
                </li>';
                }
            }
            $ouput .= '</ul>';
        }else{
            $ouput .= '
            <div class="card card-body">
                <h3>There no user registered into your database</h3>
                <p class="alert alert-danger">Better you add a form here</p>
                <a href="index.html">Register now</a>
            </div>';
        }
        print $ouput;
    }
    if($_POST['action'] == 'yes'){
        $id = $_POST['id'];
        $sql = mysqli_query($con, "UPDATE users SET today = now() WHERE id = $id");
        if($sql){
            print 1;
        }else{
            print 0;
        }
    }
}