<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
  <head>  
    <title>Transcript</title>  
    <meta http-equiv="content-type"  
        content="text/html; charset=utf-8"/> 
   <link rel="stylesheet" href="tablestyle.css">
  </head>  
  <body >

<?php
//showTranscripts.php
	include 'session.php';
	include 'common.php';
	include 'checkstudent.php';

	$sql = "SELECT S.sid, S.nat_id, S.fname, S.lname, D.dep_name, F.fac_name,S.stype,S.enroll_year
 			FROM student S, department D, faculty F
			WHERE S.dep_id = D.dep_id AND F.fac_id = D.fac_id AND S.sid='". $user_check."';";
	$result= mysqli_query($db,$sql);
	if(!$result){
		echo "cannot fetch student info";
		exit();
	}
	$row= mysqli_fetch_array($result);
			

	echo '
	<table style="height: 92px; width: 1050px;">
<tbody>
<tr style="height: 124px;">
<td style="width: 161px; height: 124px; text-align: center;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Phra_Kiao.svg/200px-Phra_Kiao.svg.png" alt="" width="81" height="122" /></td>
<td style="width: 363px; height:  124px;">&nbsp;</td>
<td style="width: 273px; height: 124px;">&nbsp;</td>
<td style="width: 249px; text-align: center; height: 124px;">CR25</td>
</tr>
<tr style="height: 13px;">
<td style="width: 161px; height: 13px; text-align: center;"><strong>CHULALONGKORN</strong></td>
<td style="width: 363px; height: 13px;">NAME &nbsp; '.$row['fname'].'&nbsp; &nbsp; '.$row['lname'].'</td>
<td style="width: 273px; height: 13px;"></td>
<td style="width: 249px; height: 13px;">STUDENT ID   '.$row['sid'].'</td>
</tr>
<tr style="height: 13px;">
<td style="width: 161px; height: 13px; text-align: center;"><strong>UNIVERSITY</strong></td>
<td style="width: 363px; height: 13px;">IDENTIFICATION NO.&nbsp; '.$row['nat_id'].'</td>
<td style="width: 273px; height: 13px;"></td>
<td style="width: 249px; height: 13px;">as of &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.date("d-m-Y").'</td>
</tr>
<tr style="height: 13px;">
<td style="width: 161px; height: 13px; text-align: center;">BANGKOK 10330</td>
<td style="width: 363px; height: 13px;">ADMISSION YEAR&nbsp; &nbsp; &nbsp;'. $row['enroll_year'].' (B.E.'.($row['enroll_year'] + 543).')</td>
<td style="width: 273px; height: 13px;"></td>
<td style="width: 249px; height: 13px;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="width: 161px; height: 13px; text-align: center;">THAILAND</td>
<td style="width: 363px; height: 13px;">FACULTY&nbsp; '.$row['fac_name'].'</td>
<td style="width: 350px; height: 13px;"></td>
<td style="width: 249px; height: 13px;">&nbsp;</td>
</tr>
<tr style="height: 13.4688px;">
<td style="width: 161px; height: 13.4688px;">&nbsp;</td>
<td style="width: 363px; height: 13.4688px;">DEPT/PROGRAM&nbsp; &nbsp; '.$row['dep_name'].'</td>
<td style="width: 273px; height: 13.4688px;"></td>
<td style="width: 249px; height: 13.4688px;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="width: 161px; height: 13px;">&nbsp;</td>
<td style="width: 400px; height: 13px;">DEGREE&nbsp; &nbsp; '.$row['stype'].'</td>
<td style="width: 273px; height: 13px;">&nbsp;</td>
<td style="width: 249px; height: 13px;">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 1050px; border-color: #000000;" border="1">
<tbody>
<tr>
<td style="width: 50px;">COURSE NO.</td>
<td style="width: 873px; text-align: center;">ABBREVIATED NAME</td>
<td style="width: 61px;">CREDIT</td>
<td style="width: 66px;">GRADE</td>
</tr>
</tbody>
</table>';

	$query = "SELECT distinct E.yearr, E.sem FROM enroll E WHERE E.sid = " .$user_check." order by E.yearr, E.sem ;";
	
	$result = mysqli_query($db, $query);
	if(!$result){
		$error = "Error fetching fee";
		include 'error.html.php';
		exit();
	}
	//////////////////////////////////////////////
	while($row = mysqli_fetch_array($result)){
		$no = 1 ;
		$query2 = "SELECT E.cid, C.cname, C.credits, E.grade
					FROM enroll E, course C
					WHERE E.sid =".$user_check. " and 
					C.cid = E.cid and E.yearr = ". $row['yearr']. " and E.sem = ".$row['sem'].";";
		$result2 = mysqli_query($db, $query2);
		if(!$result2){
			$error = "Error fetching grade";
			include 'error.html.php';
			exit();
		}
		echo '<table style="width: 1050px;">'; 
		$semFont = $row['sem'];
		if($semFont==='1') $semFont = '1ST';
		elseif ($semFont==='2') $semFont = '2ND';
		elseif ($semFont==='3') $semFont = '3RD';

		echo '<caption class="title"><strong> '.$semFont.' Semester  : '. $row['yearr'].'</strong></caption>';
	  
  		while ($row2 = mysqli_fetch_array($result2)){
		$gradeFont = $row2['grade'];
		if(is_null($gradeFont)) $gradeFont = 'X';
		elseif($gradeFont==='4') $gradeFont = 'A';
		elseif ($gradeFont==='3.5') $gradeFont = 'B+';
		elseif ($gradeFont==='3') $gradeFont = 'B';
		elseif ($gradeFont==='2.5') $gradeFont = 'C+';
		elseif ($gradeFont==='2') $gradeFont = 'C';
		elseif ($gradeFont==='1.5') $gradeFont = 'D+';
		elseif ($gradeFont==='1') $gradeFont = 'D';
		elseif ($gradeFont==='0') $gradeFont = 'F';
		elseif ($gradeFont==='-1') $gradeFont = 'W';

  		echo'<tr>
			<td style="width: 50px;">'.$row2['cid'].'</td>
			<td style="width: 900px; text-align: left; padding-left: 20px;">'.$row2['cname'].'</td>
			<td style="width: 50px; text-align: center;">'.$row2['credits'].'</td>
			<td style="width: 50px; text-align: center;">'.($gradeFont===null ? "X":$gradeFont).'</td></tr>';
      	$no++;
  		} 

  	$query3 = "SELECT sum(E.grade*C.credits)/sum(C.credits) as gpa FROM enroll E, course C WHERE E.cid = C.cid and E.sid = " .$user_check . " AND  E.yearr =  " .$row['yearr']. " AND E.sem = ".$row['sem']." AND E.grade != -1;" ;
  	$result3 =  mysqli_query($db,$query3);
  	$row3 = mysqli_fetch_array($result3 );
	echo '<tr style="height:3px;"></tr><tr class = "gparow">
			<td> </td>
			<td> </td> 
			<td style="text-align:center;"> GPA </td>
			<td style="text-align:center;">'. ($row3['gpa'] === null ? "-": round($row3['gpa'],2))   .'</td>
			<td></td>
			</tr></tbody>'; 
	}
	////////////////////////////////////////////
	$query4 = 'SELECT sum(E.grade*C.credits)/sum(C.credits) as gpax FROM enroll E,course C WHERE E.cid = C.cid and E.sid = '.$user_check ." and E.grade is not null AND E.grade != -1;";//  
	$result4 = mysqli_query($db,$query4);
	$row4 = mysqli_fetch_array($result4);
	echo '<tr class="gpaxrow"> 
		<td style="width="300px;"> &nbsp; </td> 
		<td style="width="300px;> &nbsp;</td>
		<td><strong>GPAX</strong></td>
			<td><strong>'.($row4['gpax']===null? '-': round($row4['gpax'],2)) .'</strong><td>
			</tr></tbody>';

	
?>
  </body>  
</html>