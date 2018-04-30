
<?php

try  {
      
    require "session.php";
    require "common.php";
    require "checkstudent.php";

    // $sid = $_POST['sid'];
    // $fname = $_POST['fname'];
    // $lname = $_POST['lname'];
    // $stype = $_POST['stype'];
    // $advid = $_POST['sid'];
    // $advname = $_POST['sid'];
    // $cscore = $_POST['cscore'];
    $sql = "SELECT * FROM Student
            WHERE sid = $user_check";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

    $sql2 = "SELECT D.*,M.relationship from family_member_detail D,family_member M where M.sid = $user_check and M.fnat_id = D.fnat_id;";
    $statement2 = $connection->prepare($sql2);
    $statement2->execute();
    $result2 = $statement2->fetchAll();

  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
}

?>

<?php require "templates/header.php"; 
include "splitleft.html"; ?>
<div class="splitright">
<div >
  <?php include 'backbuttonstudent.html'; ?>
  <h1> My profile </h1>
  <table class="data-table" style="display: block; overflow: auto;">
      <thead>
        <tr>
          <th>Student's ID</th>
          <th>Name</th>
          <th>Scholarship type</th>
          <th>Conduct Score</th>
          <th>Enroll Year</th>
          <th>Advisor's ID</th>
          <th>Edit </th>
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
          <td><a href="update-student-profile.php?sid=<?php echo escape($user_check); ?>"><i class="fas fa-pencil-alt"></i></a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <br><br>
  <h1> My relative </h1>
    <table class="data-table" style="display: block; overflow: auto;">
        <thead>
          <tr>
            <th>Name</th>
            <th>Birthdate</th>
            <th>National ID</th>
            <th>Occupation</th>
            <th>Yearly income</th>
            <th>Relationship</th>
            <th>edit</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($result2 as $row) : ?>
          <tr>
            <td><?php echo escape($row["name"]); ?></td>
            <td><?php echo escape($row["birthdate"]); ?></td>
            <td><?php echo escape($row["fnat_id"]); ?></td>
            <td><?php echo escape($row["occupation"]); ?></td>
            <td><?php echo escape($row["yearly_income"]); ?></td>
            <td><?php echo escape($row["relationship"]); ?></td>
            <td><a href="update-student-profile.php?sid=<?php echo escape($user_check); ?>"><i class="fas fa-pencil-alt"></i></a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>

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
