<?php
if(isset($_POST['sub3'])){
	$subtype = $_POST['sub3'];
	
	$thisyear= date('Y');
	$thisyear = $thisyear - 1;

	$query1 = 'SELECT * from ทุนสร้างชื่อเสียงและทำคุณประโยชน์
				where sch_year = '.$thisyear ;
	
	// fetch scholarship information
	$res = mysqli_query($db, $query1) ;
	$sch = mysqli_fetch_array($res);
	if($subtype >= 2){ 
		$sch = mysqli_fetch_array($res);
	}
	if($subtype >= 3){ 
		$sch = mysqli_fetch_array($res);
	}if($subtype == 4){ 
		$sch = mysqli_fetch_array($res);
	}

	$needGrade = $sch['min_GPA'];
	?>
	<div style="width: 800px;">
	<p><pre> 
	minimum grade requirement: 		<?=	$needGrade ?> ,
	minimum conduct score requirement:	<?= $sch['min_conduct_score'] ?> ,
	minimum number of awards : 		<?= $sch['num_awards'] ?>

<?php 	$aa = explode('*',$sch['otherreq']); 
		foreach($aa as $val){
		echo "<p>*"; echo $val;
		echo "</p>";
}
	?>
		</pre></p>
	</div>

<?php
// fetch student current gpax		
	$query2 = 'SELECT sum(E.grade * C.credits) / sum(C.credits) as gpax
			from enroll E, course C 
	where E.grade is not null and E.cid = C.cid and E.sid = '.$user_check.';';
	$gradeOKK  = mysqli_query($db,$query2);
	$result2 = mysqli_fetch_array($gradeOKK);
	$myGrade = $result2['gpax'];

// fetch student conduct score 	
	$query4 = "SELECT conduct_score from student where sid = ".$user_check.';';
	$result04 = mysqli_query($db,$query4);
	$my_conduct_score = mysqli_fetch_array($result04)['conduct_score']; 
// start checking all qualifications
	if($myGrade >= $sch['min_GPA'] and
		 $my_conduct_score>= $sch['min_conduct_score'])
	{ ?>
		<p><pre>

		You pass the basic criteria. 
		If you think you have enough number of awards, 
		please apply below.

	</pre></p>	
	<form method="post" action="">
	<input type = 'hidden' name="schname" value= <?php echo $sch['sch_name'] ?>>
    <input type="submit" name="applynao" value="applynao" /><br/>

</form>
<?php }
?>
<?php
}else{
	echo "please complete the form.";
}	
?>
