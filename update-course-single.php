<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "session.php";
include('checkstaff.php');
require "common.php";

if (isset($_POST['submit'])) {
  try {
    // $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "cid"        => $_POST['cid'],
      "cname" => $_POST['cname'],
      "credits"  => $_POST['credits']
    ];

    $sql = "UPDATE course 
            SET cid = :cid, 
              cname = :cname, 
              credits = :credits
            WHERE cid = :cid";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['cid'])) {
  try {
    // $connection = new PDO($dsn, $username, $password, $options);
    $cid = $_GET['cid'];

    $sql = "SELECT * FROM course WHERE cid = :cid";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':cid', $cid);
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
	<blockquote><?php echo escape($_POST['cname']); ?> successfully updated.</blockquote>
<?php endif; ?>
<div style="padding-left: 100px;">
<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" cid="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'cid' ? 'readonly' : null); ?>><br><br>
    <?php endforeach; ?> 
    <br>
    <input type="submit" name="submit" value="Submit">
</form>
<br>
<a href="managecourse.php">Back to manage courses</a>
</div>
<?php require "templates/footer.php"; ?>