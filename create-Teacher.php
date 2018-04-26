<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";

    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "tid" => $_POST['tid'],
      "tname"  => $_POST['tname'],
      "dep_id"     => $_POST['dep_id']
    );

    $sql =  "SELECT count(*) as countt FROM teacher S WHERE S.tid =".$_POST['tid'].";";
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "Can't fetch teacher";
      exit();
    }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Teacher already exists. Please go to edit teacher instead.";
      exit();
    }

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
     
    $sql2 = "INSERT INTO teacher
    (tid,tname,dep_id) 
    VALUES(".$_POST['tid']." , ". $_POST['tname']." , ".$_POST['dep_id'].");";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
 }

 require "templates/header.php"; 

     if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['tname']); ?> successfully added.</blockquote>
<?php   } ?> 

  <h2>Add a teacher</h2>

  <form method="post">
    <label for="tid">Teacher ID</label>
    <input type="text" name="tid" id="tid">
    <label for="tname">Teacher Name</label>
    <input type="text" name="tname" id="tname">
    <label for="dep_id">Department ID</label>
    <input type="text" name="dep_id" id="dep_id">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="manageteacher.php">Back to manage teachers</a>

<?php require "templates/footer.php"; ?>
