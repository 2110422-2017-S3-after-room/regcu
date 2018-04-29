<?php
if(isset($_POST['sub5'])){
	$sch_name = $_POST['sub5'];

	$query1 = 'SELECT * from external_sch
				where sch_name= "'.$sch_name.'" and 
				sch_year = '.$thisyear ;
	$sch = mysqli_fetch_array(mysqli_query($db,$query1)); ?>
	<p><pre style="white-space: pre-wrap;">

		These are requirements specified by the scholarship owner :

		" 
		<?= $sch['sch_cond'] ?>
		
		" 
		Apply Below

	</pre></p>	
	
	<form method="post" action="">
	<input type = 'hidden' name="schname" value= <?php echo $sch_name ?>>
    <input type="submit" name="applynao" value="applynao" /><br/>
	</form>
<?php
}
?>