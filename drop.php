<?php
    $conn = mysqli_connect('localhost', 'root', '', 'piechart');
    $qry = "select * from dep";
    $res = mysqli_query($conn, $qry);
    $data=array();
    if(mysqli_num_rows($res) > 0){
    while ($r = mysqli_fetch_array($res)) {
       $data[]=$r;
    }
    }
    echo json_encode($data);
    ?>