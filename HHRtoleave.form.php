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

    if(isset($_POST['submit'])){
      $id = mysqli_real_escape_string($conn, $_POST['id']);
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $IDemp = mysqli_real_escape_string($conn, $_POST['IDemp']);
      $position = mysqli_real_escape_string($conn, $_POST['position']);
      $type_leave = mysqli_real_escape_string($conn, $_POST['type_leave']);
      $note_leave = mysqli_real_escape_string($conn, $_POST['note_leave']);
      $leave_dt1 = mysqli_real_escape_string($conn, $_POST['leave_dt1']);
      $leave_dt2 = mysqli_real_escape_string($conn, $_POST['leave_dt2']);
      $whenmdy = mysqli_real_escape_string($conn, $_POST['whendmy']);
      $CT = mysqli_real_escape_string($conn, $_POST['CT']);
      $idleave = "TPF".rand(1000,10000);

      $message = ["สำเร็จ ! ส่งข้อมูลแล้วเรียบร้อย กำลังกลับสู่หน้าหลัก"];
      mysqli_query($conn, "INSERT INTO `leave_info`(id ,name, IDemp, Position, type_leave, note_leave, leave_dt1, leave_dt2, status_leave, whenmdy, idleave, CT) VALUES('$id','$name','$IDemp','$position','$type_leave','$note_leave','$leave_dt1','$leave_dt2','ส่งถึง HR แล้ว','$whenmdy','$idleave','$CT')") or die('query failed');
      header('refresh:1.3;');


      $IDemp = $_POST['IDemp'];
      $name = $_POST['name'];
      $position = $_POST['position'];
      $type_leave = $_POST['type_leave'];
      $leave_dt1 = $_POST['leave_dt1'];
      $leave_dt2 = $_POST['leave_dt2'];
      $note_leave = $_POST['note_leave'];

      $sToken = "xx25Orf8PJsT6zP4vcOogolImWaU90MU5jEzx2OtaTd";
      $sMessage = "\n" . "มีข้อมูลการแจ้งลางานเข้ามา 📣 " . "\n" . "\n". '🔔รหัสการแจ้ง : '. $idleave . "\n" .'🆔 รหัสพนักงาน : ' . $IDemp . "\n" . '👷‍♂️ ชื่อ : ' . $name . "\n" . '✍🏻 แผนก : ' . $position . "\n" . '📒 ประเภทการลา : ' . $type_leave . "\n" . '🧳 ลาตั้งแต่วันที่ : ' . date('d-m-Y',strtotime($leave_dt1)) . "\n" . '🔙 ถึงวันที่ : ' . date('d-m-Y',strtotime($leave_dt2)) . "\n" . '🗉 หมายเหตุการลา : ' . $note_leave;
                                                                                                          
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      date_default_timezone_set("Asia/Bangkok");
    
      $chOne = curl_init(); 
      curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
      curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
      curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
      curl_setopt( $chOne, CURLOPT_POST, 1); 
      curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
      $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
      curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
      curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
      $result = curl_exec( $chOne ); 
  
      curl_close( $chOne );   
      
      }

    if(isset($message)){
        foreach($message as $message){
           echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
    }

 $query=mysqli_query($conn,"select * from `user_info` where id='$id'");
 $row=mysqli_fetch_array($query);


 $query = "select * from leave_info where id = '$id' ORDER BY leave_dt1 and leave_dt2 DESC ";  
 $run = mysqli_query($conn,$query); 


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
<div class="wrapper1 fadeInDown1">
<div id="formContent1">
          <h1>ข้อมูลพนักงาน</h1>
          <font color='red'><h2>รหัสพนักงาน : </font>  <?php echo $row['IDemp']?></h2>
          <font color='red'><h2>ชื่อ - นามสกุล  : </font> <?php echo $row['name']?></h2>
          <font color='red'><h2>ตำแหน่ง  : </font><?php echo $row['position']?></h2><br>
          <a href="process.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');" class="btn1">ออกจากระบบ</a>
          <a href="Checkleaveuser.php" class="btn2">ข้อมูลการลาของพนักงาน</a>
          <a href="Addpermission.php" class="btn3" name="Addpermission">การให้สิทธิ์</a>
</div>
<br><br>

<div id="formContent1">
<div class="h22">แจ้งปัญหาการใช้งาน เบอร์ 108 (IT Support) </div><br><br>
<button class="tablink" onclick="openPage('Home', this, 'Blue')" id="defaultOpen">แจ้งลางาน</button>
<button class="tablink" onclick="openPage('News', this, 'green')">ตรวจสอบ</button>
<div id="Home" class="tabcontent">
<form action="" method="post" onSubmit="return confirm('ข้อมูลการแจ้งลาของคุณถูกต้องหรือไม่ ?')">
    <h3>แบบฟอร์มแจ้งการลางาน</h3><br>
    <h2><label>ชื่อ - นามสกุล (ไม่ต้องใส่คำนำหน้า)</label><br>
      <input type="hidden" name="CT"   placeholder="ชื่อ-นามสกุลของคุณ" value="<?php echo date('Y-m-d')?>" readonly required><br>
      <input type="hidden" name="id" placeholder="ชื่อ-นามสกุลของคุณ" value="<?php echo $row['id']?>" readonly required><br>
      <input type="text" name="name" placeholder="ชื่อ-นามสกุลของคุณ" value="<?php echo $row['name']?>" readonly required><br>

    <label>รหัสพนักงาน</label><br>
      <input type="text" name="IDemp" placeholder="รหัสพนักงานของคุณ"  value="<?php echo $row['IDemp']?>" readonly  required><br>

    <label>แผนก</label><br>
      <input type="text" name="position" placeholder="แผนกของคุณ"  value="<?php echo $row['position']?>" readonly required><br><br>
<hr><br>
    <label>ประเภทการลา</label><br>
    | <input type="radio"  name="type_leave" value="ลากิจ" required>ลากิจ
    | <input type="radio"  name="type_leave" value="ลาป่วย" required>ลาป่วย | 
      <input type="radio"  name="type_leave" value="อื่นๆ" required>อื่น ๆ |  <br><br>
      <label><b>หมายเหตุการลา</b><br>หากนอกเหนือจากการลากิจ และ ลาป่วย โปรดใส่หมายเหตุการลาของคุณ</label><br>
      <textarea name="note_leave" rows="10" cols="80" placeholder="หมายเหตุการลา" maxLength="50"></textarea><br><br>
<hr><br>


    <label>ลาตั้งแต่วันที่</label><br>
      <input type="date" name="leave_dt1" required min="<?= date('Y-m-d'); ?>"><br>
    <label>ถึงวันที่</label><br>
      <input type="date" name="leave_dt2" required min="<?= date('Y-m-d'); ?>"><br><br>

      <?php
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
			  ?>
		  <input type="hidden" name="whendmy" value="<?php echo DateThai("$strDate");?>">
      <input type="submit" name="submit" value="ส่งข้อมูล"></h2><br>
      <div class="h22">โปรดตรวจสอบข้อมูลการลาของคุณให้เรียบร้อยก่อนกดส่งข้อมูล</class>
    </div>
   </form>
</div>


<div id="News" class="tabcontent">
  <h3>ตรวจสอบการลางาน</h3><br>
  <div class="h22">หากต้องการยกเลิกการลาโปรดแจ้งฝ่าย HR</class><br><br>
  <?php
          require 'config.php';
          $query1 = "SELECT * FROM leave_info Where id = '$id'";
          $query_run = mysqli_query($conn, $query1);
          $row1 = mysqli_num_rows($query_run);
          echo '<div class="h22"> จำนวนที่คุณแจ้งลาไปทั้งสิ้น : <b><font color="red">'."$row1".'</b></font> ครั้ง</div>'
?><br><br>
  <?php
			echo "<table border ='1' margin ='left' color ='white' width='100%'>";
			echo "<tr color ='white'><td>รหัสการแจ้ง</td><td>รหัสพนักงาน</td><td>ชื่อ-นามสกุล</td><td>ตำแหน่ง</td><td>ประเภทการลา</td><td>ลาวันที่</td><td>ถึงวันที่</td><td>หมายเหตุการลา</td><td>สถานะ</td></td>";
      $i=1;  
      if ($num = mysqli_num_rows($run)) {  
           while ($result = mysqli_fetch_assoc($run)) {  
                echo "
                        <tr width='100%' color ='white'>   
                             <td><p>".$result['idleave']."</p></td>
                             <td><p>".$result['IDemp']."</p></td>
                             <td><p>".$result['name']."</p></td>  
                             <td><p>".$result['position']."</p></td>  
                             <td><p>".$result['type_leave']."</p></td>
                             <td><p>".Date('d-m-Y',strtotime($result['leave_dt1']))."</p></td>
                             <td><p>".Date('d-m-Y',strtotime($result['leave_dt2']))."</p></td>
                             <td><p>".$result['note_leave']."</p></td>
                             <td><p>".$result['status_leave']."</p></td>
                        </tr>
                   ";  
              }  
               
         } 
	?>    
</div>
</body>
</html>

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

document.getElementById("defaultOpen").click();
</script>


