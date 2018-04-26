<?php
	
    
if (isset($_POST['submit'])) {
  try  {
      include "session.php";
      require "common.php";
   

    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu;");

    $sid = $_POST['sid'];
    $sql = "SELECT * FROM regcu.student
            WHERE (sid like '%$sid%' 
            or fname like '$sid%'
            or lname like '$sid%')
            ";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':sid', $sid, PDO::PARAM_STR);
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
          <th>Student's ID</th>
          <th>Name</th>
          <th>Conduct Score</th>
          <th>Department's ID</th>
          <th>Enroll Year</th>

        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["sid"]); ?></td>
          <td><?php echo escape($row["fname"]); ?> <?php echo escape($row["lname"]); ?></td>
          <td><?php echo escape($row["conduct_score"]); ?></td>
          <td><?php echo escape($row["dep_id"]); ?></td>
          <td><?php echo escape($row["enroll_year"]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['sid']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find Student based on Student's name or ID <br>
or leave this space blank to see all the students</h2>

<form method="post">
  <label for="sid">Student's attribute</label>
  <input type="text" id="sid" name="sid">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="teacherhome.php">Back to home</a>

<?php require "templates/footer.php"; ?>