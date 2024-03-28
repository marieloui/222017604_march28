<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:login.html");
    exit();    # code...
}
$connection =new mysqli("localhost","root","","mytest");
if ($connection->connect_error) {
    die("Connection failed:".$connection->connect_error);
    # code...
}
$user_id =$_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"]==POST) {
    $firstname =$_POST['firstname'];
    $lastname =$_POST['lastname'];

    $sql ="UPDATE profile SET firstname='$firstname',lastname='$lastname',isCompleted=1 WHERE user_id='$user_id'";
    if ($connection->query($sql)==TRUE) {
        echo "Profile updated Successfuly";
        header("Location:#");
        # code...
    }else{
        echo "Error updating Profile:".$connection->error;
    }

}
$connection->close();

?>