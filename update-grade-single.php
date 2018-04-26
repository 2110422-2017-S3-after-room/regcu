<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "session.php";
require "common.php";

if (isset($_POST['submit'])) {
  try {
    $cid = $_POST['cid'];
    for ($i=0; $i < count($_POST['sid']); $i++ ) {
    $sid = $_POST['sid'][$i]; $grade = $_POST['grade'][$i];
    $sql = ("UPDATE enroll 
            SET grade = $grade
            WHERE sid = $sid AND cid = $cid");
    $result = mysqli_query($db,$sql);
    }
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['cid'])) {
  try {
    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu;");
    $cid = $_GET['cid'];

    $sql = "SELECT E.sid, S.fname, S.lname, E.grade
            FROM enroll E, Student S, Section SS
            WHERE e.sid = s.sid and ss.yearr = e.yearr and ss.sem =
            e.sem and ss.cid = e.cid and ss.sec_id = e.sec_id and
              ss.tid = ".($user_check)." and ss.cid = :cid;";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':cid', $cid);
    $statement->execute();
    $result = $statement->fetchAll();
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
<h2>Update Grade</h2>

<table>
    <thead>
        <tr>
            <th>Student's ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
        <form method="post">
            <input type="hidden" name="cid" value=<?php echo escape($cid); ?> class="field left" readonly>
            <td><?php echo escape($row["sid"]); ?>
              <input type="hidden" name="sid[]" value=<?php echo escape($row["sid"]); ?> class="field left" readonly>
            </td>
            <td><?php echo escape($row["fname"]); ?>
              <input type="hidden" name="fname[]" value=<?php echo escape($row["fname"]); ?> class="field left" readonly>
            </td>
            <td><?php echo escape($row["lname"]); ?>
              <input type="hidden" name="lname[]" value=<?php echo escape($row["lname"]); ?> class="field left" readonly>
            </td>
            <td><input type="number" step="0.5" maxlength="3" id="grade" name="grade[]" value=<?= $row["grade"]?> onkeypress="return isNumberKey(event)" />
            </td>
        </tr>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
    </form>
    </tbody>
</table>
<a href="update-grade.php">Back to update grade</a>
<?php require "templates/footer.php"; ?>