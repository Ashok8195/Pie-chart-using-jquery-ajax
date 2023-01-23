<?php
$conn = mysqli_connect('localhost', 'root', '', 'piechart');
$qry = "SELECT dep.dname, dep.depid, COUNT(emp.empid) as total_revenue, SUM(rev.revenue) as total_employees FROM dep LEFT JOIN emp ON dep.depid = emp.empdep LEFT JOIN rev ON dep.depid = rev.revdepid GROUP BY dep.dname, dep.depid ORDER BY dep.dname";
$res = mysqli_query($conn, $qry);
echo "<form method='POST'>";
echo "<table>";
while ($r = mysqli_fetch_array($res)) {
    echo '<tr>';
    echo "<td> $r[dname] </td>";
    echo "<td> $r[total_employees] </td>";
    echo "<td> $r[total_revenue] </td>";
    echo "<td> <input type=button class='btn-danger m-2 'onclick='deleteData($r[depid])' value='delete'> </td>";
    echo '</tr>';
}
echo "</table>";
echo "</form>";
  ?>