<?php

/**
 * Delete a user
 */

require "common.php";
require "session.php";

if (isset($_GET["cc"])) {
  try {
    $sid = $_GET["cc"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "DELETE FROM student WHERE sid = $sid";

    $result = mysqli_query($db, $sql);
    if(!$result){
      echo "Error deleting";
   ;   exit();
  }

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET["sid"])) {
  try {
    $sid = $_GET["sid"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "SELECT * FROM student WHERE sid = $sid";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}


if (isset($_GET["cc"])) {
    header('Location: managestudent.php');
}
?>
<?php require "templates/header.php"; ?>
<div style="padding-left: 100px;">
<h2>Delete Student</h2>

<table class="data-table" style="display: block; height: 100px;">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>Name</th>
      <th>Group ID</th>
      <th>Advisor's ID</th>
      <th>Enrolled year</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["sid"]); ?></td>
      <td><?php echo escape($row["fname"]); ?> <?php echo escape($row["lname"]); ?></td>
      <td><?php echo escape($row["group_id"]); ?></td>
      <td><?php echo escape($row["advisor_id"]); ?></td>
      <td><?php echo escape($row["enroll_year"]); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<h2>Are you sure you want to permanently delete this student?</h2>
<form>
  <a href="delete-student.php?cc=<?php echo escape($row["sid"]); ?>" class="gobacklink">YES</a> <-->
  <a href="managestudent.php" class="gobacklink">NO</a>
</form>
<br>

<a href="managestudent.php">Back to manage student</a>
</div>
<?php require "templates/footer.php"; ?>