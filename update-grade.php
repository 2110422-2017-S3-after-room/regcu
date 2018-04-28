<?php

/**
 * List all users with a link to edit
 */

try {
  include "session.php";
  require "common.php";

  // $connection = new PDO($dsn, $username, $password, $options);
  

  $sql = "SELECT S.cid, cname, sec_id, yearr, sem from regcu.section S, regcu.course C where C.cid= S.cid AND S.tid = ".($user_check).";";


  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
<span style="overflow-x:scroll;">
<?php include 'splitleft-teacher.html'; ?>
  <div class=splitright>
<?php include 'backbutton.html'; ?> 

<h1>Update Grade</h1>

<table class="data-table" style="display: block; overflow-y: auto; width:700px; overflow-x:hidden; height: 300px;">
    <thead>
        <tr>
            <th>Course's ID</th>
            <th>Name</th>
            <th>Section</th>
            <th>Year</th>
            <th>Semester</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["cid"]); ?></td>
            <td><?php echo escape($row["cname"]); ?></td>
            <td><?php echo escape($row["sec_id"]); ?></td>
            <td><?php echo escape($row["yearr"]); ?></td>
            <td><?php echo escape($row["sem"]); ?></td>
            <td><a href="update-grade-single.php?cid=<?php echo escape($row["cid"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>
<a class="gobacklinkbig" href="teacherhome.php">Back to home</a>
</div></span>
<?php require "templates/footer.php"; ?>