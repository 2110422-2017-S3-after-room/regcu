<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";
  include "checkstaff.php";
  require "templates/header.php"; 
  include "splitleft-staff.html";
  $sch_type = $_POST['sch_type'];
 if($sch_type == "1"){?>
       <form id="myForm" action="create-scholarship-single-1.php" method="post">
		<input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($sch_type == "2"){?>
       <form id="myForm" action="create-scholarship-single-2.php" method="post">
		<input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($sch_type == "3"){?>
       <form id="myForm" action="create-scholarship-single-3.php" method="post">
		<input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($sch_type == "4"){?>
       <form id="myForm" action="create-scholarship-single-4.php" method="post">
		<input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
      </form>
      <script type="text/javascript">
        document.getElementById('myForm').submit();
      </script>
      <?php
    }elseif($sch_type == "5"){?>
       <form id="myForm" action="create-scholarship-single-5.php" method="post">
		<input type='hidden' name='sch_type' value='<?php echo "$sch_type";?>'/> 
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
