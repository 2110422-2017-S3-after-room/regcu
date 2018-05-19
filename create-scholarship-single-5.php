<?php 
   if(isset($_POST['sch_name']) and isset($_POST['sch_year'])){
      $sch_name = $_POST['sch_name'];
      $sch_year = $_POST['sch_year'];
      
   }else{ 
      echo '<script language="javascript">';
      echo 'alert("please complete the form")';
      echo '</script>';
      header('Location: create-scholarship.php');
    }

?>
<?php if (isset($_POST['submit'])) {
    require "common.php";
    include "session.php";
    include "checkstaff.php";
      $sch_cond = $_POST['sch_cond'];
      $sql2 = "INSERT INTO external_sch (sch_name, sch_year, sch_cond) 
      VALUES ('$sch_name', '$sch_year', '$sch_cond');";
      $result2 = mysqli_query($db,$sql2);

      if(!$result2){
        echo $sql2;
        echo $sch_name;
        echo $sch_year;

        echo "Please go back to complete the form correctly.";
        exit();
      }else{
        echo "<script type='text/javascript'>alert('eee');</script>";
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
    <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
    <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
    <label class="formtitle">specific info</label><br><br>
    <label for="sch_cond">scholarship condition</label><br>
    <textarea maxlength="500" class="formtextbox" name="sch_cond" style="width:500px;height: 100px;resize: none"></textarea>
<br>
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br><br>
  </form>
</div>
</div>