<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";
  include "checkstaff.php";
    $new_user = array(
      "tid" => $_POST['tid'],
      "tname"  => $_POST['tname'],
      "dep_id"     => $_POST['dep_id']
    );
///////////////////check duplicate teacher /////////////////
    $sql =  "SELECT count(*) as countt FROM teacher S WHERE S.tid =".$_POST['tid'].";";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch teacher";
      exit();
    }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Teacher already exists. Please go to edit teacher instead.";
      exit();
    }
///////////////////check department/////////////////
    $sql =  "SELECT count(*) as count FROM department D WHERE D.dep_id =".$_POST['dep_id'].";";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch teacher";
      exit();
    }
    $row = mysqli_fetch_array($result);
    if($row['count'] == 0){
      echo "Invalid Department";
      exit();
    }

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);

 ///////////////////check department/////////////////    
    $sql2 = "INSERT INTO teacher
    (tid,tname,dep_id) 
    VALUES('".$_POST['tid']."' , '". $_POST['tname']."' , '".$_POST['dep_id']."');";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
 }

 ?>

      

<?php  
require "templates/header.php"; 
 include 'splitleft-staff.html'; ?>
<div class="splitright">
  <?php include 'backbuttonstaff.html'; ?>
  <div style="padding-left: 10px;">
  <h1>Add a teacher</h1>
  <div style="padding:20px;">

  <form method="post" class="form" style="padding-bottom: 20px; min-width: 350px; width:350px;">
    <label class="formtitle">Add a teacher</label>
    <br><br><label for="tid">Teacher ID</label>
    <input type="text" name="tid" id="tid">
    <br><label for="tname">Teacher Name</label>
    <input type="text" name="tname" id="tname">
    <br><label for="dep_id">Department ID</label>
    <input type="text" name="dep_id" id="dep_id"><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton">
  </form>
</div>
  <br>
  <a href="manageteacher.php" class="gobacklink">Back to manage teachers</a>
  </div>

<?php
  if (isset($_POST['submit']) && $statement) { 
?> 
      <blockquote><?php echo escape($_POST['tname']); ?> successfully added.</blockquote>
<?php 
  
    } ?>
</div>
<?php require "templates/footer.php"; ?>
