<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
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
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['sch_name'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sch_name = $_GET['sch_name'];

    $sql = "SELECT * FROM scholarship WHERE sch_name = :sch_name";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':sch_name', $sch_name);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
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

<h2>Edit a scholarship</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" sch_name="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'sch_name' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="update-scholarship.php">Back to update scholarships</a>
<?php require "templates/footer.php"; ?>