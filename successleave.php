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

	ini_set('display_errors', 1);
	error_reporting(~0);
	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}

    $sql = "SELECT * FROM leave_info WHERE IDemp LIKE '%".$strKeyword."%' or name LIKE '%".$strKeyword."%' or position LIKE '%".$strKeyword."%' or idleave LIKE '%".$strKeyword."%' or leave_dt1 LIKE '%".$strKeyword."%' or leave_dt2 LIKE '%".$strKeyword."%' or CT LIKE '%".$strKeyword."%' or status_leave LIKE '%".$strKeyword."%'  ORDER BY `leave_info`.`whenmdy` DESC";
    $query = mysqli_query($conn,$sql);
    $row4 = mysqli_num_rows($query);
  
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
    <link rel="stylesheet" media="all" type="text/css" href="jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
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
<h3>ข้อมูลพนักงานที่แจ้งลาสำเร็จ</h3><br><br>
<div class="h44"><font color="white">สถิติการแจ้งลาของพนักงานแต่ละประเภท</font>
    <br><?php
          require 'config.php';
          $query1 = " SELECT * FROM leave_info WHERE  DATE(CT) = DATE(NOW())";
          $query_run = mysqli_query($conn, $query1);
          $row1 = mysqli_num_rows($query_run);
          echo '<font color="white"> พนักงานที่แจ้งลาวันนี้มีทั้งหมด : </font><b><font color="red">'."$row1".'</b></font><font color="white"> คน</font><br>';
        ?>
        <a href="Todayleave.php" onclick="window.open(this.href, '_blank', 'left=50,top=20,width=1680,height=760,toolbar=1,resizable=0'); return false;">รายละเอียด</a><br><br>
</div><br>
<div class="h22">สถิติการแจ้งลาแต่ละประเภทที่สำเร็จแล้ว</div><br><br>
<div class="row">
  <div class="column" style="background-color:#8b5f3e;">
  <?php
          require 'config.php';
          $query1 = "SELECT * FROM leave_info Where type_leave = 'ลากิจ' and status_leave = 'แจ้งการลาสำเร็จ'";
          $query_run1 = mysqli_query($conn, $query1);
          $row1 = mysqli_num_rows($query_run1);
          echo '<h6><font color="white"> ลากิจ'."<br>".'จำนวน : </font><b><font color="red">'."$row1".'</b></font><font color="white"> ครั้ง</font></h2>'
    ?>
  </div>
  <div class="column" style="background-color:#E3963E;">
  <?php
          require 'config.php';
          $query2 = "SELECT * FROM leave_info Where type_leave = 'ลาป่วย' and status_leave = 'แจ้งการลาสำเร็จ'";
          $query_run2 = mysqli_query($conn, $query2);
          $row2 = mysqli_num_rows($query_run2);
          echo '<h6><font color="white"> ลาป่วย'."<br>".'จำนวน : </font><b><font color="red">'."$row2".'</b></font><font color="white"> ครั้ง</font></h2>'
    ?>
  </div>
  <div class="column" style="background-color:#228B22;">
  <?php
          require 'config.php';
          $query3 = "SELECT * FROM leave_info Where type_leave = 'อื่นๆ' and status_leave = 'แจ้งการลาสำเร็จ'";
          $query_run3 = mysqli_query($conn, $query3);
          $row3 = mysqli_num_rows($query_run3);
          echo '<h6><font color="white"> ลาอื่นๆ'."<br>".'จำนวน : </font><b><font color="red">'."$row3".'</b></font><font color="white"> ครั้ง</font></h2>'
  ?>
  </div>
