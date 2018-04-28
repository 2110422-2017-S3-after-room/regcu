<?php

/**
 * Use an HTML form to edit an entry in the
 * scholarships table.
 *
 */

require "session.php";
require "common.php";

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

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <blockquote><?php echo escape($_POST['sch_name']); ?> successfully updated.</blockquote>
<?php endif; ?>

<div style="padding-left: 100px;">
<h2>Edit a scholarship</h2>

<form method="post">
    <?php foreach ($scholarship as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" sch_name="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'sch_name' ? 'readonly' : null); ?>><br><br>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="managescholarship.php">Back to manage scholarships</a>
</div>
<?php require "templates/footer.php"; ?>