<?php
    include 'config.php';
    session_start();

    if(isset($_POST['submit'])){
      $IDemp = mysqli_real_escape_string($conn, $_POST['IDemp']);
      $mdyhbd = mysqli_real_escape_string($conn, ($_POST['mdyhbd']));

      $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE IDemp = '$IDemp' AND mdyhbd = '$mdyhbd'") or die('query failed');

      if(mysqli_num_rows($select) > 0){
          $row = mysqli_fetch_array($select);
             $_SESSION["id"] = $row["id"];
             $_SESSION["Class"] = $row["Class"];
          if($_SESSION["Class"]=="Head of HR"){ 
              Header("Location: HHRtoleave.form.php");                     
           }
           if($_SESSION["Class"]=="HR"){ 
            Header("Location: HRtoleave.form.php");                     
         }
          if ($_SESSION["Class"]=="User"){  
               Header("Location: leave.form.php");                            
          }
          }else{
              $message[] = 'โปรดกรอกข้อมูลให้ถูกต้อง';
          }
      }

      if(isset($message)){
        foreach($message as $message){
         echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
   }

   function DateThai($strDate)
   {
     $strYear = date("Y",strtotime($strDate))+543;
     $strMonth= date("n",strtotime($strDate));
     $strDay= date("j",strtotime($strDate));
     $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
     $strMonthThai=$strMonthCut[$strMonth];
     return "$strDay $strMonthThai $strYear";
   }		

     $strDate = date("d-m-Y");
      mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
	  <link rel="icon" sizes="16x16" href="http://localhost/phpbasic/Project_leave/images.png"/>
    <title>แบบฟอร์มการลางาน</title>
</head>
<body>
<div class="wrapper fadeInDown">
<h1>ระบบแจ้งลางาน</h1>
  <div id="formContent">
    <h2 class="active"> ทำการเข้าสู่ระบบของท่าน</h2><br>
    <form action="" method="post">
    <h4><?php echo "วันที่ " . DateThai("$strDate");?></h4>
      <input type="text" name="IDemp" id="login" class="fadeIn second"  placeholder="โปรดใส่รหัสพนักงาน 5 หลักของคุณ">
      <input type="password" name="mdyhbd" id="password" class="fadeIn third" placeholder="โปรดใส่วันเดือนปีเกิด เช่น 27102543"><br><br>
      <input type="submit" name="submit" class="fadeIn fourth" value="เข้าสู่ระบบ"><br>
      <h4>มีปัญหาเข้าสู่ระบบติดต่อ 108 (IT Support)</h4>

    </form><br>
</div>
</body>
</html>