<?php
$conn = mysqli_connect('localhost', 'root', '', 'piechart');
$depid = $_POST["depid"];
$qry = "select * from emp,dep where empdep=depid and empdep='$depid'";
$res = mysqli_query($conn, $qry);
$data = array();
if ($res->num_rows > 0) {
    while ($r = mysqli_fetch_array($res)) {
        $data[] = $r;
    }
}
echo json_encode($data);
?>