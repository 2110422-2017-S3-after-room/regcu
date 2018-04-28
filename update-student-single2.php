<?php

/**
 * Use an HTML form to edit an entry in the
 * students table.
 *
 */

require "session.php";
require "common.php";
require "checkstaff.php";

  
if (isset($_GET['sid'])) {
  try {
    $sid = $_GET['sid'];

    $sql = "SELECT * FROM student WHERE sid = :sid";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':sid', $sid);
    $statement->execute();
    
    $student = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<?php
if (isset($_POST['submit'])) {
  try {
    
    $sql = "UPDATE student 
            SET 
              nat_id = '". $_POST['nat_id'] ."', 
              fname = '".$_POST['fname']."',
              lname = '".$_POST['lname']."', 
              conduct_score = '".$_POST['conduct_score']."', 
              dep_id = '".$_POST['dep_id']."', 
              advisor_id = '".$_POST['advisor_id']."', 
              group_id = '".$_POST['group_id']."', 
              enroll_year = '".$_POST['enroll_year']."', 
              stype = '".$_POST['stype']."'
            WHERE sid = '".$_GET['sid']."';";
  
  $statement = $connection->prepare($sql);
  $statement->execute($student);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>



<?php if (isset($_POST['submit']) && $statement) : ?>
  <blockquote><?php echo escape($_POST['fname']); ?> <?php echo escape($_POST['lname']); ?> successfully updated.</blockquote>
<?php endif; ?>


<?php require "templates/header.php";
      include "splitleft-staff.html"; ?>
<div class="splitright">
<div style="padding-left: 100px;">
<h2>Edit a student</h2>

<form method="post">
    <?php foreach ($student as $key => $value) : ?> 
      <!-- //////////////////////// -->
    <?php if($key == 'stype') { ?>
     <label  >Student Type</label>
    <select class="formdropdown" name="stype">
      <option type="text"  value="1">1 : BACHELOR</option>
      <option type="text" value="2">2 : MASTER</option>
    </select>
    <?php } 
////////////////////////
   elseif($key == 'dep_id') { ?>
     <label  >Department</label>
    <select class="formdropdown" name="dep_id">
      <?php
        $query = "select distinct dep_id,dep_name from department;";
        $result = mysqli_query($db,$query);
        while($row = mysqli_fetch_array($result)){ ?>
           <option type="text"  value="<?= $row['dep_id'] ?>"> <?= $row['dep_id'] ?> : <?= $row['dep_name']?> </option>
  <?php } ?>
    </select>
    <?php }
 //////////////////////// -->
    elseif($key == 'conduct_score') { ?>
           <label  >Conduct Score</label>
           <input  class="formnumberbox" type="number" min=0, max=100 name="<?php echo $key; ?>" sid="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
        <?php } 
  //////////////////////// -->
     elseif($key == 'enroll_year') { ?>
       <label  >Enroll Year</label>
       <input class="formnumberbox" type="number" min=1900, max=3000 name="<?php echo $key; ?>" sid="<?php echo $key; ?>" value="<?php echo escape($value); ?>" >
      
 <!-- //////////////////////// -->
      <?php } else { ?>
           <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" class="formtextbox" name="<?php echo $key; ?>" sid="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'sid' ? 'disabled' : null); ?>>
          <?php } ?>
      <br><br>
   <!-- //////////////////////// -->

    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="managestudent.php">Back to manage students</a>
</div></div>
<?php require "templates/footer.php"; ?>