<?php
    include 'config.php';
    session_start();
    $id = $_SESSION['id'];
    $Class = $_SESSION['Class'];

    if($_SESSION["Class"]=="HR" || $_SESSION["Class"]=="Head of HR"){ 
        //$message ="OK";            
    }else{
        header('location:dont.go.php');
    };

    if(!isset($id)){
        header('location:index.php');
    };
  
    if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
    }

    $query = "select * from leave_info WHERE status_leave = 'ส่งถึง HR แล้ว' ORDER BY `leave_info`.`whenmdy` DESC";
    $run = mysqli_query($conn,$query); 

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" sizes="16x16" href="http://localhost/phpbasic/Project_leave/images.png"/>
    <title>แบบฟอร์มการลางาน</title>
</head>
<div class="topnav">
  <a href='processback.php' class="active"> ย้อนกลับ</a>
  <a href='Checkleaveuser.php'  class="active1">ตรวจสอบ</a>
  <a href='successleave.php'>รายงานผล</a>
</div>
<body>
<div class="wrapper1 fadeInDown1">
<div id="formContent1">
<h3>ข้อมูลการลาของพนักงาน</h3><br>
<div class="h22">รอส่งผลสถานะการลาแก่พนักงาน</div><br><br>
<div class="h22">
<?php

			echo "<table border ='1' margin ='left'>";
			echo "<tr ><td>รหัสการแจ้ง</td><td>แจ้งเมื่อวันที่</td><td>รหัสพนักงาน</td><td>ชื่อ-นามสกุล</td><td>ตำแหน่ง</td><td>ประเภทการลา</td><td>ลาวันที่</td><td>ถึงวันที่</td><td>หมายเหตุการลา</td><td>สถานะ</td><td>ตัวเลือก</td></td>";
      $i=1;  
      if ($num = mysqli_num_rows($run)) {  
           while ($result = mysqli_fetch_assoc($run)) {  
                echo "  
                        <tr width='100%'>   
                            <td><p>".$result['idleave']."</p></td>
                             <td><p>".$result['whenmdy']."</p></td>
                             <td><p>".$result['IDemp']."</p></td>
                             <td><p>".$result['name']."</p></td>  
                             <td><p>".$result['position']."</p></td>  
                             <td><p>".$result['type_leave']."</p></td>
                             <td><p>".Date('d-m-Y',strtotime($result['leave_dt1']))."</p></td>
                             <td><p>".Date('d-m-Y',strtotime($result['leave_dt2']))."</p></td>
                             <td><p>".$result['note_leave']."</p></td>
                             <td>
                             <form action = 'updatestatus.php' method='POST'>
                             <select name='status_leave' required>
                                     <option value=''hidden>แจ้งสถานะการลา..</option>
                                     <option value='แจ้งการลาสำเร็จ'>แจ้งการลาสำเร็จ</option>
                                     <option value='ยกเลิกการแจ้งลาแล้ว'>ยกเลิกการแจ้งลาแล้ว</option>
                             </select><br>
                                ".$result['status_leave']."
                                 <input type='hidden' name='idleave'  value=".$result['idleave']." readonly required ></td>
                             <td>
                                        <b><input type='submit' name='submit' onclick='myFunction()' value='ส่ง'></b>
                                 </form>
                            </td>
                        </tr>
                   ";  
              }  
               
         } 
?>
</table>
</div>
<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
</body>

<script>
function myFunction() {
  alert("สำเร็จ ! อัพเดทสถานะการแจ้งลาแล้วเรียบร้อย");
}
</script>
