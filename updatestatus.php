<?php
include 'config.php';

if(isset($_POST['submit'])){
    $idleave = $_POST['idleave'];
    $status_leave = $_POST['status_leave'];
         mysqli_query($conn,"update `leave_info` set status_leave = '$status_leave'  WHERE idleave = '$idleave'");
         header('location: Checkleaveuser.php');
    }

    
if(isset($_POST['submit1'])){
    $id = $_POST['id'];
    $Class = $_POST['Class'];
         mysqli_query($conn,"update `user_info` set Class = '$Class'  WHERE id = '$id'");
         header('location: Addpermission.php');
    }

if(isset($_POST['submitback'])) {
    $idleave = $_POST['idleave'];
    $status_leave = $_POST['status_leave'];
         mysqli_query($conn,"update `leave_info` set status_leave = 'ส่งถึง HR แล้ว'  WHERE idleave = '$idleave'");
         header('location: Checkleaveuser.php');
    }
   
mysqli_close($conn);
?>