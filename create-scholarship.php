<?php
if (isset($_POST['submit'])) {
	require "common.php";
  	include "session.php";
  	include "checkstaff.php";
  	$sch_name = $_POST['sch_name'];
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
  	<?php
		if (isset($_POST['submit'])) { ?>
			<label><?php echo $sch_name; 
			echo "successfully added.";?></label>	
	<?php	}
	?>
    <label class="formtitle">Add a scholarship</label><br><br>
    <label for="sch_type">Type</label>
    <select name="sch_type">
      <option value="1"> 1 : ทุนอุดหนุนการศึกษา </option>
      <option value="2"> 2 : ทุนรางวัลเรียนดี </option>
      <option value="3"> 3 : ทุนสร้างชื่อเสียงและคุณประโยชน์ </option>
      <option value="4"> 4 : กยศ </option>
      <option value="5"> 5 : ทุนการศึกษาจากหน่วยงานภายนอก </option>
    </select><br><br>
    <input type="submit" name="submit" value="Submit" class="submitbutton"><br><br>
  </form>
  <br>
  <a class="gobacklink" href="managescholarship.php">Back to manage scholarships</a>
</div></div>

<?php require "templates/footer.php"; ?>
