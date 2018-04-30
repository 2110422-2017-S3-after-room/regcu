<?php

/**
 * Use an HTML form to edit an entry in the
 * students table.
 *
 */

require "session.php";
require "common.php";
require "checkstudent.php";
if (isset($_POST['submit'])) {
  try {

    $student =[
      "sid" => $_POST['sid'],
      "nat_id"  => $_POST['nat_id'],
      "fname"     => $_POST['fname'],
      "lname"     => $_POST['lname'],
      "conduct_score" => $_POST['conduct_score'],
      "dep_id" => $_POST['dep_id'],
      "advisor_id" => $_POST['advisor_id'],
      "group_id" => $_POST['group_id'],
      "enroll_year" => $_POST['enroll_year'],
      "stype" => $_POST['stype']
    ];
    
    $sql = "UPDATE student 
            SET sid = :sid, 
              nat_id = :nat_id, 
              fname = :fname,
              lname = :lname, 
              conduct_score = :conduct_score, 
              dep_id = :dep_id, 
              advisor_id = :advisor_id, 
              group_id = :group_id, 
              enroll_year = :enroll_year, 
              stype = :stype
            WHERE sid = :sid";
  
  $statement = $connection->prepare($sql);
  $statement->execute($student);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
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

<?php require "templates/header.php"; 
      include "splitleft-staff.html";      
?>

<div class="splitright">
  <?php include "backbuttonstaff.html"; ?>
<div style="padding-left: 20px; ">

<form method="post" class="form" style="min-width: 400px; padding-bottom: 20px;">
  <label class="formtitle"> Edit my profile </label><br><br>
    <?php foreach ($student as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" sid="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'sid' ? 'readonly' : null); ?> <?php echo ($key === 'nat_id' ? 'readonly' : null); ?> <?php echo ($key === 'fname' ? 'readonly' : null); ?> <?php echo ($key === 'lname' ? ' readonly' : null); ?> <?php echo ($key === 'conduct_score' ? 'readonly' : null); ?> <?php echo ($key === 'dep_id' ? 'readonly' : null); ?> <?php echo ($key === 'advisor_id' ? 'readonly' : null); ?> <?php echo ($key === 'group_id' ? 'readonly' : null); ?> <?php echo ($key === 'enroll_year' ? 'readonly' : null); ?><?php echo ($key === 'stype' ? 'readonly' : null); ?>><br>
    <?php endforeach; ?> 
    <input  class="submitbutton" type="submit" name="submit" value="Submit">
</form>

</div>
<br>
<a class="gobacklink" href="student-profile.php">Back to my profile</a><br>
<?php if (isset($_POST['submit']) && $statement) : ?>
  <blockquote><?php echo escape($_POST['fname']); ?> <?php echo escape($_POST['lname']); ?> successfully updated.</blockquote>
<?php endif; ?>

</div>
<?php require "templates/footer.php"; ?>