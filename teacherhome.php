<?php
   include('session.php'); 
   $role = $_SESSION['user_role'];
   if(!isset($_SESSION['user_role']) | $_SESSION['user_role'] != 'teacher' ){
      header("Location: login.php");
   }
?>
<html">
   
   <head>
      <title>Main Menu </title>
    	<link rel = "stylesheet" href = "studenthome.css">
 
</head>
   
<body>
      <header><h2 id="sighout" style="text-align:left;"><?php echo $login_user ?> (<?php echo $user_role ?>)</h2>
         <h2><a id="sighout" href = "logout.php">Sign Out <img src="https://home.realart.com/assets/img/icon_logout.png" width="20px"> </a></h2></header>
         <h1> Welcome </h1>
<!-- update grades of student in the section they teach -->
       <button class="button pink" name = "update grade" onclick = "location.href = 'update-grade.php'"> Update Grade <div class="button__horizontal"></div><div class="button__vertical"></div></button>

<!-- view info of students under advise -->
       <button class="button white" name = "update grade" onclick = "location.href = 'read-student-for-teacher.php'"> Show Students Under Advise <div class="button__horizontal"></div><div class="button__vertical"></div></button>
       <!-- clicking on the student name should show his/her detailed info. -->


     </body>
   
</html>