<?php

/**
 * Delete a user
 */

require "config.php";
require "common.php";

if (isset($_GET["sid"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $sid = $_GET["sid"];

    $sql = "DELETE FROM student WHERE sid = :sid";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':sid', $sid);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM student";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete students</h2>

<table>
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
      <td><a href="delete-student.php?sid=<?php echo escape($row["sid"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="managestudent.php">Back to manage student</a>

<?php require "templates/footer.php"; ?>