<?php 
   require "session.php";
    require "common.php";
    require "checkstaff.php";
  require "templates/header.php";
  include "splitleft-staff.html";
 ?>
<div class="splitright">
<?php include "backbuttonstaff.html" ?>
<div style="padding-left: 10px;">
  <h1> Manage Scholarship Application </h1><br>
  <div style="width: 400px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find application </label>
    <br>
    <h2>Based on scholarship name, year, student ID</h2>

    Scholarship Name <input class="formtextbox" type="text" id="sch_name" name="sch_name"><br>
    Scholarship Year <input class="formnumberbox" type="number" id="sch_year" name="sch_year"><br>
    Student ID <input class="formtextbox" type="text" id="sid" name="sid"><br>
 
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  
  </div> 

<?php

if (isset($_POST['submit'])) {
  try  {
      
   
    // $connection = new PDO($dsn, $username, $password, $options);
    $sch_name = ""; $sch_year=""; $sid="";
    $sch_name = $_POST['sch_name'];
    $sch_year = $_POST['sch_year'];
    $sid = $_POST['sid'];
    $sql = "SELECT * FROM apply_scholarship
            WHERE sch_name like '%$sch_name%' 
            and sch_year like '%$sch_year%' 
            and sid like '%$sid%'
            order by apply_date
            ";
   
    // $statement = $connection->prepare($sql);
    // $statement->bindParam(':sch_name', $sch_name, PDO::PARAM_STR);
    // $statement->execute();
    $result =  mysqli_query($db,$sql);
    if(!$result){
      echo "cannot fetch table";
    }
    $count = mysqli_num_rows($result);
    //$result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php 

  if(isset($_POST['accept']) && isset($_POST['sel'])){

      $count =  count($_POST['sid']);
      foreach($_POST['sel'] as $index){
        echo "index = "; echo $index;
        $sid = $_POST['sid'][$index];
        $name = $_POST['schname'][$index];
        $year = $_POST['schyear'][$index];
        
        $qa = "UPDATE apply_scholarship
                SET app_status = 2 , receive_date ='".date(
                  'Y-m-d'). "' 
                WHERE sid = '".$sid."' and sch_name = '".$name."' and sch_year = ".$year.";";
        $resqa = mysqli_query($db, $qa);
        
      }
  }
  if(isset($_POST['reject']) && isset($_POST['sel'])){

      $count =  count($_POST['sid']);
      foreach($_POST['sel'] as $index){
        $sid = $_POST['sid'][$index];
        $name = $_POST['schname'][$index];
        $year = $_POST['schyear'][$index];
    
        $qr = "UPDATE apply_scholarship
            SET app_status = 3  
            WHERE sid = '".$sid."' and sch_name = '".$name."' and sch_year = ".$year.";";
        $resqr = mysqli_query($db, $qr);
      }
  }
?>

        
<?php  
if (isset($_POST['submit'])) {
  // if ($result && $statement->rowCount() > 0) { 
  if($result && $count > 0){ ?>
    <h2>Results</h2>
<form name="form2" method="post">
    <input type="submit" name="accept" value="accept" class="acceptbutton" >
    <input type="submit" name="reject" value="reject" class="rejectbutton" >
    <table class="data-table" style="width:800px;" display: block; overflow: scroll;height: 300px;">
      <thead>
        <tr>
          <th>Year</th>
          <th>Scholarship Name</th>
          <th>Student</th>
          <th>Apply Date</th>
          <th>Receive Date </th>
          <th>Status</th> 
          <th> Select </th>

        </tr>
      </thead>
      <tbody>

      <?php $j = 0 ;          $sel = array();
       foreach ($result as $row) : ?>
        <tr>


          <td style="font-family:Pridi;"> <?=$row['sch_year'] ?><input type="hidden" name="schyear[]" value=<?php echo escape($row["sch_year"]); ?>> </td>
          
          <td style= "font-family:Pridi;" > <?= escape($row["sch_name"]) ?> <input type="hidden" name="schname[]" value=<?php echo escape($row["sch_name"]); ?>></td>
          
          <td style="font-family:Pridi;">  <?php echo escape($row["sid"]); ?> <input type="hidden" name="sid[]" value=<?php echo escape($row["sid"]); ?>></td>
          
          <td style="font-family:Pridi;"> <?= escape($row["apply_date"]) ?> </td>
          
          <td style="font-family:Pridi;">  <?= escape($row["receive_date"]) ?> <input type="hidden" name="rcvdate[]" value=<?php echo escape($row["receive_date"]); ?>> </td>
          
          <td style="font-family:Pridi;">  <?= escape($row["app_status"]) ?> <input type="hidden" name="stat[]" value=<?php echo escape($row["app_status"]); ?>></td>
          
          <td> <input id="sel" name="sel[]" type="checkbox" value=<?= $j ?>></td>
          <?php $j++; ?>
          <!-- <td ><a href="update-scholarship-single.php?sch_name='<?php echo escape($row["sch_name"]); ?>'" <?= $row['app_status']>'1' ? "disabled" : null ?>>Accept</a></td>
          <td><a href="delete-scholarship.php?sch_name=<?php echo escape($row["sch_name"]); ?>&sch_year=<?= $row["sch_year"]?>" <?= $row['app_status'] > '1' ? "disabled" : null ?>>Reject</a></td> -->        
        </tr>
      <?php endforeach; ?>

      </tbody>
    </table>
  </form>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['sch_name']); ?>.</blockquote>
    <?php } 
} ?> 


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
</div>
<?php require "templates/footer.php"; ?>
