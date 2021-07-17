<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("Can't be connect to this DB");


$output = '';
$dateNow = date('Y-m-d');
if(isset($_POST['action'])){
    if($_POST['action'] == 'TodayIsToday'){
        $sql = mysqli_query($con, "SELECT today FROM users");
        $row = mysqli_fetch_array($sql);
        if($row['today'] != $today || $row['today'] == 'no'){
            mysqli_query($con, "UPDATE users SET `today` = ''");
        }
    }
    if($_POST['action'] == 'attended'){
        $today = date('Y-m-d');
        $sql = mysqli_query($con, "SELECT * FROM users INNER JOIN attendance ON users.id=attendance.user_id WHERE attended = '$today'");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '<ul class="list-group">';
            while($row = mysqli_fetch_array($sql)):
                $dateNow = date('Y-m-d');
                if($row['attended'] == $dateNow){
                    $output .= '
                    <li class="list-group-item list-group-item-success d-flex justify-content-between align-item-center">
                    <span>'.$row['fullname'].'</span>
                    <span class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                        <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                    </span>
                    </li>';
                }else{
                    $output .= '
                    <li class="list-group-item d-flex justify-content-between align-item-center">
                    <span>'.$row['fullname'].'</span>
                    <span class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                        <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                    </span>
                    </li>';
                }
            endwhile;
            $output .= '</ul>';
        }else{
            $output .= '<p class="alert alert-danger">There no data into this table</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'select'){
        
        $sql = mysqli_query($con, "SELECT * FROM users");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '<ul class="list-group">';
            while($row = mysqli_fetch_array($sql)):
                if($row['today'] == $dateNow){
                    $output .= '
                    <li class="list-group-item d-flex list-group-item-success justify-content-between align-item-center">
                    <span>'.$row['fullname'].'</span>
                    <span>
                        <button class="btn btn-sm btn-primary" type="button" id="'.$row['id'].'">See</button>
                    </span>
                    </li>';
                }elseif($row['today'] == 'no'){
                    $output .= '
                    <li class="list-group-item d-flex list-group-item-danger justify-content-between align-item-center">
                    <span>'.$row['fullname'].' '.$dateNow.'</span>
                    <span>
                        <button class="btn btn-sm btn-secondary" type="button" id="'.$row['id'].'">See</button>
                    </span>
                    </li>';
                }else{
                    $output .= '
                    <li class="list-group-item d-flex justify-content-between align-item-center">
                    <span>'.$row['fullname'].'</span>
                    <span class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                        <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                    </span>
                    </li>';
                }
                // if($row['today'] == ''){
                //     $output .= '
                //     <li class="list-group-item d-flex justify-content-between align-item-center">
                //     <span>'.$row['fullname'].'</span>
                //     <span class="btn-group">
                //         <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                //         <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                //     </span>
                //     </li>';
                // }elseif($row['today'] == 'no'){
                //     $output .= '
                //     <li class="list-group-item list-group-item-danger d-flex justify-content-between align-item-center">
                //     <span>'.$row['fullname'].'</span>
                //     <span class="btn-group">
                //         <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                //         <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                //     </span>
                //     </li>';
                // }else{
                //     $output .= '
                //     <li class="list-group-item list-group-item-primary d-flex justify-content-between align-item-center">
                //     <span>'.$row['fullname'].'</span>
                //     ';
                
                //     if($row['today'] == ''){
                //         $output .= '
                //         <span class="btn-group">
                //             <button type="button" class="btn btn-sm btn-primary yes" id="'.$row['id'].'">Yes</button>
                //             <button type="button" class="btn btn-sm btn-warning no" id="'.$row['id'].'">No</button>
                //         </span>
                //         ';
                //     }elseif($row['today'] == 'no'){
                //         $output .= '
                //             <button type="button" class="btn btn-sm btn-secondary" id="'.$row['id'].'">See</button>
                //         ';
                //     }else{
                //         $output .= '
                //         <button type="button" class="btn btn-sm btn-primary" id="'.$row['id'].'">See</button>
                //         ';
                //     }
                // $output.= '
                // </li>';
                // }
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
            mysqli_query($con, "UPDATE users SET today = '$dateNow' WHERE id = $id");
            print 'success';
        }else{
            print 'Error';
        }
    }
    if($_POST['action'] == 'no'){
        $id = $_POST['id'];
        $sql = mysqli_query($con, "UPDATE users SET today = 'no' WHERE id = $id");
        if($sql){
            print 'success';
        }else{
            print 'Error';
        }
    }
}