<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

// Global Variables
$output = "";
$errors = array();

if (isset($_POST['action'])) {
    if($_POST['action'] == 'search'){
        $text = mysqli_real_escape_string($con, htmlentities(trim($_POST['text'])));

        if(empty($text)){
            $output = '<p class="my-2 alert alert-danger">We can\'t find this '.$text.'</p>';
        }else{
            $sql = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '%{$text}%' OR email LIKE '%{$text}%' OR rollnumber LIKE '%{$text}%'");
            if($sql){
                if(@mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                        $output .= '
                        <p class="alert alert-success d-flex justify-content-between align-item-center">
                            <span>'.$row['username'].'</span>
                            <small>'.$row['email'].'</small>
                        </p>';   
                    }
                }else{
                    $output = '<p class="my-2 alert alert-danger">We can\'t find this '.$text.'</p>';
                }
            }else{
                $output = '<p class="my-2 alert alert-danger">We can\'t find this '.$text.'</p>';
            }
        }

        print $output;
    }
    if($_POST['action'] == 'count'){
        $sql = mysqli_query($con, "SELECT COUNT(id) AS countId FROM children");
        $row = mysqli_fetch_array($sql);
        print '<span class="btn btn-sm btn-success">'.$row['countId'].'</span>';
    }
    if($_POST['action'] == 'yesDeleteAll'){
        $sql = mysqli_query($con, "DELETE FROM children");
        if($sql){
            print '<p class="alert alert-danger">Data deleted :)</p>';
        }
    }
    if($_POST['action'] == 'resultats'){
        $limit = $_POST['limit'];
        $sql = mysqli_query($con, "SELECT * FROM children ORDER BY `name` ASC LIMIT $limit");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '<ul class="list-group">';
            while($row = mysqli_fetch_array($sql)){
                $output .= '<li id="'.$row['id'].'" class="list-group-item list-group-item-success d-flex justify-content-between align-items-center list-group-item-action">
                    <span>'.$row['name'].'</span>
                    <span class="badge badge-primary badge-pill text-secondary">'.$row['users_id'].'</span>
                </li>';
            }
            $output .= '</ul>';
        }else{
            $output .= '<p class="alert alert-secondary">There is no data regsitered</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'usersId'){
        
        $sql = mysqli_query($con, "SELECT id, username FROM users ORDER BY `username` ASC");

        if(@mysqli_num_rows($sql) > 0){

            $output .= '<select name="user_id" class="form-control">
            <option value="">-- Select --</option>';
            while($row = mysqli_fetch_array($sql)){
                $output .= '<option value="'.$row['id'].'">'.$row['username'].'</option>';
            }
            $output .= '</select>';

        }else{

            $output .= '<p class="alert alert-danger p-1 text-center>There is no user registered</p>';
            
        }
        print $output;
    }
    
    if ($_POST['action'] == 'attendance') {
        $sql = mysqli_query($con, "SELECT * FROM users ORDER BY id DESC");
        if (@mysqli_num_rows($sql) > 0) {
            // $sql2 = mysqli_query($con, "SELECT * FROM attendance");
            // $data = @mysqli_fetch_array($sql2);

            $output .= '<div class="list-group mt-2">';

            while ($row = mysqli_fetch_array($sql)):
                $date = date('Y-m-d');
                if($row['today'] == $date):
                    $output .= '
                    <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">' . $row['fullname'] . '
                        <button type="button" class="btn btn-sm btn-success">See</button>
                    </li>';
                else:
                    $output .= '
                <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">' . $row['fullname'] . '
                    <div class="btn-group delete">
                        <button type="button" class="btn btn-sm btn-success approuved" id="' . $row['id'] . '">Approuved</button>
                        <button type="button" class="btn btn-sm btn-danger">Not Approuved</button>
                    </div>
                </li>';
                endif;
            endwhile;
            $output .= '</div>';
        } else {
            $output .= '<p class="alert alert-danger">There no data</p>';
        }
        print $output;
    }
    if ($_POST['action'] == 'array') {
        $num = count($_POST['name']);

        if ($num > 1) {
            for ($i = 0; $i < $num; $i++) {

                if (trim($_POST['name'][$i]) != '') {

                    $sql = mysqli_query($con, "INSERT INTO children(`name`) VALUES('" . $_POST['name'][$i] . "')");
                    if ($sql) {
                        print "success";
                    } else {
                        print 'error ';
                    }
                }
            }
        }
    }
    // insert
    if ($_POST['action'] == 'insert') {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $fullname = mysqli_real_escape_string($con, $_POST['fullname']);

        $procedure = "CREATE PROCEDURE insertUser(IN username varchar(100), fullname varchar(100))
        BEGIN
            INSERT INTO users(username, fullname) VALUES(username, fullname);
        END;
        ";
        if (mysqli_query($con, "DROP PROCEDURE IF EXISTS insertUser")) {
            if (mysqli_query($con, $procedure)) {
                $query = "CALL insertUser('" . $username . "', '" . $fullname . "')";
                mysqli_query($con, $query);
                print "Register";
            }
        }
    }
    // select
    if ($_POST['action'] == 'select') {
        $procedure = "CREATE PROCEDURE selectUser()
        BEGIN
            SELECT * FROM users ORDER BY id DESC;
        END;
        ";
        if (mysqli_query($con, "DROP PROCEDURE IF EXISTS selectUser")) {
            if (mysqli_query($con, $procedure)) {
                $query = "CALL selectUser()";
                $res = mysqli_query($con, $query);
                $output .= '
                <table class="mt-2 table table-sm table-bordered table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th width="30%">Username</th>
                            <th width="50%">Fullname</th>
                            <th width="20%">Events</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        $output .= '
                        <tr>
                            <td>' . $row['username'] . '</td>
                            <td>' . $row['fullname'] . '</td>
                            <td>
                                <div class="btn-group events">
                                    <button id="' . $row['id'] . '" class="update btn btn-sm btn-info">edit</buttton>
                                    <button  id="' . $row['id'] . '" class="delete btn btn-sm btn-danger">Delete</buttton>
                                </div>
                            </td>
                        </tr>
                        ';
                    }
                } else {
                    $output .= '<td colspan="3" class="text-danger text-center">There is no data registered</td>';
                }
                $output .= '
                </tbody>
                <tfoot>
                    <tr>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Events</th>
                    </tr>
                </tfoot>
            </table>
                ';
            }
        }
        print $output;
    }

    // GetUser
    if ($_POST['action'] == 'getUser') {
        $idGet = mysqli_real_escape_string($con, $_POST['id']);
        $datas = array();
        $procedure = "CREATE PROCEDURE getUser(IN idGet int(11))
        BEGIN
            SELECT * FROM users WHERE id = idGet;
        END;
        ";
        if (mysqli_query($con, "DROP PROCEDURE IF EXISTS getUser")) {
            if (mysqli_query($con, $procedure)) {
                $query = "CALL getUser('" . $idGet . "')";
                $res = mysqli_query($con, $query);

                while ($row = mysqli_fetch_array($res)) {
                    $datas['id'] = $row['id'];
                    $datas['username'] = $row['username'];
                    $datas['fullname'] = $row['fullname'];
                }
            }
        }
        print json_encode($datas);
    }
    // Update
    if ($_POST['action'] == 'update') {
        $ID = $_POST['id'];
        $UserName = mysqli_real_escape_string($con, trim(htmlentities($_POST['username'])));
        $FullName = mysqli_real_escape_string($con, trim(htmlentities($_POST['fullname'])));

        $procedure = "CREATE PROCEDURE updateUser(IN user_id int(11), username VARCHAR(100), fullname VARCHAR(100))
        BEGIN
            UPDATE users SET username = username, fullname = fullname WHERE id = user_id;
        END
        ";
        if (mysqli_query($con, "DROP PROCEDURE IF EXISTS updateUser")) {

            if (mysqli_query($con, $procedure)) {
                $query = "CALL updateUser('" . $_POST['id'] . "','" . $UserName . "','" . $FullName . "')";
                $res = mysqli_query($con, $query);
                if ($res) {
                    print 'success';
                } else {
                    print 'error';
                }
            }
        }
    }
    if ($_POST['action'] == 'delete') {

        $procedure = "CREATE PROCEDURE deleteUser(IN user_Id int(11))
        BEGIN
            DELETE FROM users WHERE id = user_Id;
        END
        ";
        if (mysqli_query($con, "DROP PROCEDURE IF EXISTS deleteUser")) {
            if (mysqli_query($con, $procedure)) {
                $query = "CALL deleteUser('" . $_POST['id'] . "')";
                $res = mysqli_query($con, $query);
                if ($res) {
                    print 'success';
                } else {
                    print 'error';
                }
            }
        }
    }
}