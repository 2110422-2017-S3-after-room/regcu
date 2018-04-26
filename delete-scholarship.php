<?php

/**
 * Delete a user
 */

require "config.php";
require "common.php";

if (isset($_GET["sch_name"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $sch_name = $_GET["sch_name"];

    $sql = "DELETE FROM scholarship WHERE sch_name = :sch_name";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':sch_name', $sch_name);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM scholarship";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete scholarships</h2>

<table>
  <thead>
    <tr>
      <th>Scholarship's year</th>
      <th>Name</th>
      <th>Owner</th>
      <th>Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["sch_year"]); ?></td>
      <td><?php echo escape($row["sch_name"]); ?></td>
      <td><?php echo escape($row["sch_owner"]); ?></td>
      <td><?php echo escape($row["sch_amount"]); ?></td>
      <td><a href="delete-scholarship.php?sch_name=<?php echo escape($row["sch_name"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="managescholarship.php">Back to manage scholarship</a>

<?php require "templates/footer.php"; ?>