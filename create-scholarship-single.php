<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";
  include "checkstaff.php";
    // $connection = new PDO($dsn, $username, $password, $options);
    
    // $new_user = array(
    //   "sch_name" => $_POST['sch_name'],
    //   "sch_year"  => $_POST['sch_year'],
    //   "sch_owner"     => $_POST['sch_owner'],
    //   "sch_amount"     => $_POST['sch_amount'],
    // );

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

    // $statement = $connection->prepare($sql);
    // $statement->execute($new_user);
    $sql2 = "INSERT INTO scholarship(sch_name,sch_year,sch_owner,sch_amount, sch_type, sch_full_name) 
          VALUES('".$_POST['sch_name']."' , '". $_POST['sch_year']."' , '".$_POST['sch_owner']."', '".$_POST['sch_amount']."', '".$_POST['sch_type']."', '".$_POST['sch_full_name']."');";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
 }
?>
<?php
	require "templates/header.php"; 
	include "splitleft-staff.html";
?>
<?php 
   if(isset($_POST['sch_name'])) $sch_name = $_POST['sch_name'];
   else exit;
   if(isset($_POST['sch_year'])) $sch_year = $_POST['sch_year'];
   else exit;
?>
<?php
if (isset($_POST['submit'])) {
  if($_POST['sch_type'] == "1"){
      header('Location: create-scholarship.php');
    }elseif($_POST['sch_type'] == "2"){?>
       <form id="myForm" action="create-scholarship-single-2.php" method="post">
        <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
        <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($_POST['sch_type'] == "3"){?>
       <form id="myForm" action="create-scholarship-single-3.php" method="post">
        <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
        <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($_POST['sch_type'] == "4"){?>
       <form id="myForm" action="create-scholarship-single-4.php" method="post">
        <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
        <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($_POST['sch_type'] == "5"){?>
       <form id="myForm" action="create-scholarship-single-5.php" method="post">
        <input type='hidden' name='sch_name' value='<?php echo "$sch_name";?>'/> 
        <input type='hidden' name='sch_year' value='<?php echo "$sch_year";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }else{
      header('Location: create-scholarship.php');
    }
}
?>
<?php require "templates/footer.php"; ?>
