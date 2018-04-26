<?php

/**
 * List all users with a link to edit
 */

try {
  require "config.php";
  require "common.php";

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
<h2>Update students</h2>

<table>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>National ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Conduct score</th>
            <th>Department ID</th>
            <th>Advisor ID</th>
            <th>Group ID</th>
            <th>Enroll year</th>          
            <th>Scholarship type</th>
<!--             <th>Birthday</th>
            <th>Birth place</th>
            <th>Nationality</th>
            <th>Sex</th>
            <th>Religion</th> -->
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["sid"]); ?></td>
            <td><?php echo escape($row["nat_id"]); ?></td>
            <td><?php echo escape($row["fname"]); ?></td>
            <td><?php echo escape($row["lname"]); ?></td>
            <td><?php echo escape($row["conduct_score"]); ?></td>
            <td><?php echo escape($row["dep_id"]); ?></td>
            <td><?php echo escape($row["advisor_id"]); ?></td>
            <td><?php echo escape($row["group_id"]); ?></td>
            <td><?php echo escape($row["enroll_year"]); ?></td>
            <td><?php echo escape($row["stype"]); ?></td>
<!--             <td><?php echo escape($row["bdate"]); ?></td>
            <td><?php echo escape($row["bplace"]); ?></td>
            <td><?php echo escape($row["nat"]); ?></td>
            <td><?php echo escape($row["sex"]); ?></td>
            <td><?php echo escape($row["religion"]); ?></td> -->
            <td><a href="update-student-single.php?sid=<?php echo escape($row["sid"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="managestudent.php">Back to manage students</a>
<?php require "templates/footer.php"; ?>