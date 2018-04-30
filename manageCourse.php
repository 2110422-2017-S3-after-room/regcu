
<?php 
    require "session.php";
    require "common.php";
    require "checkstaff.php"; 
?>


<?php require "templates/header.php"; ?>

<?php include "splitleft-staff.html"; ?>
<div class="splitright">
  <?php include "backbuttonstaff.html" ?>
<div style="padding-left: 10px;">

  <h1>Manage Course</h1><br>
  <div style="width: 500px;" >
  
  <form method="post" class="form">
    <label class="formtitle"> Find Courses </label>
    <br>
    <h2>Based on name, ID, credit</h2>
      <label for="cid">Course ID</label>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="cid" name="cid">
      <br>
      <label for="cid">Course Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" id="cname" name="cname">
      <br>
      <label for="cid">Number of Credits</label>
      <input type="text" id="credit" name="credit">
      <br><br>
      <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
      <br><br>
  </form>
  <br>
  <a href="staffhome.php" class="gobacklink">Back to main menu</a>
  <a href="create-course.php" class="gobacklink">Add course</a>
  </div>

<?php

if (isset($_POST['submit'])) {
  try  {
      
    
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $credit = $_POST['credit'];

    $cc = "";
    if($_POST['credit'] != null){
      $cc = " and credits = " . $credit;
    }  
    $sql = "SELECT * FROM course
            WHERE cid like '$cid%' 
            and cname like '%$cname%' "
            .$cc." ;";
    // echo $sql;
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

    <table class="data-table" style="display: inline-block; overflow-y: scroll;max-height: 300px;">
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Course Name</th>
          <th>Credits</th>
          <th>View Section</th>
          <th>Edit Course</th>
          <th>Delete Course</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["cid"]); ?></td>
          <td><?php echo escape($row["cname"]); ?></td>
          <td><?php echo escape($row["credits"]); ?></td>
          <td><a class="hlink" href='read-course-single.php?cid=<?=$row["cid"]?>'> <i class="fas fa-info-circle"></i></a></td>
          <td style="text-align: center;"><a href="update-course-single.php?cid=<?php echo escape($row["cid"]); ?>"><i class="fas fa-pencil-alt"></i></a></td>
          <td><a href="delete-course.php?cid=<?php echo escape($row["cid"]); ?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['cid']); ?>.</blockquote>
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
