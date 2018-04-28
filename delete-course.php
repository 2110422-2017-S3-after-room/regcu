<?php

/**
 * Delete a user
 */

require "common.php";
require "session.php";

if (isset($_GET["cc"])) {
  try {
    $cid = $_GET["cc"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "DELETE FROM course WHERE cid = $cid";

    $result = mysqli_query($db, $sql);
    if(!$result){
      echo "Error deleting";
   ;   exit();
  }

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET["cid"])) {
  try {
    $cid = $_GET["cid"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "SELECT * FROM course WHERE cid = $cid";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}


if (isset($_GET["cc"])) {
    header('Location: managecourse.php');
}
?>
<?php require "templates/header.php"; ?>
<div style="padding-left: 100px;">
<h2>Delete Course</h2>

<table class="data-table" style="display: block; height: 100px;">
  <thead>
    <tr>
      <th>Course ID</th>
      <th>Course Name</th>
      <th>Credits</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["cid"]); ?></td>
      <td><?php echo escape($row["cname"]); ?></td>
      <td><?php echo escape($row["credits"]); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<h2>Are you sure you want to permanently delete this course?</h2>
<form>
  <a href="delete-course.php?cc=<?php echo escape($row["cid"]); ?>" class="gobacklink">YES</a> <-->
  <a href="managecourse.php" class="gobacklink">NO</a>
</form>
<br>

<a href="managecourse.php">Back to manage course</a>
</div>
<?php require "templates/footer.php"; ?>