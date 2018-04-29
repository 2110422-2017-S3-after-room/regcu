<?php require "templates/header.php";
  include "splitleft-staff.html";
 ?>
<div class="splitright">
<?php include "backbuttonstaff.html" ?>
<div style="padding-left: 10px;">
  <h1> Manage Scholarship </h1><br>
  <div style="width: 400px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find scholarships </label>
    <br>
    <h2>Based on name, year, owner</h2>
    <input class="formtextbox" type="text" id="sch_name" name="sch_name">
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  <!-- <a href="staffhome.php" class="gobacklink">Back to main menu</a> -->
  <a href="create-scholarship.php" class="gobacklink">Add new scholarship</a>
  </div>

<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";
    require "checkstaff.php";
    // $connection = new PDO($dsn, $username, $password, $options);

    $sch_name = $_POST['sch_name'];
    $sql = "SELECT * FROM scholarship
            WHERE sch_name like '%$sch_name%' 
            or sch_year like '%$sch_name%' 
            or sch_owner like '%$sch_name%'
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
if (isset($_POST['submit'])) {
  // if ($result && $statement->rowCount() > 0) { 
  if($result && $count > 0){ ?>
    <h2>Results</h2>

    <table class="data-table" style="width:1000px; display: block; overflow: scroll;height: 300px;">
      <thead>
        <tr>
          <th>Year</th>
          <th>Name</th>
          <th>Owner</th>
          <th>Amount</th>
          <th>Type</th>
          <th>Full Name</th>
 
          <th>Edit </th>
          <th> Delete</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td style="font-family:Pridi;"> <?php echo escape($row["sch_year"]); ?></td>
          <td style= "font-family:Pridi;" > <?php echo escape($row["sch_name"]); ?></td>
          <td style="font-family:Pridi;"><?php echo escape($row["sch_owner"]); ?></td>
          
          <td><?php echo escape($row["sch_amount"]); ?></td>

          <td style="font-family:Pridi;"> <?= escape($row["sch_type"]) ?> </td>
          <td style="font-family:Pridi;">  <?= escape($row["sch_full_name"]) ?> </td>
          
          <td ><a href="update-scholarship-single.php?sch_name=<?php echo escape($row["sch_name"]); ?>">Edit</a></td>
          
          <td><a href="delete-scholarship.php?sch_name=<?php echo escape($row["sch_name"]); ?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
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
