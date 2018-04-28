<?php

/**
 * Delete a user
 */

require "common.php";
require "session.php";
require "checkstaff.php";
if (isset($_GET["cc"])) {
  try {
    $tid = $_GET["cc"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "DELETE FROM teacher WHERE tid = $tid";

    $result = mysqli_query($db, $sql);
    if(!$result){
      echo "Error deleting";
      exit();
    }
    header('Location: manageteacher.php');
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}

if (isset($_GET["tid"])) {
  try {
    $tid = $_GET["tid"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "SELECT * FROM teacher WHERE tid = $tid";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php require "templates/header.php"; 
      include "splitleft-staff.html";?>
<div class="splitright">
  <?php include "backbuttonstaff.html";?>
<div style="padding-left: 100px;">
<h1>Delete Teacher</h1>

<table class="data-table" style="display: block; height: 100px;">
  <thead>
    <tr>
      <th>Teacher ID</th>
      <th>Teacher Name</th>
      <th>Department ID</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["tid"]); ?></td>
      <td><?php echo escape($row["tname"]); ?></td>
      <td><?php echo escape($row["dep_id"]); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<h2>Are you sure you want to permanently delete this teacher?</h2>
<form>
  <a href="delete-teacher.php?cc=<?php echo escape($row["tid"]); ?>" class="gobacklink">YES</a> <-->
  <a href="manageteacher.php" class="gobacklink">NO</a>
</form>
<br><br>

<a class= "gobacklink" href="manageteacher.php">Back to manage teacher</a>
</div></div>
<?php require "templates/footer.php"; ?>