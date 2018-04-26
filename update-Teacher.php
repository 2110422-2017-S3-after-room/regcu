<?php

/**
 * List all users with a link to edit
 */

try {
  require "config.php";
  require "common.php";

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
<h2>Update teachers</h2>

<table>
    <thead>
        <tr>
            <th>teacher ID</th>
            <th>teacher Name</th>
            <th>department ID</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["tid"]); ?></td>
            <td><?php echo escape($row["tname"]); ?></td>
            <td><?php echo escape($row["dep_id"]); ?></td>
            <td><a href="update-teacher-single.php?tid=<?php echo escape($row["tid"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="manageteacher.php">Back to manage teachers</a>
<?php require "templates/footer.php"; ?>