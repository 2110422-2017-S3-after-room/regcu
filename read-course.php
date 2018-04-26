<?php require "templates/header.php"; ?>

<h2>Find course based on course's name, course's ID or course's credit</h2>

<form method="post">
  <label for="cid">Course ID</label>
  <input type="text" id="cid" name="cid">
  <input type="submit" name="submit" value="View Results">
</form>



<?php
if (isset($_GET["cid"])) {
  try {
    
    $cid = $_GET["cid"];

    $sql = "DELETE FROM course WHERE cid = :cid";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':cid', $cid);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";

    // $connection = new PDO($dsn, $username, $password, $options);

    $cid = $_POST['cid'];
    $sql = "SELECT * FROM course
            WHERE cid like '$cid%' or cname like '%$cid%' or credits like '%$cid'";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':cid', $cid, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Course Name</th>
          <th>Credits</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["cid"]); ?></td>
          <td><?php echo escape($row["cname"]); ?></td>
          <td><?php echo escape($row["credits"]); ?></td>
          <td><a href='read-course-single.php?cid=<?=$row["cid"]?>'>ddd </a></td>
          <td><a href="update-course-single.php?cid=<?php echo escape($row["cid"]); ?>">Edit</a></td>
          
          <td><a href="read-course.php?cid=<?php echo escape($row["cid"]); ?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['cid']); ?>.</blockquote>
    <?php } 
} ?> 


<a href="staffhome.php">Back to manage courses</a>

<?php require "templates/footer.php"; ?>
