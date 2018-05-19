
<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";
    require "checkstaff.php";

    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $stype = $_POST['stype'];
    $advid = $_POST['sid'];
    $advname = $_POST['sid'];
    $cscore = $_POST['cscore'];
    $sql = "SELECT S.sid, S.fname, S.lname, S.stype, S.advisor_id, S.conduct_score, T.tname, S.enroll_year FROM Student S,Teacher T
            WHERE sid like '%".$sid."%' 
            and fname like '".$fname."%'
            and lname like '".$lname."%'
            and stype  =" .$stype."
            and advisor_id like '".$advid."%'
            and tname like '%".$advname."%'
            and conduct_score >= ".$cscore."
            and S.advisor_id = T.tid;";
    // echo $sql;
    $statement = $connection->prepare($sql);
    $statement->bindParam(':sid', $sid, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<?php require "templates/header.php"; 
include "splitleft-staff.html"; ?>
<div class="splitright">
<div >
  <?php include 'backbuttonstaff.html'; ?>
  <h1> Manage Student </h1>
  <div style="width: 700px; padding:20px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find students </label>
    <br>
    <h2>Based on ID, name, department's ID</h2>
    <label>Student ID </label>
    <input class="formtextbox" type="text" id="sid" name="sid">   
   
    <label  >Student Type</label>
    <select class="formdropdown" name="stype">
      <option type="text"  value="1">1 : BACHELOR</option>
      <option type="text" value="2">2 : MASTER</option>
    </select>
  
    <br><br>
    <label>First name </label>
    <input class="formtextbox" type="text" id="fname" name="fname">  
    <label>Last name </label>
    <input class="formtextbox" type="text" id="lname" name="lname">   
    <br><br>
    <label>Advisor ID </label>
    <input class="formtextbox" type="text" id="advid" name="advid">
    <label>Advisor Name </label>
    <input class="formtextbox" type="text" id="advname" name="advname">   
    <br><br>
    <label for="cscore">with conduct score greater than</label>
  	<input type="number" id="cscore" name="cscore" value="100" max="100" min="0" >
    <br><br>
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  <!-- <a href="staffhome.php" class="gobacklink">Back to main menu</a> -->
  <a href="create-student.php" class="gobacklink">Add new student</a>
  </div>


        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table class="data-table" style="display: block; overflow: auto; height: 300px;">
      <thead>
        <tr>
          <th>Student's ID</th>
          <th>Name</th>
          <th>Scholarship type</th>
          <th>Conduct Score</th>
          <th>Enroll Year</th>
          <th>Advisor's ID</th>
          <th>Edit </th>
          <th>Delete </th>
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
          <td><a href="update-student-single.php?sid=<?php echo escape($row["sid"]); ?>"><i class="fas fa-pencil-alt"></i></a></td>
          
          <td><a href="delete-student.php?sid=<?php echo escape($row["sid"]); ?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['sid']); ?>.</blockquote>
    <?php } 
} ?> 

</div>
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
