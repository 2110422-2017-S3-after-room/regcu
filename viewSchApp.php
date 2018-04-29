<?php 
	include "session.php";
	include "checkstudent.php";
?>
<?php
	$sql = "select * from apply_scholarship where sid = '".$user_check."'order by sch_year;";
	$result = mysqli_query($db,$sql);

?>
<?php require "templates\header.php";
		include "splitleft.html"
?>
<div class= "splitright">
<?php include "backbutton.html"; ?>
<h1> Scholarship Application Status </h1>
<?php 
	if(!$result){
		echo "cannot fetch";
	}else if(mysqli_num_rows($result) == 0){
		echo "<p> no application found. </p>";
	}else{ ?>
		<table class="data-table">
			<thead>
				<th> Scholarship name </th>
				<th> Year </th>
				<th> Status </th>
				<th> Application Date </th>
				<th> Receive Date </th>
			</thead>
			<tbody>
				<?php while($row = mysqli_fetch_array($result)){ ?>
					<tr>
						<td> <?= $row['sch_year'] ?> </td>
						<td> <?= $row['sch_name'] ?> </td>
						<td> <?= $row['app_status'] ?> </td>
						<td> <?= $row['apply_date'] ?> </td>
						<td> <?= $row['receive_date'] ?> </td>
					</tr>
		<?php 	}
				?>
			</tbody>
		</table>
<?php	} 
?>

</div>
<?php require "templates/footer.php"; ?>