
<p><pre> 
	There are no specific requirements for this scholarship type.

	According to sa.chula.ac.th, 
		สามารถติดต่อยื่นเรื่องขอรับทุนอุดหนุนการศึกษาได้ที่ฝ่ายกิจการนิสิตของคณะที่นิสิตสังกัด ดังนี้
			• นิสิตปัจจุบัน ระหว่างเดือนมกราคม – กุมภาพันธ์ ของทุกปี
			• นิสิตใหม่สามารถติดต่อกับสำนักกิจการนิสิตของคณะต้นสังกัดได้โดยตรง
		โดยที่นิสิตใหม่สามารถสมัครทุนผ่านทางเว็บไซต์ออนไลน์ของจุฬาลงกรณ์มหาวิทยาลัยได้ที่
		http://scholar.sa.chula.ac.th/
	But for science, we will let them apply here.

</pre> </p>

<?php 
	$sql = "select * from scholarship where sch_type = 1 and sch_year = 2017";
	$sch = mysqli_fetch_array(mysqli_query($db,$sql));
	

?>


<form method="post" action="">
	<input type = 'hidden' name="schname" value= <?php echo $sch['sch_name'] ?>>
    <input type="submit" name="applynao" value=" Apply Nao " class="acceptbutton" style="width: 150px;" /><br/>
</form>
 
	