<?php


if(isset($_POST['sub4'])){
	$subtype = $_POST['sub4'];

	$thisyear= date('Y');
	$thisyear = $thisyear - 1;
	$sem = $thissem / 2 ;
// fetch scholarship information
	$query1 = 'SELECT * from กยศ
				where sch_year = '.$thisyear
				.' and type = '.$subtype.' ' ;
	
	$res = mysqli_query($db, $query1) ;
	$sch = mysqli_fetch_array($res);
	$ciel = $sch['max_loan_amount'];
	$det = $sch['detail'];
	
	//fetch student enrollment fee
	$query2 = 'select SG.fee_amount 
	from student S, student_group SG
	where SG.group_id = S.group_id 
	and S.enroll_year = SG.enroll_year 
	and SG.sem = '.$sem.'
	and S.sid = "'. $user_check .'";';
	$res2 = mysqli_query($db, $query2) ;
	$fee = mysqli_fetch_array($res2)['fee_amount'];

	?>



	<div style="padding: 20px;">
	<p><pre style="white-space: pre-wrap;"> 
	maximum loan amount : 	<?=	$ciel ?> 
	amount you can loan: <?= min($fee,$ciel) ?>  (according to enrollment fee)
	detail : <?= $det ?>

	</pre></p>
	
</div>


<?php 
	

	if($subtype==1){ ?>
		<p><pre>

		You pass the basic criteria.  
		please apply below or visit the websites below for more information.
		<a href="www.studentloan.or.th
www.sa.chula.ac.th">www.studentloan.or.th </a>
		<a href="www.sa.chula.ac.th">www.sa.chula.ac.th </a>

			</pre></p>
		<form method="post" action="">
		<input type = 'hidden' name="schname" value= <?php echo $sch['sch_name'] ?>>
    	 <input type="submit" name="applynao" value=" Apply Nao " class="acceptbutton" style="width: 150px;" /><br/><br/>
<?php
	}else if ($subtype==2){
		// fetch faculty that can apply
		$query11 = "select * 
		from can_apply_กรอ_sch c, student s, department d 
		where c.sch_name='".$sch['sch_name']."' 
		and c.sch_year ='".$sch['sch_year']."'
		and s.sid = ".$user_check."
		and s.dep_id = d.dep_id 
		and d.fac_id = c.fac_id ;";


		$res11 = mysqli_query($db, $query11);
		if(mysqli_num_rows($res11)==1){
			$facok = 1;
		}else{
			$facok = 0;
		}
		if($facok){ ?>
			<p><pre>

		You pass the basic criteria.  
		please apply below or visit the websites below for more information.
		<a href="www.studentloan.or.th
www.sa.chula.ac.th">www.studentloan.or.th </a>
		<a href="www.sa.chula.ac.th">www.sa.chula.ac.th </a>

			</pre></p>

		<form method="post" action="">
	<input type = 'hidden' name="schname" value= <?php echo $sch['sch_name'] ?>>
    <input type="submit" class="acceptbutton" name="applynao" value="applynao" /><br/>
<?php	}else{ ?>
			<p><pre>

		You are not a student of a faculty which can apply.
		Visit the websites below for more information.
		<a href="www.studentloan.or.th
www.sa.chula.ac.th">www.studentloan.or.th </a>
		<a href="www.sa.chula.ac.th">www.sa.chula.ac.th </a>

			</pre></p>
<?php		}

	}


?>

<?php
}

?>