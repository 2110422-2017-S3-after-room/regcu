<?php
if (isset($_POST['submit'])) {
	require "common.php";
  	include "session.php";
  	include "checkstaff.php";
}
?>

<?php
	require "templates/header.php"; 
	include "splitleft-staff.html";
?>
 <div class="splitright">
<div style="padding-left: 20px;">
  <h2>Add a scholarship</h2>

  <form action="create-scholarship-single.php" method="post" class="form">
    <label class="formtitle">Add a scholarship</label><br><br>
    <label for="sch_name">Scholarship's name</label>
    <input type="text" name="sch_name" id="sch_name" class="formtextbox">
    <label for="sch_year">Year</label>
    <input type="number" name="sch_year" id="sch_year" class="formnumberbox"><br><br>
     <label for="sch_amount">Full Name</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="sch_full_name" id="sch_full_name" class="formtextbox"><br><br>
    <label for="sch_owner">Owner</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="sch_owner" id="sch_owner" class="formtextbox"><br><br>
    <label for="sch_amount">Amount</label>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="sch_amount" id="sch_amount" class="formtextbox"><br><br>
    <label for="sch_type">Type</label>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<select name="sch_type" class="formdropdown">
      <option value="1"> 1 : ทุนอุดหนุนการศึกษา </option>
      <option value="2"> 2 : ทุนรางวัลเรียนดี </option>
      <option value="3"> 3 : ทุนสร้างชื่อเสียงและคุณประโยชน์ </option>
      <option value="4"> 4 : กยศ </option>
      <option value="5"> 5 : ทุนการศึกษาจากหน่วยงานภายนอก </option>
    </select><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton" style="float: right; margin-right: 30px;"><br><br>
  </form>
  <br>
  <a class="gobacklink" href="managescholarship.php">Back to manage scholarships</a>
</div></div>

<?php require "templates/footer.php"; ?>
