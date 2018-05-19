<?php
require "common.php";
  include "session.php";
  include "checkstaff.php";
  require "templates/header.php";
  include "splitleft-staff.html";
if (isset($_POST['submit'])) {

    $sql =  "SELECT count(*) as countt FROM scholarship S 
    WHERE S.sch_name ='".$_POST['sch_name']."' and S.sch_year = ".$_POST['sch_year']." ;";

    $result = mysqli_query($db,$sql);
    // if(!$result){
    //   echo "Can't fetch scholarship";
    //   exit();
    // }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Scholarship already exists. Please go to edit scholarship instead.";
      exit();
    }

    // $statement = $connection->prepare($sql);
    // $statement->execute($new_user);
    $sql2 = "INSERT INTO scholarship(sch_name,sch_year,sch_owner,sch_amount, sch_type) 
          VALUES('".$_POST['sch_name']."' , '". $_POST['sch_year']."' , '".$_POST['sch_owner']."', '".$_POST['sch_amount']."', ".$_POST['sch_type'].");";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "error insert scholarship";
      echo $sql2;
      exit();
    }
    $sql3 = "INSERT INTO sch_full_name(sch_name, full_name) values ('".$_POST['sch_name']."','".$_POST['sch_full_name']. "' ); ";
    $result3 = mysqli_query($db,$sql3);
    if(!$result3){
       $sql4 = "UPDATE sch_full_name SET full_name = '".$_POST['full_name']."' WHERE sch_name = '".$_POST['full_name']."';";
       $result4 = mysqli_query($db,$sql4);
       if(!$result4){
        echo "error";
       }
    }

 }
?>
<?php

?>
<div class="splitright">
 <?php
  include "backbuttonstaff.html";
?> 
<?php 
   if(isset($_POST['sch_name'])) $sch_name = $_POST['sch_name'];
   else exit;
   if(isset($_POST['sch_year'])) $sch_year = $_POST['sch_year'];
   else exit;
?>
<?php
if (isset($_POST['submit'])) {
  $st = $_POST['sch_type'];
   
  if($st == "1"){
     $sql =  "SELECT count(*) as countt FROM scholarship S WHERE S.sch_name ='".$_POST['sch_name']."';";

    $result = mysqli_query($db,$sql);
    // if(!$result){
    //   echo "Can't fetch scholarship";
    //   exit();
    // }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Scholarship already exists. Please go to edit scholarship instead.";
      exit();
    }

      header('Location: create-scholarship.php');
  }
  else if($st >= '2' and $st <= '5' ){ ?>
      <form id="myForm" action="create-scholarship-single-<?=$st?>.php" method="post">
        <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
        <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
         <input type='hidden' name='sch_owner' value='<?php echo "$sch_owner";?>'/> 
        <input type='hidden' name='sch_amount' value='<?php echo "$sch_amount";?>'/> 
         <input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
        <input type='hidden' name='sch_full_name' value='<?php echo "$sch_full_name";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
 <?php   }

}
?>
</div>
<?php require "templates/footer.php"; ?>
