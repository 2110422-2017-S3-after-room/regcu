<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "session.php";
require "common.php";

if (isset($_POST['submit'])) {

  try {
    $cid = $_POST['cid'];
    for ($i=0; $i < count($_POST['sid']); $i++ ) {
        $sid = $_POST['sid'][$i];
        $grade = $_POST['grade'][$i];
        $invalidgrade=array($sid);
        
        if($grade < 0 || $grade > 4){
            array_push($invalidgrade,$sid);
        }else{
            
        $sql = ("UPDATE enroll 
                SET grade = $grade
                WHERE sid = $sid AND cid = $cid ");
        $result = mysqli_query($db,$sql);           
    }
}
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['cid'])) {
  try {
    // $connection = new PDO($dsn, $username, $password, $options);
    // $connection->query("use regcu;");
    $cid = $_GET['cid'];

    $sql = "SELECT E.sid, S.fname, S.lname, E.grade, SS.tid
            FROM enroll E, Student S, Section SS
            WHERE e.sid = s.sid and ss.yearr = e.yearr and ss.sem =
            e.sem and ss.cid = e.cid and ss.sec_id = e.sec_id and
              ss.tid = ".($user_check)." and ss.cid = :cid;";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':cid', $cid);
    $statement->execute();
    $result = $statement->fetchAll();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  
    
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
  

?>
<?php require "templates/header.php"; ?>
<?php include 'splitleft-teacher.html'; ?>
<div class="splitright">

<?php include 'backbutton.html'; ?>
<h1>Update Grade</h1>
        <form method="post" style="width:700px">
<table class="data-table">
    <thead class="data-table-thead" style=" overflow-y: auto; width:700px; overflow-x:hidden; height: 300px;">
        <tr>
            <th>Student's ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>

            <input type="hidden" name="cid" value=<?php echo escape($cid); ?> class="field left" readonly>

            <td><?php echo escape($row["sid"]); ?>
              <input type="hidden" name="sid[]" value=<?php echo escape($row["sid"]); ?> class="field left" readonly>
            </td>
            
            <td><?php echo escape($row["fname"]); ?>
              <input type="hidden" name="fname[]" value=<?php echo escape($row["fname"]); ?> class="field left" readonly>
            </td>
            <td><?php echo escape($row["lname"]); ?>
              <input type="hidden" name="lname[]" value=<?php echo escape($row["lname"]); ?> class="field left" readonly>
            </td>
            <td><input class="formtextboxsmall" type="number" max="4.0" min="0.0" step="0.5" maxlength="3" id="grade" name="grade[]" value=<?= $row["grade"]?> onkeypress="return isNumberKey(event)" />
            </td>
                    
    <?php endforeach; ?> 
        </tr>
        </tbody>
    </table>
  <br><br><br>
   <input style="float: right; margin-right:200px;" type="submit" name="submit" class="submitbutton" value="Submit" >   <br><br>
    <a class="gobacklink" style="" href="update-grade.php">Back to update grade</a><br>
     
    
    </form>
    
<br><br>



</div>
<?php require "templates/footer.php"; ?>

