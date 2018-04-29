<?php include 'templates\header.php';
      include 'splitleft.html';
	  include "session.php";
	  include "checkstudent.php"; ?>

<div class="splitright">
   <?php include 'backbuttonstudent.html'; ?>
   <div style="padding-left: 20px; ">
   <h1> Check qualification for scholarships </h1>
   <h2> Select the scholarship type you want to check qualification for, then click submit button. </h2><br><br>
   

   <form action="" method = "post" class="form">
      <label class="formtitle"> Check qualification for scholarships</label><br><br>

      <input type="radio" class="option-input radio" name="scholarship_type" value="A" onclick="show2();"> <label>ทุนเรียนดี</label>
      
	      <div id="div1" style="display: none; padding-left: 20px;">
	      <input type="radio"  class="option-input radio" name="sub1" value="1"> เงินทุนภูมิพลสำหรับนิสิตเรียนดีเยี่ยมและเรียนดี
	      <br><input type="radio"  class="option-input radio" name="sub1" value="2">เงินทุนภูมิพลสำหรับนิสิตเรียนดีแต่ขาดแคลน
	  		</div>    
	  <br>
      <input type="radio" class="option-input radio" name="scholarship_type" value="B" onclick="show1();"><label>ทุนอุดหนุนการศึกษา</label><br>

      <input type="radio" class="option-input radio" name="scholarship_type" value="C" onclick="show3();"><label>ทุนสร้างชื่อเสียงและทำคุณประโยชน์</label><br>
       <div id="div3" style="display: none; padding-left: 20px;">
	      <input type="radio"  class="option-input radio" name="sub3" value="1"> ด้านบริหาร
	      <br><input type="radio"  class="option-input radio" name="sub3" value="2"> ด้านวิชาการ
	      <br><input type="radio"  class="option-input radio" name="sub3" value="3"> ด้านศิลปวัฒนธรรม
	      <br><input type="radio"  class="option-input radio" name="sub3" value="4"> ด้านสังคมและบำเพ็ญประโยชน์
	  	</div>



      <input type="radio" class="option-input radio" name="scholarship_type" value="D" onclick="show4();"><label>กองทุนกู้ยืมเพื่อการศึกษา</label><br>
      <div id="div4" style="display: none; padding-left: 20px;">
	      <input type="radio"  class="option-input radio" name="sub4" value="1"> แบบ กยศ.
	      <br><input type="radio"  class="option-input radio" name="sub4" value="2"> แบบ กรอ.
	   
	  	</div>


      <input type="radio" class="option-input radio" name="scholarship_type" value="E" onclick="show5();"><label>ทุนการศึกษาจากหน่วยงานภายนอก</label>
      	<div id="div5" style="display: none; padding-left: 20px;">
	      <?php 
	      $sql2="select * from external_sch where sch_year=2017"; 
	      $res = mysqli_query($db,$sql2);
	      while($row = mysqli_fetch_array($res)){ ?>
	      	
	      	 <input type="radio"  class="option-input radio" name="sub5" value="<?= $row['sch_name'] ?>">
	      	 <label> <?= $row['sch_name'] ?></label><br>
<?php     }
	      ?>
   
	  	</div>
		<br><br>
      <input class="submitbutton" type = "submit" name = "submit" value="Submit" onclick="show1();"><br><br>
   </form>



  

  <script lang>
  	function show1(){
 		 document.getElementById('div1').style.display ='none';
 		 document.getElementById('div3').style.display ='none';
 		 document.getElementById('div4').style.display ='none';
 		 document.getElementById('div5').style.display ='none';
	}
	function show2(){
	  document.getElementById('div1').style.display = 'block';
	  document.getElementById('div3').style.display ='none';
	   document.getElementById('div4').style.display ='none';
	   document.getElementById('div5').style.display ='none';
	}
	function show3(){
		document.getElementById('div3').style.display = 'block';
		document.getElementById('div1').style.display ='none';
		document.getElementById('div4').style.display ='none';
		document.getElementById('div5').style.display ='none';
	}
	function show4(){
		document.getElementById('div4').style.display = 'block';
		document.getElementById('div1').style.display ='none';
		document.getElementById('div3').style.display ='none';
		document.getElementById('div5').style.display ='none';
	}
	function show5(){
		document.getElementById('div5').style.display = 'block';
		document.getElementById('div1').style.display ='none';
		document.getElementById('div3').style.display ='none';
		document.getElementById('div4').style.display ='none';
	}


  </script>
<?php require "templates/footer.php"; ?>
<?php
 $dbname = 'regcu';
 if(!mysqli_select_db($db, $dbname)){
   $output = "Unable to locate " . $dbname . "database :(" ;
   include 'output.html.php';
   exit();
 }

if(isset($_POST['submit'])){
	if(isset($_POST['scholarship_type'])){
		$type = $_POST['scholarship_type'];
	
		if($type == "A"){ //ทุนเรีียนดี
			include 'checkSchA.php';
		}
		else if($type == "B"){
			include 'checkSchB.php';
		}else if($type == "C"){
			include 'checkSchC.php';
		}else if($type == "D"){
			include 'checkSchD.php';
		}else if($type == "E"){
			include 'checkSchE.php';
		}
		
		else{
			echo "cant sch type";
		}
		
	}
	
}

?>

<?php

	if(isset($_POST['applynao'])){

		$xxx = $_POST['schname'];
		$y = date('Y')-1;
		$sqll = "SELECT count(*) as count FROM apply_scholarship 
		WHERE sid = '".$user_check."' 
		AND sch_name = '".$xxx."'
		AND sch_year = ".$y.";";
		$have = mysqli_query($db,$sqll);
		if(mysqli_fetch_array($have)['count'] == 1){ ?>
			<p><pre> 
	You cannot apply to this scholarship.
	Because you have already applied to this scholarship earlier. 
			</pre> </p>
<?php	}

		$sql= "INSERT INTO apply_scholarship 
		(sid, sch_name, sch_year, apply_date, app_status) 
		VALUES ('".$user_check."', 
			'".$xxx."', 
			2017 , 
			'". date('Y-m-d')."',
			 1 );";

		if(mysqli_query($db,$sql)){?>
			<p><pre> 
	application successful :]
			</pre> </p>
<?php }else{ ?>
			<p><pre> 
	application failed :<
			</pre> </p>
<?php
	
		}
	}

?>




</div></div>
<?php 
	include "templates/footer.php";
?>