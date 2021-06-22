<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

// Global Variables
$output = "";
$errors = array();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'attendance') {
        $sql = mysqli_query($con, "SELECT * FROM users ORDER BY id DESC");
        if (@mysqli_num_rows($sql) > 0) {
            $sql2 = mysqli_query($con, "SELECT * FROM attendance");
            $data = @mysqli_fetch_array($sql2);

            $output .= '<div class="list-group mt-2">';

            while ($row = mysqli_fetch_array($sql)) {
                if ($row['id'] == $data['users_id']) :
                    $output .= '
                <li href="#" class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">' . $row['fullname'] . '
                    <div class="btn-group delete">
                        <button type="button" class="btn btn-sm btn-success approuved" id="' . $row['id'] . '">Approuved</button>
                        <button type="button" class="btn btn-sm btn-danger">Not Approuved</button>
                    </div>
                </li>';
                else :
                    $output .= '
                    <li href="#" class="list-group-item d-flex justify-content-between align-items-center">' . $row['fullname'] . '
                        <div class="btn-group delete">
                            <button class="btn btn-sm btn-success">Approuved</button>
                            <button class="btn btn-sm btn-danger">Not Approuved</button>
                        </div>
                    </li>';
                endif;
            }
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