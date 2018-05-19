<?php
  require "common.php";
  include "session.php";
  include "checkstaff.php";
  require "templates/header.php"; 
  include "splitleft-staff.html";
?>

<?php 
   if(isset($_POST['sch_name']) and isset($_POST['sch_year'])){
      $sch_name = $_POST['sch_name']; 
      $sch_year = $_POST['sch_year'];
      
   }else{
      echo '<script language="javascript">';
      echo 'alert("please complete this form first.")';
      echo '</script>';
      header('Location: create-scholarship.php');

   }    
?>
<?php if (isset($_POST['submit'])) {
    
    $min_gpa = $_POST['min_gpa'];
    $min_cscore = $_POST['min_cscore'];
    $max_famincome = $_POST['max_famincome'];
    $sql2 = "INSERT INTO excellent_academic_sch (sch_name, sch_year, min_conduct_score, min_GPA, max_family_income) 
      VALUES ('$sch_name', '$sch_year', '$min_cscore', '$min_gpa', '$max_famincome');";
    $result2 = mysqli_query($db,$sql2);
      if(!$result2){
        echo '<script language="javascript">';
        echo 'alert("please complete the form first")';
        echo '</script>';
        exit();
      }else{
        echo '<script language="javascript">';
        echo 'alert("scholarship added")';
        echo '</script>';
        header('Location: create-scholarship.php');
      }
      
        
    }
?> 

 <div class="splitright">
  <div style="padding-left: 20px;">
  <h2>Add a scholarship</h2>
  <form method="post" class="form">
    <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
    <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
    <label class="formtitle">specific info</label><br><br>
    <label for="min_cscore">Minimum Conduct Score</label>
    <input type="number" name="min_cscore" id="min_cscore" class="formtextbox"><br><br>
    <label for="min_gpa">Minimum GPA</label>
    <input type="number" step="0.01" name="min_gpa" id="min_gpa" class="formtextbox"><br><br>
    <label for="max_famincome">Maximum Family Income</label>
    <input type="number" name="max_famincome" id="max_famincome" class="formtextbox"><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br><br>
  </form>
</div>
</div>