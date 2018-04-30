
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

<<<<<<< HEAD
    $sql2 = "SELECT D.*, M.relationship 
    from family_member_detail D,family_member M 
    where M.sid = $user_check and M.fnat_id = D.fnat_id;";
=======
    $sql2 = "SELECT D.*,M.relationship from family_member_detail D,family_member M where M.sid = $user_check and M.fnat_id = D.fnat_id;";
>>>>>>> origin/master
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
<<<<<<< HEAD
  <table class="data-table" style="display: block;  min-width: 250px; width: 270px;">
     <!--  <thead>
=======
  <table class="data-table" style="display: block; overflow: auto;">
      <thead>
>>>>>>> origin/master
        <tr>
          <th>Student's ID</th>
          <th>Name</th>
          <th>Scholarship type</th>
          <th>Conduct Score</th>
          <th>Enroll Year</th>
          <th>Advisor's ID</th>
          <th>Edit </th>
        </tr>
<<<<<<< HEAD
      </thead> -->
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr><th style="background-color: #5b66b8; color:white">Student's ID</th>
          <td><?php echo escape($row["sid"]); ?></td></tr>
         
         <tr><th style="background-color: #5b66b8; color:white">Name</th><td><?php echo escape($row["fname"]); ?> <?php echo escape($row["lname"]); ?></td></tr>
       
        <tr> <th style="background-color: #5b66b8; color:white">Student type</th><td><?php echo escape($row["stype"]); ?></td></tr>
    
        <tr> <th style="background-color: #5b66b8; color:white">Conduct Score</th><td><?php echo escape($row["conduct_score"]); ?></td></tr>
    
        <tr><th style="background-color: #5b66b8; color:white">Enroll Year</th><td><?php echo escape($row["enroll_year"]); ?></td></tr>
     
        <tr><th style="background-color: #5b66b8; color:white">Advisor's ID</th><td><?php echo escape($row["advisor_id"]); ?></td></tr>
     
       <!--  <tr><th style="background-color: #5b66b8; color:white">Edit </th><td><a href="update-student-profile.php?sid=<?php echo escape($user_check); ?>"><i class="fas fa-pencil-alt"></i></a></td></tr>
         -->
=======
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
>>>>>>> origin/master
      <?php endforeach; ?>
      </tbody>
    </table>
  <br><br>
<<<<<<< HEAD
  <h1> My relatives </h1>
            
      
        <?php foreach ($result2 as $row) : ?>
            <table class="data-table" style="display: inline-block; min-width: 250px; width: 270px; margin: 20px">

            <tbody>
          <tr>  <th style="background-color: #5b66b8; color:white">Name</th><td><?php echo escape($row["name"]); ?></td></tr>
           <tr>  <th style="background-color: #5b66b8; color:white">Birthdate</th><td><?php echo escape($row["birthdate"]); ?></td></tr>
          <tr>  <th style="background-color: #5b66b8; color:white">National ID</th><td><?php echo escape($row["fnat_id"]); ?></td></tr>
          <tr>  <th style="background-color: #5b66b8; color:white">Occupation</th><td><?php echo escape($row["occupation"]); ?></td></tr>
          <tr>  <th style="background-color: #5b66b8; color:white">Yearly income</th><td><?php echo escape($row["yearly_income"]); ?></td></tr>
           <tr> <th style="background-color: #5b66b8; color:white">Relationship</th><td><?php echo escape($row["relationship"]); ?></td></tr>
          <tr>   <th style="background-color: #5b66b8; color:white">edit</th><td><a href="update-relative.php?nat_id=<?php echo escape($user_check); ?>"><i class="fas fa-pencil-alt"></i></a></td>
          </tr>
          </tbody>
      </table>
        <?php endforeach; ?>
        
=======
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
>>>>>>> origin/master
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
<<<<<<< HEAD
<?php require "templates/footer.php"; ?>
=======
<?php require "templates/footer.php"; ?>
>>>>>>> origin/master
