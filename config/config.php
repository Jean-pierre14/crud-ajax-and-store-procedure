<?php
$con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

// Global Variables
$output = "";
$errors = array();

if (isset($_POST['action'])) {

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
                <table class="table table-sm">
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
                            <td>' . $row['username'] . '</td>
                            <td>
                                <div class="btn-sm btn-group events">
                                    <button type"button" name="up" id="' . $row['id'] . '" class="btn btn-info">edit</buttton>
                                    <button type"button" name="del" id="' . $row['id'] . '" class="btn btn-danger">Delete</buttton>
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
}
