<?php

/**
 * Delete a user
 */

require "config.php";
require "common.php";

if (isset($_GET["tid"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $tid = $_GET["tid"];

    $sql = "DELETE FROM teacher WHERE tid = :tid";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':tid', $tid);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM teacher";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete teachers</h2>

<table>
  <thead>
    <tr>
      <th>teacher ID</th>
      <th>teacher Name</th>
      <th>dep_id</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["tid"]); ?></td>
      <td><?php echo escape($row["tname"]); ?></td>
      <td><?php echo escape($row["dep_id"]); ?></td>
      <td><a href="delete-teacher.php?tid=<?php echo escape($row["tid"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="manageteacher.php">Back to manage teacher</a>

<?php require "templates/footer.php"; ?>