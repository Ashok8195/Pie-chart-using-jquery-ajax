<?php
$conn = mysqli_connect('localhost', 'root', '', 'piechart');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
$depid = $_POST["depid"];
$qry1="delete from emp where empdep=$depid";
$qry2="delete from rev where revdepid=$depid";
$qry3="delete from dep where depid=$depid";

$res1 = mysqli_query($conn, $qry1);
$res2= mysqli_query($conn, $qry2);
$res3= mysqli_query($conn, $qry3);
  if (mysqli_affected_rows($conn) > 0)
   {
      echo "data deleted";
  } 
  else 
  {
      echo "data not deleted";
   // echo "error" . $qry . "<br>" . $conn->error;
  }
}
