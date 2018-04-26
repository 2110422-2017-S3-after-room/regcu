<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "session.php";
require "common.php";

if (isset($_GET['cid'])) {
  
    $cid = $_GET['cid'];

    $sql = "SELECT S.sec_id, S.yearr, S.sem, S.tid, C.cname, T.tname 
            FROM section S, course C, teacher T 
            WHERE S.cid = ".$cid." AND S.cid=C.cid AND T.tid=S.tid;" ;
    
    $result =  mysqli_query($db,$sql);
    if(!$result){
      echo "cannot fetch";
      exit();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['cname']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit a user</h2>

<table class="data-table">
  <caption> <?= $cid ?> </caption>
  <thead> 
    <th> section id</th>
    <th> year</th>
    <th> semester</th>
    <th> teacher name</th>

  </thead>
  <tbody>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
      <td><?php echo escape($row["sec_id"]); ?></td>
      <td><?php echo escape($row["yearr"]); ?></td>
      <td><?php echo escape($row["sem"]); ?></td>
      <td><?php echo escape($row["tname"]);?> </td>
        </tr>
      <?php } ?>

   </tbody>
</table>

<a href="read-course.php">Back to read courses</a>
<?php require "templates/footer.php"; ?>