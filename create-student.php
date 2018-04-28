<?php
if (isset($_POST['submit'])) {
  require "common.php";
  include "session.php";
  include "checkstaff.php";
    // $connection = new PDO($dsn, $username, $password, $options);
    
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
    VALUES('".$_POST['sid']."' , '". $_POST['nat_id']."' , '".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['conduct_score']."', '".$_POST['dep_id']."', '".$_POST['advisor_id']."', '".$_POST['group_id']."', '".$_POST['enroll_year']."', '".$_POST['stype']."');";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
 }

 require "templates/header.php"; 
 include "splitleft-staff.html";
?>
<div class="splitright">
  <?php include "backbuttonstaff.html"; ?>
<div style="padding-left: 20px;">
  <h2>Add a student</h2>

  <form class="form" method="post" action="?">
    <label class="formtitle"> Create Student </label><br><br>
    <label for="sid">Student ID</label>
    <input type="text" name="sid" id="sid" class="formtextbox"><br><br>
    <label for="nat_id">National ID</label>
    <input type="text" name="nat_id" id="nat_id" class="formtextbox" ><br>
    <label for="fname">First Name</label>
    <input type="text" name="fname" id="fname" class="formtextbox"><br>
    <label for="lname">Last Name</label>
    <input type="text" name="lname" id="lname" class="formtextbox"><br>
    
    <label for="stype">Student type</label>
    <select class="formdropdown" name="stype">
      <option type="text"  value="1" selected>1 : BACHELOR</option>
      <option type="text" value="2">2 : MASTER</option>
    </select>
    <br>
    <label for="dep_id"> Department ID</label>
    <input type="text" name="dep_id" id="dep_id" class="formtextbox"><br>
    
    <!-- <select class="formdropdown" name="dep_id">
        <?php
          $sql2 = "select d.dep_id, d.dep_name from department d;";
          $res2 = mysqli_query($db,$sql2);
          if(!$res2)echo "cant fetch dep";
          while($row2 = mysqli_fetch_array($res2)){ ?>
            <option type="text" value="<?php echo($row2['dep_id']); ?>"> <?php echo($row2['dep_id']." : ".$row2['dep_name']); ?> </option>
    <?php   }
         ?>
    </select><br> -->
    <label for="advisor_id">Advisor's ID</label>
    <input type="text" name="advisor_id" id="advisor_id" class="formtextbox"><br>
    
    <label for="conduct_score">Conduct Score</label>
    <input type="number" name="conduct_score" id="conduct_score" value="100" class="formnumberbox"><br>
    <label for="group_id" >Group ID</label>
    <input type="text" name="group_id" id="group_id" class="formtextbox"><br>
    <label for="enroll_year">Enroll Year</label>
    <input type="number" min="1900" max="3000" name="enroll_year" id="enroll_year" class="formnumberbox"><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton">
  </form>
  <br>
  <a href="managestudent.php" class="gobacklink">Back to manage students</a>
</div>
<?php
     if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['fname']); ?> <?php echo escape($_POST['lname']); ?> successfully added.</blockquote>
<?php   } ?> 
</div>

<?php require "templates/footer.php"; ?>
