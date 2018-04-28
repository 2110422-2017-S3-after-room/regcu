<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";

    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu");
        $new_user = array(
      "cid" => $_POST['cid'],
      "cname"  => $_POST['cname'],
      "credits"     => $_POST['credits'],
      "cnameshort"  => $_POST['cnameshort']
    );

    $sql =  "SELECT count(*) as countt FROM course S WHERE S.cid =".$_POST['cid'].";";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch course";
      exit();
    }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Course already exists. Please go to edit course instead.";
      exit();
    }

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
     
    $sql2 = "INSERT INTO course VALUES('".$_POST['cid']."' , '".$_POST['cname']."' , '".$_POST['credits']."', '".$_POST['cnameshort']."');";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form correctly.";
      exit();
    }
 }

 require "templates/header.php"; 

     if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['cname']); ?> successfully added.</blockquote>
<?php   } ?> 
<div style="padding-left: 100px;">
  <h2>Add a course</h2>

  <form method="post">
    <label for="cid">Course ID</label>
    <input type="text" name="cid" id="cid"><br><br>
    <label for="cname">Course Name</label>
    <input type="text" name="cname" id="cname"><br><br>
    <label for="credits">Credits</label>
    <input type="text" name="credits" id="credits"><br><br>
    <label for="cnameshort">Course Name(short)</label>
    <input type="text" name="cnameshort" id="cnameshort"><br><br>
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="managecourse.php">Back to manage courses</a>
</div>
<?php require "templates/footer.php"; ?>
