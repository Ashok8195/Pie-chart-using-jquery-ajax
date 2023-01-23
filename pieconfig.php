<?php
$host="localhost";
$uname="root";
$upass="";
$dbname="piechart";
$conn=mysqli_connect($host,$uname,$upass,$dbname);
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$sql = "SELECT d.dname, SUM(r.revenue) as revenue FROM dep d INNER JOIN rev r ON d.depid = r.revdepid
        WHERE month BETWEEN '".$fromdate."' AND '".$todate."' GROUP BY d.dname ORDER BY revenue DESC";
//$sql="SELECT d.dname, SUM(r.revenue) AS revenue FROM dep d INNER JOIN rev r ON d.depid = r.revdepid WHERE '".$fromdate."'<= month <= '".$todate."' GROUP BY d.dname ORDER BY revenue DESC";
$result = $conn->query($sql);
$response = array();
while($row = $result->fetch_assoc()){
    array_push($response, $row);
}
echo json_encode($response);
?>