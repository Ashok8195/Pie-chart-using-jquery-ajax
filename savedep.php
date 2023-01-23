<?php
$con = mysqli_connect("localhost", "root", "", "piechart");
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $depid=$_POST['depid'];
    $dname=$_POST['dname'];
    $qry="insert into dep values($depid,'$dname')";
    $res= mysqli_query($con, $qry);
    if(mysqli_affected_rows($con)>0)
    {
        echo 'Data save';
    }
    else 
    {
        echo 'Data not save';
    }
}
