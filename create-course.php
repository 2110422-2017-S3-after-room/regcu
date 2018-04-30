<?php

 require "templates/header.php"; 
 include "splitleft-staff.html"; 
 ?>
<div class="splitright">

<div style="padding-left: 10px; width:500px;">
  <h1>Add a course</h1>

  <form method="post"  class="form" style="padding-bottom:20px;">
    <label class="formtitle">Add a course </label>
    <br>
    <label for="cid">Course ID</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cid" id="cid"><br>
    <label for="cname">Course Name</label>
    &nbsp;<input type="text" name="cname" id="cname"><br>
    <label for="credits">Credits</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="credits" id="credits"><br>
    <label for="cnameshort">Abbrev. name</label>
    <input type="text" name="cnameshort" id="cnameshort"><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br>
  </form>
  <br>
  <a href="managecourse.php" class="gobacklink">Back to manage courses</a>
  <br>
  <br>
<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";
  include "checkstaff.php";
  if($_POST['cid'] != null){
        $new_user = array(
        "cid" => $_POST['cid'],
        "cname"  => $_POST['cname'],
        "credits"     => $_POST['credits'],
        "cnameshort"  => $_POST['cnameshort']
      );

      $sql =  "SELECT count(*) as countt FROM course S WHERE S.cid =".$_POST['cid'].";";
      $result = mysqli_query($db,$sql);
      if(!$result){
        echo "Can't fetch course";
      }
      $row = mysqli_fetch_array($result);
      if($row['countt'] == 1){
        
        echo "Course already exists. Please go to edit course instead.";
       
        exit();
      }

      $statement = $connection->prepare($sql);
      $statement->execute($new_user);
       
      $sql2 = "INSERT INTO course VALUES('".$_POST['cid']."' , '".$_POST['cname']."' , '".$_POST['credits']."', '".$_POST['cnameshort']."');";

      $result2 = mysqli_query($db,$sql2);

      if(!$result2){
        
        echo 'Please go back to complete the form correctly.';
        
        exit();
      }

    if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['cname']); ?> successfully added.</blockquote>
<?php  }   
   }else{
    echo "Please fill the form!";
   }
}
?>

</div></div>
<?php require "templates/footer.php"; ?>
