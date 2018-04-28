<?php require "templates/header.php"; ?>

<div style="padding-left: 100px;">

  <div style="width: 1000px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find Teachers </label>
    <br>
    <h2>Based on ID, name, department's ID</h2>
    <input type="text" id="tid" name="tid">
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  <a href="staffhome.php" class="gobacklink">Back to main menu</a>
  <a href="create-teacher.php" class="gobacklink">Add new teacher</a>
  </div>

<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";

    // $connection = new PDO($dsn, $username, $password, $options);

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
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table class="data-table" style="display: block; overflow: scroll;height: 300px;">
      <thead>
        <tr>
          <th>Teacher's ID</th>
          <th>Name</th>
          <th>Department's ID</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["tid"]); ?></td>
          <td><?php echo escape($row["tname"]); ?></td>
          <td><?php echo escape($row["dep_id"]); ?></td>
          <td><a href="update-teacher-single.php?tid=<?php echo escape($row["tid"]); ?>">Edit</a></td>
          
          <td><a href="delete-teacher.php?tid=<?php echo escape($row["tid"]); ?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['tid']); ?>.</blockquote>
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
