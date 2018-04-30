<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "session.php";
require "common.php";
require "checkstaff.php";

if(isset($_POST['addsec'])){
 
  if(isset($_POST['newsec_id']) and isset($_POST['newyear']) and isset($_POST['newsem']) and isset($_POST['newtid'])){
    $newsec_id = $_POST['newsec_id'];
    $newyear = $_POST['newyear'];
    $newsem = $_POST['newsem'];
    $newtid = $_POST['newtid'];
    $cid = $_GET['cid'];
    $sql = "INSERT INTO section (cid,sec_id,yearr,sem,tid)
    VALUES ('".$cid."', ".$newsec_id.", ".$newyear.", ".$newsem.", '".$newtid."');";
    $res = mysqli_query($db, $sql);
    if(!$res){
      echo "Cannot insert section. It might already exist! Try Editing instead. ";
    }
  }
}

if (isset($_POST['submit'])) { 
  try {
    $cid = $_GET['cid'];
    $invalidtid = array();
    for ($i=0; $i < count($_POST['sec_id']); $i++ ) {
        $sec_id = $_POST['sec_id'][$i];
        $year = $_POST['year'][$i];
        $sem = $_POST['sem'][$i];
        $tid= $_POST['tid'][$i];
        
        //check if teacher is valid   
        $sql2 = "SELECT count(*) as count 
                    FROM teacher  
                    WHERE tid = ". $tid ." ;";
        $result2 = mysqli_query($db,$sql2);
        if(!$result2){
          echo "cannot fetch at sql2";
          echo $sql2;
          exit();
        } 
            //teacher doesn't exist
        if(mysqli_fetch_array($result2)['count'] == 0){
            array_push($invalidtid,$sec_id) ; //add to array
        }

        //the actual update query           
        $sql = "UPDATE section
                SET yearr=".$year.", sem=".$sem.", tid= '".$tid."'
                WHERE sec_id = '".$sec_id."' AND cid = '".$cid."' ";
        $result = mysqli_query($db,$sql); 
        
        if(!$result){
          echo "cannot update";
        }          
    }
    if(sizeof($invalidtid) != 0){
        echo '<script language="javascript">';
        echo 'alert("invalid teacher id for section : ';
         foreach($invalidtid as $itid) { 
         //print array for check
                 echo $itid.'  ';
         }
        echo '");';
        echo '</script>';   
    }
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

?>
<?php

if (isset($_GET['cid'])) {

    $cid = $_GET['cid'];
 //////////////////// sections /////////////// 
    $sql = "SELECT S.sec_id, S.yearr, S.sem, S.tid, C.cname,T.tid, T.tname 
            FROM section S, course C, teacher T 
            WHERE S.cid = ".$cid." AND S.cid=C.cid AND T.tid=S.tid ORDER BY CAST(S.sec_id AS UNSIGNED);";
     // echo $sql;
    $result =  mysqli_query($db,$sql);
    if(!$result){
      echo "cannot fetch";
      exit();
    }
/////////////////////about course///////////////////////

    $sql2 = "SELECT * FROM course C WHERE C.cid = ".$cid.";";
     // echo $sql;
    $result2 =  mysqli_query($db,$sql2);
    if(!$result2){
      echo "cannot fetch2";
      exit();
    }
    $row2= mysqli_fetch_array($result2);

    require "templates/header.php"; 
    include "splitleft-staff.html";
?>

<div class="splitright">
<?php 
  include "backbuttonstaff.html"; ?>
<!--  
  <?php if (isset($_POST['submit']) && $statement) : ?>
  <blockquote><?php echo escape($_POST['cname']); ?> successfully updated.</blockquote>
<?php endif; ?>
-->
<div style="padding-left: 10px;">
<h1>Course Info : Manage Section</h1>
<p>
<pre> 
  Course ID: <?= $row2['cid'] ?> &#9; 
  Course Name : <?= $row2['cname'] ?> &#9; 
  Credits: <?=$row2['credits']?> </pre></p>
<form method="post" action="">
<table class="data-table" style="display: block; overflow-y: auto; width:1000px; max-height: 500px;">
  <caption style="background: none"> sections of course <?= $cid ?> :  </caption>
  <thead> 
    <th> section id</th>
    <th> year</th>
    <th> semester</th>
    <th> teacher id</th>
    <th> teacher name</th>
    <th> </th>
  </thead>
  <tbody>
    <tr>
      <td> <input type="text" name="newsec_id">  </td>
      <td> <input type="text" name="newyear">  </td>
      <td> <input type="text" name="newsem">  </td>
      <td> <input type="text" name="newtid">  </td>
      <td>   </td>
      <td> <input class="addbutton" type="submit" name="addsec" value = "+"> </td>
    </tr>

    <?php foreach ($result as $row) : 
      $sec = $row['sec_id'];
      $year = $row['yearr'];
      $sem = $row['sem'];
      $tid = $row['tid'];
      $tname = $row['tname'];
    ?>

        <tr>
      <td><?php echo escape($row["sec_id"]); ?>
        <input type="hidden" name="sec_id[]" value=<?php echo escape($row["sec_id"]); ?> class="field left" readonly>
      </td>

      <td><?php echo escape($year); ?>
        <input type="hidden" name="year[]" value=<?php echo escape($year); ?> class="field left" readonly>
      </td>
      
     <td><?php echo escape($sem); ?>
        <input type="hidden" name="sem[]" value=<?php echo escape($sem); ?> class="field left" readonly>
      </td>

      <td>
        <input type="text" name="tid[]" maxlength="45" value=<?php echo escape($tid); ?> class="formtextboxsmall" >
      </td>

      <td><?php echo escape($row["tname"]);?> </td>
        <td><a href="delete-section.php?cid=<?= $cid?>&sec_id=<?= $sec ?>&year=<?= $year ?>&sem=<?= $sem?>"><i class="fas fa-trash-alt"></i></a></td>
        <!-- <td><a href="delete-section.php?cid=<?= $row["cid"] ?>?sec_id=<?php echo escape($row["sec_id"]); ?>?year=<?php echo escape($row["year"]); ?>?sem=<?php echo escape($row["sem"]); ?>">Delete</a></td> -->
   </tr> 
    <?php endforeach; ?>

   </tbody>

</table>
<br> 
    <a class="gobacklink" style="display: inline-block; background-color:salmon;" href="managecourse.php">Back to manage course</a>
     <input style="display: inline-block;" type="submit" name="submit" class="submitbutton" value="Submit">
</form>

</div>

    <?php require "templates/footer.php"; 
} else {
    echo "Something went wrong!";
    exit;
}

?>
