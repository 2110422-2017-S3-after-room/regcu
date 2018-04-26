<?php 
    include "session.php";
   include "checkstudent.php";
?>

<!DOCTYPE html>
<html>
	<head>
      <link rel="stylesheet" href="form.css">
      <link rel="stylesheet" href= "backbutton.css">

      <link rel="stylesheet" href= "sidebar.css">
      <script type="text/javascript">
         function addRow(){
            var table = document.getElementById("myTable");
            var rows = document.getElementById("myTable").rows.length;
            var row = table.insertRow(rows);
            for(var i = 0; i < 1; i++){
               var cell1= row.insertCell(i);
               var inputItem = document.createElement('input');
               cell1.appendChild(inputItem);
            }
         }
      </script>
      <title>Enroll Course </title>
   </head>
   <?php include 'splitleft.html'; ?>
   <body bgcolor = "#FFFFFF" >
      <button class="back" onclick="location.href='studenthome.php'">◄</button>
      <h1>Enroll Course</h1>
	   <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>select semester and year</b></div>
				
            <div style = "margin:30px">
               
               <form name = "myForm" action = "?" method = "post">
                  <label>course ID :</label>
                  <input type = "number" name = "courseID" class = "box" /><br><br>
                  <label> section  :</label>
                  <input type = "number" name = "sectionID" class = "box" /><br/><br />
                  <input type = "submit"  value = " Submit "/><br />
               </form>
              
         </div></div></div>
   </body>

</html>

<?php
  

   
   $SEM = "2";
   $YEAR = "2017";
   if (isset($_POST['courseID']) AND isset($_POST["sectionID"])) 
   { 
      $CID = $_POST["courseID"];
      $SEC = $_POST["sectionID"];
      $query = "SELECT count(*) as count FROM section S  WHERE S.cid = " .$CID . ' and S.sec_id = '.$SEC . ' and S.yearr = '. $YEAR. " AND S.sem =  " . $SEM .";"; 
   $validCourse = mysqli_query($db, $query);
   if(!$validCourse){
      echo '<script language="javascript">';
            echo 'alert("ERROR: cannot fetch course")';
            echo '</script>';
      exit();
   }
   $row = mysqli_fetch_array($validCourse);
   if($row['count'] != 1){ //ไม่มีวิชา-เซคนี้
      echo '<script language="javascript">';
            echo 'alert("ERROR: No matching course/section")';
            echo '</script>';
      exit();
   } 

   // check enrolled.
$query3 = 'SELECT count(*) as count, sec_id FROM enroll  WHERE sid ="'.$user_check.'" and cid = "'.$CID. '" and yearr = '.$YEAR .' and sem = '.$SEM.';';
$enrolledThisCourse = mysqli_query($db, $query3);
if(!$enrolledThisCourse){
  echo '<script language="javascript">';
            echo 'alert("ERROR: Cannot fetch enroll")';
            echo '</script>';
   exit();
}else{ 
   $row3 = mysqli_fetch_array($enrolledThisCourse);
   if($row3['count'] == 0){ // not enrolled in this semester
      //valid course. check credits
      $query2 = 'SELECT sum(C.credits) as totalCredit 
                  from enroll E, course C 
                  where E.sid = "'.$user_check.'" and E.yearr = '.$YEAR. ' and E.sem = ' .$SEM. ' and C.cid = E.cid 
                  GROUP BY E.sid ;';
      $checkCredit = mysqli_query($db, $query2);
      if(!$checkCredit){
         echo '<script language="javascript">';
            echo 'alert("ERROR : cannot fetch credit")';
            echo '</script>';
         exit();
      }else{
         $row2 = mysqli_fetch_array($checkCredit);
         $totalCredit = $row2["totalCredit"];
         if($totalCredit > 19){
               echo '<script language="javascript">';
            echo 'alert("Sorry, you do not have enough credits")';
            echo '</script>';
               exit();
         }
      }
      //have enough credit
      $query4 = 'INSERT INTO enroll SET sid ="'.$user_check.'", cid = "'.$CID. '" , sec_id = "' .$SEC. '", yearr = ' . $YEAR . ' ,sem = '.$SEM.';';
      $insertR = mysqli_query($db,$query4);
      if(!$insertR){
         echo '<script language="javascript">';
            echo 'alert("Error : Fail to insert into enroll")';
            echo '</script>';
         exit();
      }else{
         echo '<script language="javascript">';
            echo 'alert("SUCCESS! Course Enrolled.")';
            echo '</script>';
         exit();
      }
   }else{ // enrolled in this semester -> check sec_id
      if($row3['sec_id'] == $SEC){
         echo '<script language="javascript">';
            echo 'alert("ERROR: You cannot enroll on a course you are already taking.")';
            echo '</script>';
         exit();
      }else{
         $query5 = 'UPDATE enroll SET sec_id ='.$SEC.' WHERE sid = ' .$user_check.' and cid = '.$CID.' and yearr ='.$YEAR. ' and sem = ' .$SEM.';' ;
         $updateS = mysqli_query($db,$query5);

         if(!$updateS){
            echo '<script language="javascript">';
            echo 'alert("ERROR cannot update enroll!")';
            echo '</script>';
            exit();
         }else{
            echo '<script language="javascript">';
            echo 'alert("section changed!")';
            echo '</script>';
             exit();          
         }     
      }
   }
}
}
?>
    