</div>
<br>
<form method="post" action="">
<fieldset>
<legend><h3>ค้นหา</h3></legend>
<?php
echo '<h4 style="font-size: 20px;"><font color="white"> พบผลลัพธ์ที่ค้นหาได้ : </font><b><font color="red">'."$row4".'</b></font><font color="white"> จำนวน</font></h2>'
?>
  <input style='width:90%' type="text" name="txtKeyword" id="date" id="txtKeyword" value="" placeholder="พิมพ์ตรงนี้เพื่อค้นหาข้อมูลของพนักงาน" onkeypress="return RestrictSpace()"/>
  <input type="hidden" name="date" class="date" readonly /> 
  <div class="h22">สามารถพิมพ์ รหัสการแจ้ง , ชื่อ-นามสกุล , รหัสพนักงาน , ตำแหน่ง , วันที่แจ้ง <br> ลาวันที่ - ถึงวันที่ หรือ สถานะการลา ที่คุณต้องการค้นหา </div><br><br>
  <input type="submit"  value="ค้นหา"></h2>
</fieldset>
</form><br><br>


<div class="h22">
<table border ='1' margin ='left'>
<tr >
    <td>รหัสการแจ้ง</td>
    <td>แจ้งเมื่อวันที่</td>
    <td>รหัสพนักงาน</td>
    <td>ชื่อ-นามสกุล</td>
    <td>ตำแหน่ง</td>
    <td>ประเภทการลา</td>
    <td>ลาวันที่</td>
    <td>ถึงวันที่</td>
    <td>หมายเหตุการลา</td>
    <td>สถานะ</td>
    <td>แก้ไขสถานะ</td>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
            <tr width='100%'>   
                <td><p><?php echo $result['idleave']?></p></td>
                <td><p><?php echo $result['whenmdy']?></p></td>
                <td><p><?php echo $result['IDemp']?></p></td>
                <td><p><?php echo $result['name']?></p></td>  
                <td><p><?php echo $result['position']?></p></td>  
                <td><p><?php echo $result['type_leave']?></p></td>
                <td><p><?php echo Date('d-m-Y',strtotime($result['leave_dt1']))?></p></td>
                <td><p><?php echo Date('d-m-Y',strtotime($result['leave_dt2']))?></p></td>
                <td><p><?php echo $result['note_leave']?></p></td>
                <td><p><?php echo $result['status_leave']?></p></td>
                <form action="updatestatus.php" method="post">
                <td>
                    <input type='hidden' name='idleave'  value="<?php echo $result['idleave'] ?>" readonly required >
                    <input type="submit" name="submitback" class="submitback" value="แก้ไข" style = "font-size:20px" onclick='myFunction()'>
                </td>
                </form>
            </tr>
<?php
}
?>

</table>
</div>
<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
</body>

<script>
function myFunction() {
  alert("สำเร็จ ! โปรดแก้ไขสถานะการลาของพนักงาน");
}
</script>

<script>
	function RestrictSpace() {
		if (event.keyCode == 32) {
			event.returnValue = false;
			return false;
		}
	}
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../jquery/development-bundle/ui/i18n/jquery.ui.datepicker-sv.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery-ui.min.js"></script>
<script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="jquery-ui-sliderAccess.js"></script>
<script>

$(function() {
  $(".date").datepicker({
    dateFormat: "yy-mm-dd",
    prevText: "ย้อนหลัง",
    nextText: "ถัดไป",
    showOn: "button",
    language: "th",
    buttonImage: "https://htmlcssphptutorial.files.wordpress.com/2015/09/b_calendar.png",
    buttonImageOnly: true,
    buttonText: "เลือกวันเดือนปีที่ต้องการค้นหา",
    monthNames: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
      "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
    monthNamesShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "	พ.ค.", "มิ.ย.",
      "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
    dayNamesMin: ["อา","จ", "อ", "พ", "พฤ", "ศ", "ส"],
    dayNames: ["อาทิตย์","จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
    onSelect: function(dateText) {
      $(this).prev().val(dateText);
    }
  });
  $('input + .date').prev().on('change', function() {
    var dateStr = this.value.split(/[\/-]/);
     $(this).next().datepicker("setDate", new Date(dateStr[2], dateStr[1] - 1, dateStr[0]) );
  })
});

</script>
