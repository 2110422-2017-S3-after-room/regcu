<?php 
   if(isset($_POST['sch_name'])) $sch_name = $_POST['sch_name'];
   if(isset($_POST['sch_year'])) $sch_year = $_POST['sch_year'];
   if(isset($_POST['min_cscore'])) $min_cscore = $_POST['min_cscore'];
   if(isset($_POST['min_gpa'])) $min_gpa = $_POST['min_gpa'];
   if(isset($_POST['num_awards'])) $num_awards = $_POST['num_awards'];
   if(isset($_POST['sch_type'])) $sch_type = $_POST['sch_type'];
   else echo'234q5';
?>
<?php if (isset($_POST['submit'])) {
    require "common.php";
    include "session.php";
    include "checkstaff.php";
    $sql = "INSERT INTO scholarship(sch_name,sch_year,sch_owner,sch_amount, sch_type, sch_full_name) 
          VALUES('".$_POST['sch_name']."' , '". $_POST['sch_year']."' , '".$_POST['sch_owner']."', '".$_POST['sch_amount']."', '".$sch_type."', '".$_POST['sch_full_name']."');";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Please go back to complete the form.";
      exit();
    }

      $sql2 = "INSERT INTO ทุนสร้างชื่อเสียงและทำคุณประโยชน์ (sch_name, sch_year, min_conduct_score, min_GPA, num_awards) 
      VALUES ('$sch_name', '$sch_year', '$min_cscore', '$min_gpa', '$num_awards');";
      $result2 = mysqli_query($db,$sql2);
      if(!$result2){
        echo $sql2;
        echo $sch_name;
        echo $sch_year;

        echo "Please go back to complete the form correctly.";
        exit();
      }else{
        echo "<script type='text/javascript'>alert('$sch_name' +' successfully added.');</script>";
      }
      header('Location: create-scholarship.php');
    }
?> 
<?php
  require "templates/header.php"; 
  include "splitleft-staff.html";
?>
 <div class="splitright">
  <div style="padding-left: 20px;">
  <h2>Add a scholarship</h2>
  <form method="post" class="form">
    <label for="sch_name">Scholarship's name</label>
    <input type="text" name="sch_name" id="sch_name" class="formtextbox">
    <label for="sch_year">Year</label>
    <input type="number" name="sch_year" id="sch_year" class="formnumberbox"><br><br>
     <label for="sch_amount">Full Name</label>
    <input type="text" name="sch_full_name" id="sch_full_name" class="formtextbox"><br><br>
    <label for="sch_owner">Owner</label>
    <input type="text" name="sch_owner" id="sch_owner" class="formtextbox"><br><br>
    <label for="sch_amount">Amount</label>
    <input type="text" name="sch_amount" id="sch_amount" class="formtextbox"><br><br>
    <input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
<!--     <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
    <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
<<<<<<< HEAD
    <label class="formtitle">specific info</label><br><br>
=======
    <label class="formtitle">Add additional specific</label><br><br> -->
>>>>>>> origin/master
    <label for="min_cscore">Minimum Conduct Score</label>
    <input type="number" name="min_cscore" id="min_cscore" class="formtextbox"><br><br>
    <label for="min_gpa">Minimum GPA</label>
    <input type="number" step="0.01" name="min_gpa" id="min_gpa" class="formtextbox"><br><br>
    <label for="num_awards">Minimum Award number</label>
    <input type="number" name="num_awards" id="num_awards" class="formtextbox"><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br><br>
  </form>
</div>
</div>