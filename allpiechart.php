<?php
$con = mysqli_connect("localhost", "root", "", "piechart");

$sql = "SELECT d.dname, sum(r.revenue) as total_revenue FROM dep d  LEFT JOIN rev r ON d.depid = r.revdepid GROUP BY d.dname";
$result = mysqli_query($con, $sql);
$data = array();
while($row = mysqli_fetch_assoc($result))
{
    $data[$row['dname']] = $row['total_revenue'];
}
echo json_encode($data);
?>