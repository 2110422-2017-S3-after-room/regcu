<?php
	include('session.php'); 
  include('checkstudent.php');
?>

	<?php 

		include 'templates\header.php';
		include 'splitleft.html'; ?>
	<div class="splitright">
		<?php include 'backbuttonstudent.html'; ?>
<div>

  <div style="width: 1000px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find scholarships </label>
    <br>
    <h2>Based on name, year, owner, and type</h2>
    Name <input class="formtextbox" type="text" id="sch_name" name="sch_name">
    Year <input type="number" name="sch_year" id="sch_year" class="formnumberbox" max=2018 min=2000><br>
    Type 
    <select class="formdropdown" name="sch_type">
      <option value="1"> 1 : ทุนอุดหนุนการศึกษา </option>
      <option value="2"> 2 : ทุนรางวัลเรียนดี </option>
      <option value="3"> 3 : ทุนสร้างชื่อเสียงและคุณประโยชน์ </option>
      <option value="4"> 4 : กยศ </option>
      <option value="5"> 5 : ทุนการศึกษาจากหน่วยงานภายนอก </option>
    </select>
    <br>
    Owner <input class="formtextbox" type="text" id="sch_owner" name="sch_owner">
    
    
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  </div>

<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "common.php";

    // $connection = new PDO($dsn, $username, $password, $options);

    $sch_name = $_POST['sch_name'];
    
    // $sql = "SELECT * FROM scholarship WHERE 
    // (sch_name like '%".$_POST['sch_name']."%' or sch_full_name like '%".$_POST['sch_name']."%' )
    //         ".isset($_POST['sch_year']) ? "and sch_year =".$_POST['sch_year']  :  "" ." 
    //         and sch_owner like '%".$_POST['sch_owner']."%'
    //         and sch_type =".$_POST['sch_type']."";
    $check_year = "";
    if(!is_null($_POST['sch_year'])){
      $check_year = "and sch_year = ".$_POST['sch_year'];
    }
    $sql = "SELECT * FROM scholarship WHERE 
  (sch_name like '%".$_POST['sch_name']."%' or sch_full_name like '%".$_POST['sch_name']."%')
  and sch_owner like '%".$_POST['sch_owner']."%' 
  and sch_type = ".$_POST['sch_type']."  
  "  .$check_year.";" ;
    
    $result = mysqli_query($db,$sql);
    if(!$result){
      echo "cannot fetch scholarship";
    }

    // $statement = $connection->prepare($sql);
    // $statement->bindParam(':sch_name', $sch_name, PDO::PARAM_STR);
    // $statement->execute();

    // $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
        
<?php  
if (isset($_POST['submit'])) {
  // if ($result && $statement->rowCount() > 0) {
    if($result && mysqli_num_rows($result) > 0 ){ ?>
    <h2>Results</h2>

    <table class="data-table" style="width: 1000px; display: block; overflow: scroll;height: 300px;">
      <thead>
        <tr>
          <th>Year</th>
          <th>Name</th>
          <th>Owner</th>
          <th>Amount</th>
          <th>Type </th>
          <th>Full Name</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["sch_year"]); ?></td>
          <td><?php echo escape($row["sch_name"]); ?></td>
          <td><?php echo escape($row["sch_owner"]); ?></td>
          <td><?php echo escape($row["sch_amount"]); ?></td>
          <td><?php echo escape($row["sch_type"]); ?></td>
          <td><?php echo escape($row["sch_full_name"]); ?></td>
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
<?php require "templates/footer.php"; ?>

	</div>

</body>
</html>