<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $tid = $_POST['tid'];
    $sql = "SELECT * FROM teacher
            WHERE tid like '$tid%' or tname like '%$tid%' or dep_id like '$tid%'";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':tid', $tid, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
        <tr>
          <th>Teacher's ID</th>
          <th>Teacher's Name</th>
          <th>Department's ID</th>
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
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['tid']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find teacher based on teacher's name, teacher's ID or teacher's department ID</h2>

<form method="post">
  <input type="text" id="tid" name="tid">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="manageteacher.php">Back to manage teachers</a>

<?php require "templates/footer.php"; ?>