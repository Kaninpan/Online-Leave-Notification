<?php
    include 'config.php';
    session_start();
    $id = $_SESSION['id'];
    $Class = $_SESSION['Class'];

    if($_SESSION["Class"]=="Head of HR"){ 
      //$message ="OK";            
    }else{
      header('location:dont.go.php');
    }

    if(!isset($id)){
        header('location:index.php');
    };
  
    if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
    }
    $query = "select * from user_info WHERE position = 'HR' and Class = 'User' or Class = 'HR' ORDER BY `user_info`.`IDemp` ASC";
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
  <a href='HHRtoleave.form.php' class="active"> ย้อนกลับ</a>
</div>
<body>
<div class="wrapper1 fadeInDown1">
<div id="formContent1">
<h3>การให้สิทธิ์</h3><br>
<div class="h22">เป็นการให้สิทธิ์แก่พนักงานที่สามารถอนุมัติการลาได้</div><br><br>
<div class="h22">
<?php

			echo "<table border ='1' margin ='left'>";
			echo "<td>รหัสพนักงาน</td><td>ชื่อ-นามสกุล</td><td>ตำแหน่ง</td><td>สิทธิ์พิเศษ</td><td>ตัวเลือก</td></td>";
      $i=1;  
      if ($num = mysqli_num_rows($run)) {  
           while ($result = mysqli_fetch_assoc($run)) {  
                echo "  
                        <tr width='100%'>   
                             <td><p>".$result['IDemp']."</p></td>
                             <td><p>".$result['name']."</p></td>  
                             <td><p>".$result['position']."</p></td>  
                             <td>
                             <form action = 'updatestatus.php' method='POST'>
                             <select name='Class' required value=<?php echo ".$result['Class']."?>>
                                     <option value=''hidden>การให้สิทธิ์..</option>
                                     <option value='HR'>สิทธิ์ : HR</option>
                                     <option value='User'>สิทธิ์ : User</option>

                             </select><br>
                            สิทธิ์ตอนนี้คือ : ".$result['Class']."
                                 <input type='hidden' name='id'  value=".$result['id']." readonly required ></td>
                             <td>
                                    <input type='submit' name='submit1' onclick='myFunction()'  value='ให้สิทธิ์'>
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
  alert("อัพเดทสิทธิ์แล้วเรียบร้อย");
}
</script>
