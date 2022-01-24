<?php
    $output = "";
    $con = mysqli_connect("localhost", "root", "", "crudajax") or die("couldn't connect to the DB");

    $sql = mysqli_query($con, "SELECT * FROM users");

    if(@mysqli_num_rows($sql) > 0){
        $output .= '<table class="table table-striped">
            <tbody>
        ';
        $data = mysqli_fetch_array($sql);
        
        while($row = mysqli_fetch_array($sql)) {
            $output .= '
                <thead>
                    <th>
                        <h3>'.$row['username'].'</h3>
                    </th>

                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span>
                                '.$row['fullname'].'
                            </span>
                            <br/>
                            <span>
                                '.$row['username'].'
                            </span>
                        </td>
                    </tr>
                </tbody>
            ';
        }
        $output .= '
            </tbody>
        </table>';
    }else{
        $output = '<p class="alert alert-danger my-2">There no data</p>';
    }
    print_r($output);

?>