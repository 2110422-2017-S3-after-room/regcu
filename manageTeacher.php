
<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";
    include 'checkstaff.php';
    // $connection = new PDO($dsn, $username, $password, $options);

    $tid = $_POST['tid'];
    $tname = $_POST['tname'];
    $dep_id = $_POST['dep_id'];
    $sql = "SELECT * FROM teacher
            WHERE tid like '%$tid%' and tname like '%$tname%' and dep_id like '$dep_id%'";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':tid', $tid, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>


<?php require "templates/header.php"; 
    include "splitleft-staff.html";
    
?>
<div class="splitright">
  <?php include 'backbuttonstaff.html';?>
<div style="padding: 20px;">
 
  <h1> Manage Teacher </h1>
  <div style="width: 400px;margin-top:20px;padding-bottom: 20px;">
  <form method="post" class="form" >
    <label class="formtitle"> Find Teachers </label>
    <br>
    <h2>Based on ID, name, department's ID</h2>
    <label> Teacher ID</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tid" name="tid" class="formtextbox">
    <br><label> Teacher Name</label>
    &nbsp;<input type="text" id="tname" name="tname" class="formtextbox">
    <br><label> Department ID</label>
    &nbsp;<input type="text" id="dep_id" name="dep_id" class="formtextbox">
    <br><br><input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  

  <a href="create-teacher.php" class="gobacklink">Add new teacher</a>
  
  </div>

        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table class="data-table" 
    style="display: block; overflow-y:scroll; max-height: 300px; min-width: 300px; max-width:550px;">

      <thead>
        <tr>
          <th>Teacher's ID</th>
          <th>Name</th>
          <th>Department's ID</th>
          <th> Edit </th>
          <th> Delete </th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["tid"]); ?></td>
          <td><?php echo escape($row["tname"]); ?></td>
          <td><?php echo escape($row["dep_id"]); ?></td>
          <td><a href="update-teacher-single.php?tid=<?php echo escape($row["tid"]); ?>"><i class="fas fa-pencil-alt"></i></a></td>
          
          <td><a href="delete-teacher.php?tid=<?php echo escape($row["tid"]); ?>"><i class="fas fa-trash-alt"></i></a></td>
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
</div>
<?php require "templates/footer.php"; ?>
