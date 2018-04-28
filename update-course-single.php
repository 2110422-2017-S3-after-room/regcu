<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "session.php";
include 'checkstaff.php';
require "common.php";

$message=" ";

if (isset($_POST['submit'])) {
  try {
    
    $cid= $_GET['cid'];
    $sql2 = "UPDATE course 
            SET 
              cname = '".$_POST['cname']."' , 
              credits = ".$_POST['credits'].", 
              cnameshort= '".$_POST['cnameshort']."'
            WHERE cid =".$cid.";";
  $result2 = mysqli_query($db,$sql2);
  $message="updated successfully";

  } catch(PDOException $error) {
      echo "cannot update";
      echo $sql2 . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['cid'])) {
 
  $cid = $_GET['cid'];

  $sql = "SELECT cname, cnameshort, credits FROM course WHERE cid ='".$cid."';";
  $result = mysqli_query($db,$sql);
  if(!$result){
    echo "cannot fetch";
  }
  $row =  mysqli_fetch_array($result); 
?>
  <?php 
     require "templates/header.php";
    include 'splitleft-staff.html'; ?>
  
  <div class="splitright" style="padding-left: 20px;">
    <?php include 'backbuttonstaff.html'; ?>
    <form method="post" class="form" style="width:400px;padding-bottom: 20px;">
        <label class="formtitle">Edit a course</label> <br><br>
          <label for="cid"> Course ID </label>
          <input disabled class="formtextbox" type="text" name="cid" value= "<?= $cid ?>"><br>
          <label for="cname"> Course Name </label>
          <input  class="formtextbox" type="text" name="cname"  value="<?= $row['cname'] ?>"><br>
          <label for="cnameshort"> Abbrev. Name </label>
          <input class="formtextbox" type="text" name="cnameshort"  value="<?= $row['cnameshort'] ?>"><br>
          <label for="credits"> Credits </label>
          <input  class="formtextbox" type="text" name="credits"  value="<?= $row['credits'] ?>"><br>

        <br>
        <input class="submitbutton" type="submit" name="submit" value="Submit"> <br>
    </form>
    <br>
    <a href="managecourse.php" class="gobacklink">Back to manage courses</a>
    </div>

 <?php require "templates/footer.php"; ?>
<?php

} else {
    echo "Something went wrong!";
    exit;
}

?>
<?php 
      if($result){  ?>
        <p style="color: green;"> <?= $message ?> </p>
<?php  } ?>
