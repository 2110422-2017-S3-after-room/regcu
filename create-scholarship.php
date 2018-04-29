<?php
if (isset($_POST['submit'])) {

  require "common.php";
  include "session.php";
  include "checkstaff.php";
    // $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "sch_name" => $_POST['sch_name'],
      "sch_year"  => $_POST['sch_year'],
      "sch_owner"     => $_POST['sch_owner'],
      "sch_amount"     => $_POST['sch_amount'],
    );

    $sql =  "SELECT count(*) as countt FROM scholarship S WHERE S.sch_name ='".$_POST['sch_name']."';";

    $result = mysqli_query($db,$sql);
    // if(!$result){
    //   echo "Can't fetch scholarship";
    //   exit();
    // }
    $row = mysqli_fetch_array($result);
    if($row['countt'] == 1){
      echo "Scholarship already exists. Please go to edit scholarship instead.";
      exit();
    }

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
     
    $sql2 = "INSERT INTO scholarship
    (sch_name,sch_year,sch_owner,sch_amount, sch_type, sch_full_name) 
    VALUES('".$_POST['sch_name']."' , '". $_POST['sch_year']."' , '".$_POST['sch_owner']."', '".$_POST['sch_amount']."', '".$_POST['sch_type']."', '".$_POST['sch_full_name'].");";
    $result2 = mysqli_query($db,$sql2);
    if(!$result2){
      echo "Please go back to complete the form.";
      exit();
    }
    

 }

 require "templates/header.php"; 
include "splitleft-staff.html";
?>
 <div class="splitright">
<div style="padding-left: 20px;">
  <h2>Add a scholarship</h2>

  <form method="post" class="form">
    <label class="formtitle">Add a scholarship</label><br><br>
    <label for="sch_name">Scholarship's name</label>
    <input type="text" name="sch_name" id="sch_name" class="formtextbox">
    <label for="sch_year">Year</label>
    <input type="number" name="sch_year" id="sch_year" class="formnumberbox"><br><br>
     <label for="sch_amount">Full Name</label>
    <input type="text" name="sch_amount" id="sch_amount" class="formtextbox"><br><br>
    <label for="sch_owner">Owner</label>
    <input type="text" name="sch_owner" id="sch_owner" class="formtextbox"><br><br>
    <label for="sch_amount">Amount</label>
    <input type="text" name="sch_amount" id="sch_amount" class="formtextbox"><br><br>

    <label for="sch_amount">Type</label>
    <select name="sch_amount">
      <option value="1"> 1 : ทุนอุดหนุนการศึกษา </option>
      <option value="2"> 2 : ทุนรางวัลเรียนดี </option>
      <option value="3"> 3 : ทุนสร้างชื่อเสียงและคุณประโยชน์ </option>
      <option value="4"> 4 : กยศ </option>
      <option value="5"> 5 : ทุนการศึกษาจากหน่วยงานภายนอก </option>
    </select>
    <input type="text" name="sch_amount" id="sch_amount" class="formtextbox"><br><br>

   
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br><br>
  </form>
  <br>
  <a class="gobacklink" href="managescholarship.php">Back to manage scholarships</a>
</div></div>
<?php     if (isset($_POST['submit']) && $statement) { 
?>
      <blockquote><?php echo escape($_POST['sch_name']); ?> successfully added.</blockquote>
      <?php   } ?>
</div>

<?php
if (isset($_POST['submit'])) {
  if($_POST['sch_type'] == 1){

    }
}
?>
<?php require "templates/footer.php"; ?>
