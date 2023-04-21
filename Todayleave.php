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

    $query = "SELECT * FROM leave_info WHERE DATE(CT) = DATE(NOW())";
    $run = mysqli_query($conn,$query); 

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
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
<h3>ข้อมูลพนักงานที่แจ้งลาวันนี้</h3><br><font color="white"><b>ณ วันที่ <?php echo "วันที่ " . DateThai("$strDate");?> </b></font><br><br>
<div class="h22">
<?php

			echo "<table border ='1' margin ='left'>";
			echo "<tr ><td>รหัสการแจ้ง</td><td>แจ้งเมื่อวันที่</td><td>รหัสพนักงาน</td><td>ชื่อ-นามสกุล</td><td>ตำแหน่ง</td><td>ประเภทการลา</td><td>ลาวันที่</td><td>ถึงวันที่</td><td>หมายเหตุการลา</td></td>";
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
                        </tr>
                   ";  
              }  
               
         } 
?>
</table>
</div>
<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
</body>