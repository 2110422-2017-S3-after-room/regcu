<?php 
   if(isset($_POST['sch_name']) and isset($_POST['sch_year']) ){
      $sch_name =  $_POST['sch_name'];
      $sch_year = $_POST['sch_year'];
      
   } else{
      echo '<script language="javascript">';
      echo 'alert("please complete the form")';
      echo '</script>';
      header("Location: create-scholarship.php");
   }

?>
<?php 
if (isset($_POST['submit'])) {
    require "common.php";
    include "session.php";
    include "checkstaff.php";
    $max_loan_amount = $_POST['max_loan_amount'];
      $typee = $_POST['type'];
      $detail = $_POST['detail'];

      $sql2 = "INSERT INTO กยศ (sch_name, sch_year, max_loan_amount, type, detail) 
      VALUES ('$sch_name', '$sch_year', '$max_loan_amount', '$typee  ', '$detail');";
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
    <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
    <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
    <label class="formtitle">specific info</label><br><br>
    <label for="max_loan_amount">Maximum loan amount</label>
    <input type="number" name="max_loan_amount" id="max_loan_amount" class="formnumberbox"><br><br>
    <label for="type">Type (1 = กยศ 2 = กรอ) </label>
    <input type="number" step="1" name="type" id="type" class="number"><br><br>
    <label for="detail">detail</label>
    <input type="text" name="detail" id="detail" class="formtextbox"><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br><br>
  </form>
</div>
</div>