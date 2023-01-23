<?php
$conn = mysqli_connect('localhost', 'root', '', 'piechart');
$qry = "select * from emp,dep where empdep=depid";
$res = mysqli_query($conn, $qry);
echo "<table class='table table-bordered table-striped active' id='searchbar'>";
echo '<tr><th> Name </th><th> Address </th><th> Department </th><th> Salary </th></tr>';
while ($r = mysqli_fetch_array($res)) {
    echo '<tr>';
    echo "<td>$r[empname]</td>";
    echo "<td>$r[empadd]</td>";
    echo "<td>$r[dname]</td>";
    echo "<td>$r[empsal]</td>";
    echo '</tr>';
}
echo "</table>";
?>