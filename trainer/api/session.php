<?php
session_start();
include '../dbConn.php';
if(isset($_SESSION['logged_in'])){
  $stat = $_SESSION['logged_in'];
  $hash = $_SESSION['token'];
  $uname = $_SESSION['uname'];
  $uid   = $_SESSION['id'];
  if($stat==1){
    $sql = "SELECT * FROM `admin` WHERE `hash` LIKE '$hash'";
    if($result = mysqli_query($con, $sql)){
      $count = mysqli_num_rows($result);
      if($count==0){
        header("Location: login.php");
        exit();
      }
    }
  }else{
    header("Location: login.php");
    exit();
  }
}else{
  header("Location: login.php");
  exit();
}