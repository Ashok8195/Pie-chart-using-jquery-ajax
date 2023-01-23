<?php
$con = mysqli_connect("localhost", "root", "", "piechart");
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $empid=$_POST["empid"];
    $empname=$_POST["empname"];
    $address=$_POST["empadd"];
    $department=$_POST["department"];
    $salary=$_POST["empsal"];
    $email=$_POST["email"];
    $mobile=$_POST["mobile"];
    $qry="insert into emp values($empid, '$empname' , '$address' , $department , $salary , '$email' , $mobile)";
    // $res= mysqli_query($con, $qry);
    if($con->query($qry)=== true)
    {
        echo 'Data save';
    }
    else 
    {
        echo 'Data not save';
    }
}
