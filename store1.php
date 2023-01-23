<?php
$connect = mysqli_connect("localhost", "root", "", "piechart");
$query = "SELECT dname, SUM(revenue) as Total_Revenue FROM dep d LEFT JOIN rev r ON d.depid = r.revdepid GROUP BY dname";
$result = mysqli_query($connect, $query);
$rows = array();
$table = array();
$table['cols'] = array(
    array('label' => 'Department Name', 'type' => 'string'),
    array('label' => 'Total Revenue', 'type' => 'number')
);

while($row = mysqli_fetch_array($result))
{
    $temp = array();
    $temp[] = array('v' => (string) $row['dname']); 
    $temp[] = array('v' => (float) $row['Total_Revenue']); 
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;

?>