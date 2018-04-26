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
      "tid"        => $_POST['tid'],
      "tname" => $_POST['tname'],
      "dep_id"  => $_POST['dep_id']
    ];

    $sql = "UPDATE teacher 
            SET tid = :tid, 
              tname = :tname, 
              dep_id = :dep_id
            WHERE tid = :tid";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['tid'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $tid = $_GET['tid'];

    $sql = "SELECT * FROM teacher WHERE tid = :tid";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':tid', $tid);
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
	<blockquote><?php echo escape($_POST['tname']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" tid="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'tid' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="update-teacher.php">Back to update teachers</a>
<?php require "templates/footer.php"; ?>