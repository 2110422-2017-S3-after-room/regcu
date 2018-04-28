<?php require "templates/header.php"; ?>

<div style="padding-left: 100px;">

  <div style="width: 1000px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find students </label>
    <br>
    <h2>Based on ID, name, department's ID</h2>
    <input type="text" id="sid" name="sid">
    <br>
    <label for="cscore">The conduct score is greater than</label>
  	<input type="text" id="cscore" name="cscore" value="100">
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  <a href="staffhome.php" class="gobacklink">Back to main menu</a>
  <a href="create-student.php" class="gobacklink">Add new student</a>
  </div>

<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";

    // $connection = new PDO($dsn, $username, $password, $options);

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
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table class="data-table" style="display: block; overflow: scroll;height: 300px;">
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
          <td><a href="update-student-single.php?sid=<?php echo escape($row["sid"]); ?>">Edit</a></td>
          
          <td><a href="delete-student.php?sid=<?php echo escape($row["sid"]); ?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['sid']); ?>.</blockquote>
    <?php } 
} ?> 


</div>
<script>
 
  var $table = $('data-table')
  var  $bodyCells=$table.find('tbody tr:first').children(),
  colWidth;

  colWidth= $bodyCells.map(function(){
    return $(this).width();
  }).get();

  $table.find('thead tr').children().each(function(i,v){
    $(v).width(colWidth[i]);
  });
  
</script>
<?php require "templates/footer.php"; ?>
