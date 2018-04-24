<?php
	include "session.php";
	$role = $_SESSION['user_role'];
   	if(!isset($_SESSION['user_role']) | $_SESSION['user_role'] != 'student' ){
      	header("Location: login.php");
   	}
?>

<html>
	
	<head>
		<title>ดูรายวิชาที่ลงทะเบียนเรียน</title>
		
		<link rel = "stylesheet" href = "form.css" >
		 <link rel= "stylesheet" href = "backbutton.css">
		 <link rel = "stylesheet" href= "sidebar.css">
		 <link rel = "stylesheet" href = "tablee.css">
	</head>
	<body bgcolor = "#FFFFFF">
		<div class="splitleft" >
			  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Phra_Kiao.svg/1200px-Phra_Kiao.svg.png"  style="max-width:50%;
			max-height:100%; padding-bottom:20px;" />
			  <p id="regcu">REG CU</p>
			  <div class = "asdf">
			  
			  <button class="accordion"> Personal Information </button>
			  <div class = "panel">
			    <button class="inacc" onclick="location.href='showInfo.php'">Payment Info </button>
			    <button class="inacc" onclick="location.href='showTranscript.php'">Transcript </button>
			    
			  </div>
			  <div class = "panel">
			    <button class="inacc" onclick="location.href='logout.php'">Logout </button>
			  </div>

			  <button class="accordion"> Course </button>
			  <div class = "panel">
			    
			    <button class="inacc" onclick="location.href='EnrollCourse.php'">Enroll </button>
			    <button class="inacc" onclick="location.href='Withdraw.php'"> Withdraw </button>
			    <button class="inacc" onclick="location.href='SearchCourses.php'"> Search Courses </button>
			    <button class="inacc" onclick="location.href='showEnrolledCourse.php'"> Show Enrolled Course </button>


			  </div>
			  <button class="accordion"> Scholarships </button>
			  <div class = "panel">
			    <button class="inacc" onclick="location.href='ViewSch.php'"> View Scholarships </button>
			    <button class="inacc" onclick="location.href='ApplySch.php'"> Check Scholarship Qualification </button>
			  </div>
			</div></div>
		<div class = "splitright">
		<button class="back" onclick="location.href='studenthome.php'">◄</button>
		<div style="padding-left: 20px;">
		
		<h1 style = "font-size: 30px"> Show Enrolled Course </h1>
         <p align = "center"> ดูรายวิชาที่ลงทะเบียนเรียน เลือกปีการศึกษาและภาคเรียนที่ต้องการ </p>
      	</div>
      <div align = "center">
         <div class="form"  align = "left">
            <div class="formtitle"><b>select semester and year</b></div>
				
            <div style = "margin:30px; width: 500px;">
               
               <form action = "" method = "post" style="width: 500px;">
                  <label>YEAR  :</label>
                  <input type = "number" value="2017" min="2000" max="2018" name = "year" class = "box" /><br><br>
               
                  <label>SEMESTER  :</label>
                  <br>

                  &emsp;<input type = "radio" name = "semester" class = "box" value="1" /><label> ภาคต้น </label><br>
                  &emsp;<input type = "radio" name = "semester" class = "box" value="2" /><label> ภาคปลาย </label><br>
                  &emsp;<input type = "radio" name = "semester" class = "box" value="3" /><label> ภาคฤดูร้อน </label><br>
                  <input class="submitbutton" type = "submit" value = " Show "/><br /><br>
               </form>
              
					
            </div>
				
         </div>
			
      </div>
      
      <script>
var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0 ; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
        });
    }

</script>
   

<?php
//showEnrolledCourse.php
	
	if(isset($_POST['semester']) and isset($_POST['year'])){
	$SEM = $_POST['semester'];
	$YEAR = $_POST['year'];
	$query = "SELECT S.cid, C.cname, C.credits, T.tname FROM section S, course C, teacher T, enroll E WHERE S.cid = E.cid and E.cid = C.cid  and E.sec_id = S.sec_id and T.tid = S.tid and S.sem = " .$SEM." and S.yearr = ".$YEAR. ' and E.sid = "' . $user_check . '";';
	$result = mysqli_query($db, $query);
	if(!$result){
		$error = "Error fetching";
		include 'error.html.php';
		exit();
	}
	
	include "showEnrolledCourse.html.php";

	}

?>
</div>
</body>
</html>