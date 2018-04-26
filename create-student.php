<?php
if (isset($_POST['submit'])) {
  require "common.php";
  include "session.php";
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "sid" => $_POST['sid'],
      "nat_id"  => $_POST['nat_id'],
      "fname"     => $_POST['fname'],
      "lname"     => $_POST['lname'],
      "conduct_score" => $_POST['conduct_score'],
      "dep_id" => $_POST['dep_id'],
      "advisor_id" => $_POST['advisor_id'],
      "group_id" => $_POST['group_id'],
      "enroll_year" => $_POST['enroll_year'],
      "stype" => $_POST['stype']
      // ,"bdate" => $_POST['bdate'],
      // "bplace" => $_POST['bplace'],
      // "nat" => $_POST['nat'],
      // "sex" => $_POST['sex'],
      // "religion" => $_POST['religion']
    );

    $sql =  "SELECT count(*) as countt FROM student S WHERE S.sid =".$_POST['sid'].";";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch student";
      exit();
    }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Student already exists. Please go to edit student instead.";
      exit();
    }


    $sql =  "SELECT count(*) as countt FROM teacher T WHERE T.tid =".$_POST['advisor_id'].";";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch teacher";
      exit();
    }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 0){
      echo "Teacher doesn't exist in the database.";
      exit();
    }

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
     
    $sql2 = "INSERT INTO student
    (sid,nat_id,fname,lname,conduct_score,dep_id,advisor_id,group_id,enroll_year,stype) 
    VALUES(".$_POST['sid']." , ". $_POST['nat_id']." , '".$_POST['fname']."', '".$_POST['lname']."', ".$_POST['conduct_score'].", ".$_POST['dep_id'].", ".$_POST['advisor_id'].", ".$_POST['group_id'].", ".$_POST['enroll_year'].", ".$_POST['stype'].");";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
 }

 require "templates/header.php"; 

     if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['fname']); ?> <?php echo escape($_POST['lname']); ?> successfully added.</blockquote>
<?php   } ?> 


  <h2>Add a student</h2>

  <form method="post"n action="?">
    <label for="sid">Student ID</label>
    <input type="text" name="sid" id="sid">
    <label for="nat_id">National ID</label>
    <input type="text" name="nat_id" id="nat_id">
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname">
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname">
    <label for="conduct_score">Conduct Score</label>
    <input type="text" name="conduct_score" id="conduct_score" value="100">
    <label for="dep_id">Department ID</label>
    <input type="text" name="dep_id" id="dep_id">
    <label for="advisor_id">Advisor's ID</label>
    <input type="text" name="advisor_id" id="advisor_id">
    <label for="group_id">Group ID</label>
    <input type="text" name="group_id" id="group_id">
    <label for="enroll_year">Enroll Year</label>
    <input type="text" name="enroll_year" id="enroll_year">
    <label for="stype">Stype</label>
    <input type="text" name="stype" id="stype">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="managestudent.php">Back to manage students</a>

<?php require "templates/footer.php"; ?>
