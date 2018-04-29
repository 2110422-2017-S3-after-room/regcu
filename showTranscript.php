

<?php 
include 'templates/header.php';
include 'splitleft.html'; ?>



<div class="splitright" style="background-image: none">
  	<?php include 'backbuttonstudent.html'; ?>
    <a class="gobacklink" href='showTranscripts.php'" target="_blank" style="">Print Transcript</a>
    
    
    
<?php
//showTranscript.php
	include "session.php";
	$role = $_SESSION['user_role'];
   	if(!isset($_SESSION['user_role']) | $_SESSION['user_role'] != 'student' ){
    	header("Location: login.php");
   	}
	
	$query = "SELECT distinct E.yearr, E.sem FROM enroll E WHERE E.sid = " .$user_check." order by E.yearr, E.sem ;";
	
	$result = mysqli_query($db, $query);
	if(!$result){
		$error = "Error fetching fee";
		include 'error.html.php';
		exit();
	}
	
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
		echo '<table class="data-table"  style="min-width=700px;">'; 
		echo '<caption class="title">  <h1>Year  : ' . $row['yearr'] . '&#9; &emsp;Sem : '.$row['sem'].' </h1>  </caption>';
		echo'  
			<thead>
	      		<tr>
			        <th> # </th>
			        <th>COURSE ID</th>
			        <th>COURSE NAME</th>
			        <th>CREDITS</th>
			        <th>GRADE</th>
			    </tr>
	    	</thead>
	  	  	<tbody>';
	  
  		while ($row2 = mysqli_fetch_array($result2)){
  			echo'<tr>
          <td>'.$no.'</td>
          <td>'.$row2['cid'].'</td>
          <td>'.$row2['cname'].'</td>
          <td>'.$row2['credits'].'</td>
          <td>'.($row2['grade']===null ? "-":$row2['grade']).'</td>
      </tr>';
      	$no++;
  		} 

  		$query3 = "SELECT sum(E.grade*C.credits)/sum(C.credits) as gpa FROM enroll E, course C WHERE E.cid = C.cid and E.sid = " .$user_check . " AND  E.yearr =  " .$row['yearr']. " AND E.sem = ".$row['sem'].";" ;
  		$result3 =  mysqli_query($db,$query3);
  		$row3 = mysqli_fetch_array($result3 );
		echo '<tr class = "gparow" style="background-color:#a6acad">
				<td> </td>
				<td> </td> 
				<td> </td>
				<td> GPA </td>
				<td>'. ($row3['gpa'] === null ? "-": round($row3['gpa'],2))   .'</td></tr></tbody><br>'; 
	}
	$query4 = 'SELECT sum(E.grade*C.credits)/sum(C.credits) as gpax FROM enroll E,course C WHERE E.cid = C.cid and E.sid = '.$user_check ." and E.grade is not null ;";//  
	$result4 = mysqli_query($db,$query4);
	$row4 = mysqli_fetch_array($result4);
	echo '<tr class="gpaxrow"> <td> </td> <td/><td/><td>GPAX</td>
			<td>'.($row4['gpax']===null? '-':round($row4['gpax'],2));
	
?>
</tbody>
    <tfoot>
      <tr/>
    </tfoot> 
  </table>
  </div>
  </body>  
</html>