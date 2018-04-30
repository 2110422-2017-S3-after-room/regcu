<?php
if(isset($_POST['sub1'])){
$subtype = $_POST['sub1'];

$thisyear= date('Y');
$thisyear = $thisyear - 1;

$query1 = 'SELECT * from excellent_academic_sch
			where sch_year = '.$thisyear ;
 
// fetch scholarship information
		$gradeOK = mysqli_query($db, $query1) ;
		$sch = mysqli_fetch_array($gradeOK);
		if($subtype == 2){ //if ทุนเรียนดี2
			$sch = mysqli_fetch_array($gradeOK);
		}
		$needGrade = $sch['min_GPA'];
	?>
		
		<p><pre> 
	minimum grade requirement: 		<?=	$needGrade ?> ,
	minimum conduct score requirement:	<?= $sch['min_conduct_score'] ?> ,
	maximum family yearly income : 		<?= $sch['max_family_income'] ?>
		</pre></p>
<?php
// fetch faculty that can apply
		$query11 = "select * 
		from can_apply_academic_sch caas, student s, department d 
		where caas.sch_name='".$sch['sch_name']."' 
		and caas.sch_year ='".$sch['sch_year']."'
		and s.dep_id = d.dep_id and d.fac_id=caas.fac_id and s.sid=".$user_check.";"; 
		$res11 = mysqli_query($db, $query11);
		if(mysqli_num_rows($res11)==1){
			$facok = 1;
		}else{
			$facok = 0;
		}
// fetch student current gpax		
		$query2 = 'SELECT sum(E.grade * C.credits) / sum(C.credits) as gpax
 			from enroll E, course C 
		where E.grade is not null and E.cid = C.cid and E.sid = '.$user_check.';';
		$gradeOKK  = mysqli_query($db,$query2);
		$result2 = mysqli_fetch_array($gradeOKK);
		$myGrade = $result2['gpax'];

// fetch student conduct score and department	
		$query4 = "SELECT conduct_score , dep_id from student where sid = ".$user_check.';';
		$result04 = mysqli_query($db,$query4);
		$my_conduct_score = mysqli_fetch_array($result04)['conduct_score']; 
		$my_dep = mysqli_fetch_array($result04)['dep_id'];
// fetch student family income
		$query3 = 'select sum(FMD.yearly_income) as total_income
              from family_member_detail FMD, family_member FM
              where FM.sid = "'.$user_check.'" and FMD.fnat_id = FM.fnat_id ;';
        
		$income = mysqli_query($db,$query3);
		$result3 = mysqli_fetch_array($income);
		$myIncome = $result3['total_income'];
		
		$myIncome = floatval($myIncome);
		$my_conduct_score = intval($my_conduct_score);
		$myGrade = floatval($myGrade);
		
echo $myIncome >= $sch['max_family_income'];

// start checking all qualifications
		if($myGrade >= $sch['min_GPA'] and
			 $my_conduct_score>= $sch['min_conduct_score']
			and $myIncome <= $sch['max_family_income'])
		{

			if($subtype==1 & $facok){ ?>
				<p>You pass the basic criteria, but you the application must be submitted by the faculty and not through this website. Contact them for more information.</p>
				
<?php		}else if($subtype==1 & !$facok){ ?>
          		<p>You don't have what it takes to apply for this scholarship. D: </p>
<?php	
			}else{	
?>

			<p>You pass the basic criteria, but you the application must be submitted by the faculty and not through this website. Contact them for more information.</p>
<?php  		}      
		}else{ ?>
          <p>You don't have what it takes to apply for this scholarship. D: </p>
<?php	}
} else{
	echo "please complete the form.";

}		
?>