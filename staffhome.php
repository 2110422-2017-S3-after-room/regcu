<?php
   include('session.php'); 
   include('checkstaff.php');
?>

<!DOCTYPE html>
<html">
   
   <head>
      <title>Main Menu </title>
    	<link rel = "stylesheet" href = "studenthome.css">
 
</head>
   
<body>
        <header><h2 id="sighout" style="text-align:left;"><?php echo $login_user ?> (<?php echo $user_role ?>)</h2>
         <h2><a id="sighout" href = "logout.php">Sign Out <img src="https://home.realart.com/assets/img/icon_logout.png" width="20px"> </a></h2></header>

      <h1> Welcome </h1>

       <!-- add/edit/remove course -->
      <button class="button pink" name = "ManageCourse" onclick="location.href='manageCourse.php'" > Manage Course <div class="button__horizontal"></div><div class="button__vertical"></div></button> 

      <!-- add/edit/remove teacher -->
      <button class="button pink" name = "ManageTeacher" onclick="location.href='manageTeacher.php'" > Manage Teacher <div class="button__horizontal"></div><div class="button__vertical"></div></button> 
 
      <!-- add/edit/remove a student, show students info -->
      <button class="button white" name = "Manage Student" onclick="location.href='manageStudent.php'"> Manage Student  <div class="button__horizontal"></div><div class="button__vertical"></div></button>
      
      
      <button class="button pink" name = "ManageScholarship" onclick="location.href='manageScholarship.php'"> Manage Scholarship <div class="button__horizontal"></div><div class="button__vertical"></div></button>

   </body>
   
</html>