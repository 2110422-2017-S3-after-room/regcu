<?php

/**
 * Use an HTML form to edit an entry in the
 * scholarships table.
 *
 */

require "session.php";
require "common.php";
require "checkstaff.php";

if (isset($_POST['submit'])) {
  try {

    $scholarship =[
      "sch_name" => $_POST['sch_name'],
      "sch_year" => $_POST['sch_year'],
      "sch_owner"  => $_POST['sch_owner'],
      "sch_amount"  => $_POST['sch_amount']
    ];
    
    
    $sql = "UPDATE scholarship 
            SET sch_name = :sch_name, 
            sch_year = :sch_year, 
            sch_owner = :sch_owner,
            sch_amount = :sch_amount
            WHERE sch_name = :sch_name";
  
  $statement = $connection->prepare($sql);
  $statement->execute($scholarship);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['sch_name'])) {
  try {
    $sch_name = $_GET['sch_name'];

    $sql = "SELECT * FROM scholarship WHERE sch_name = :sch_name";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':sch_name', $sch_name);
    $statement->execute();
    
    $scholarship = $statement->fetch(PDO::FETCH_ASSOC);
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

<div class="splitright" >
<div style="padding-left: 20px;">

<?php  include "backbuttonstaff.html"; ?>
<h2>Edit a scholarship</h2>
<form method="post" class="form">
    <label class="formtitle"> Edit a Scholarship</label><br><br>
    <?php foreach ($scholarship as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input class="formtextbox" type="text" name="<?php echo $key; ?>" sch_name="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'sch_name' ? 'readonly' : null); ?>><br><br>
    <?php endforeach; ?> 
    <input class="submitbutton" type="submit" name="submit" value="Submit"><br><br>
</form>
<br>
<a href="managescholarship.php" class="gobacklink">Back to manage scholarships</a>
</div>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <blockquote><?php echo escape($_POST['sch_name']); ?> successfully updated.</blockquote>
<?php endif; ?>
<?php require "templates/footer.php"; ?>