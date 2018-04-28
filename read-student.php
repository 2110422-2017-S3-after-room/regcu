<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sid = $_POST['sid'];
    $cscore = $_POST['cscore'];
    $sql = "SELECT * FROM Student
            WHERE (sid like '%$sid%' 
            or fname like '$sid%'
            or lname like '$sid%'
            or stype like '$sid%'
            or advisor_id like '$sid%')
            and conduct_score >= '$cscore'
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
          <th>Scholarship type</th>
          <th>Conduct Score</th>
          <th>Enroll Year</th>
          <th>Advisor's ID</th>

        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["sid"]); ?></td>
          <td><?php echo escape($row["fname"]); ?> <?php echo escape($row["lname"]); ?></td>
          <td><?php echo escape($row["stype"]); ?></td>
          <td><?php echo escape($row["conduct_score"]); ?></td>
          <td><?php echo escape($row["enroll_year"]); ?></td>
          <td><?php echo escape($row["advisor_id"]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['sid']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find Student based on Student's name, ID, scholarship type or advisor ID</h2>

<form method="post">
  <label for="sid">Student's attribute</label>
  <input type="text" id="sid" name="sid">
  <h2>and</h2>
  <label for="cscore">Student's conduct score is greater than</label>
  <input type="text" id="cscore" name="cscore" value="100">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="manageStudent.php">Back to manage Students</a>

<?php require "templates/footer.php"; ?>