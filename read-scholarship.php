<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sch_name = $_POST['sch_name'];
    $sql = "SELECT * FROM scholarship
            WHERE sch_name like '%$sch_name%' 
            or sch_year like '%$sch_name%' 
            or sch_owner like '%$sch_name%'
            ";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':sch_name', $sch_name, PDO::PARAM_STR);
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
          <th>Scholarship's year</th>
          <th>Name</th>
          <th>Owner</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["sch_year"]); ?></td>
          <td><?php echo escape($row["sch_name"]); ?></td>
          <td><?php echo escape($row["sch_owner"]); ?></td>
          <td><?php echo escape($row["sch_amount"]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['sch_name']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find scholarship based on scholarship's name, year or owner</h2>

<form method="post">
  <label for="sch_name">Scholarship's attribute</label>
  <input type="text" id="sch_name" name="sch_name">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="managescholarship.php">Back to manage scholarships</a>

<?php require "templates/footer.php"; ?>