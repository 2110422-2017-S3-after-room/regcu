<?php

/**
 * Delete a user
 */

require "common.php";
require "session.php";
require "checkstaff.php";

if (isset($_GET["cc"])) {
  try {
    $sch_name = $_GET["cc"];
    $sch_year = $_GET["ccc"];
    // // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu");
    $sql = "DELETE FROM scholarship WHERE sch_name = '".$sch_name."' and sch_year = ".$sch_year." ;";

    $result = mysqli_query($db, $sql);
    if(!$result){
      echo "Error deleting";
   ;   exit();
  }

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET["sch_name"])) {
  try {
    $sch_name = $_GET["sch_name"];
<<<<<<< HEAD
    $sch_year = $_GET["sch_year"];
    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu");
    $sql = "SELECT * FROM scholarship WHERE sch_name = '".$sch_name."' and sch_year = ".$sch_year.";";

=======
    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu");
    $sql = "SELECT * FROM scholarship WHERE sch_name = '(.$sch_name.)'";
>>>>>>> origin/master
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch scholarship";
      exit();
    }
    $row = mysqli_fetch_array($result);
    // $statement = $connection->prepare($sql);
    // $statement->execute();
    // $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}


if (isset($_GET["cc"])) {
    header('Location: managescholarship.php');
}
?>
<?php require "templates/header.php";
  include "splitleft-staff.html" ?>
  <div class="splitright">
    <?php include "backbuttonstaff.html"; ?>
<div style="padding-left: 20px;">
<h2>Delete Scholarship</h2>

<table class="data-table" style="width: 800px;" >
  <thead>
    <tr>
      <th>Year</th>
      <th>Name</th>
      <th>Owner</th>
      <th>Amount</th>
      <th>Type</th>
      <th>Full Name</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["sch_year"]); ?></td>
      <td><?php echo escape($row["sch_name"]); ?></td>
      <td><?php echo escape($row["sch_owner"]); ?></td>
      <td><?php echo escape($row["sch_amount"]); ?></td>
      <td><?php echo escape($row["sch_type"]); ?></td>
      <td><?php echo escape($row["sch_full_name"]); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<div style="display: block">
<h2>Are you sure you want to permanently delete this scholarship?</h2>
<form>
<<<<<<< HEAD
  <a href="delete-scholarship.php?cc=<?= $row['sch_name']?>&ccc=<?= $row['sch_year'] ?>" class="gobacklink">YES</a> <-->
=======
  <a href="delete-scholarship.php?cc=$row['sch_name']" class="gobacklink">YES</a> <-->
>>>>>>> origin/master
  <a href="managescholarship.php" class="gobacklink">NO</a>
</form>
<br>
</div>

<a href="managescholarship.php" class="gobacklink">Back to manage scholarship</a>
</div></div>
<?php require "templates/footer.php"; ?>