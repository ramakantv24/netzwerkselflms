<?php
session_start();
ob_start();
include 'dbConn.php';
//check login status
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
//exit


if(isset($_GET['id']) AND isset($_GET['conf'])){
	$id = $_GET['id'];
	$conf = $_GET['conf'];
  if($conf=='yes'){
    //echo 'yes let\'s delete';
    $sql = "UPDATE `courses` SET `status` = '0' WHERE `ID` LIKE '$id'";
    if(mysqli_query($con, $sql)){
      echo "<script>alert('Deleted. Please Refresh');window.close();</script>";
    }else
      echo "<script>alert('Error!')</script>";
  }
  exit();
}

if(isset($_GET['id']) AND isset($_GET['n'])){
	$id = $_GET['id'];
  $name = $_GET['n'];
  echo '<a href="deleteCS.php?id='.$id.'&conf=yes"><button>Confirm Delete - '.$name.'</button>';
}else
	exit('No Parameter passed');