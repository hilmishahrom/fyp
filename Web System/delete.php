<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['ptmsaid']==0)) {
  header('location:logout.php');
  } else{
  	$id = $_GET['viewid'];

// sql to delete a record
$sql = "DELETE FROM reg_tag WHERE rfid_uid = '$id'"; 

if (mysqli_query($con, $sql)) {
    mysqli_close($con);
    echo '<script>alert("Ticket has been paid.")</script>';
    header('Location: manage-normal-ticket.php'); 
    exit;
} else {
    echo "Something Went Wrong. Please try again.";
}

}
  
 ?>