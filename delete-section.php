<?php

/**
 * Delete a section
 */

require "common.php";
require "session.php";

if (isset($_GET["cid"]) and isset($_GET["sec_id"]) and isset($_GET["year"]) and isset($_GET["sem"])) {
  try {
    $cid = $_GET["cid"];
    $sec_id = $_GET["sec_id"];
    $year = $_GET["year"];
    $sem = $_GET["sem"];
 
    $sql = "DELETE FROM section WHERE cid = ".$cid." AND sec_id=".$sec_id." AND yearr=".$year." AND sem=".$sem.";";
    $result = mysqli_query($db, $sql);
    if(!$result){
      echo "Error deleting";
      exit();
    }
   header('Location: read-course-single.php?cid='.$cid);  }
   catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

