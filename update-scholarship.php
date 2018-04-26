<?php

/**
 * List all users with a link to edit
 */

try {
  require "config.php";
  require "common.php";

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
<h2>Update scholarships</h2>

<table>
    <thead>
        <tr>
            <th>Scholarship's name</th>
            <th>Year</th>
            <th>Owner</th>
            <th>Amount</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["sch_name"]); ?></td>
            <td><?php echo escape($row["sch_year"]); ?></td>
            <td><?php echo escape($row["sch_owner"]); ?></td>
            <td><?php echo escape($row["sch_amount"]); ?></td>
            <td><a href="update-scholarship-single.php?sch_name=<?php echo escape($row["sch_name"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="managescholarship.php">Back to manage scholarships</a>
<?php require "templates/footer.php"; ?>