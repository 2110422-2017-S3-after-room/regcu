<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";

    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu");
        $new_user = array(
      "cid" => $_POST['cid'],
      "cname"  => $_POST['cname'],
      "credits"     => $_POST['credits']
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
     
    $sql2 = "INSERT INTO course
    (cid,cname,credits) 
    VALUES(".$_POST['cid']." , ". $_POST['cname']." , ".$_POST['credits'].");";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
 }

 require "templates/header.php"; 

     if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['cname']); ?> successfully added.</blockquote>
<?php   } ?> 

  <h2>Add a course</h2>

  <form method="post">
    <label for="cid">Course ID</label>
    <input type="text" name="cid" id="cid">
    <label for="cname">Course Name</label>
    <input type="text" name="cname" id="cname">
    <label for="credits">Credits</label>
    <input type="text" name="credits" id="credits">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="managecourse.php">Back to manage courses</a>

<?php require "templates/footer.php"; ?>
