<?php
    include 'config.php';
    session_start();
    $id = $_SESSION['id'];
    $Class = $_SESSION['Class'];

    if($_SESSION["Class"]=="Head of HR"){ 
        header('location:HHRtoleave.form.php');        
    }else{
       header('location:HRtoleave.form.php');
    }
    
?>
