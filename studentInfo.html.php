<?php include "templates/header.php"; ?>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
 
  <head> 

    <title>Student Info</title>  
    <meta http-equiv="content-type"  
        content="text/html; charset=utf-8"/> 
    
    <link rel="stylesheet" href="backbutton.css">
    
    <link rel="stylesheet" href="sidebar.css">
  </head>  
  <body style="background-image:url(https://images.pexels.com/photos/242236/pexels-photo-242236.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260); background-repeat: no-repeat;" >  
   <!-- w3-include-html="sideb.html" -->
 


   <?php include "splitleft.html"; ?>



<div class="splitright" style="background-image:none;">
    <?php include 'backbuttonstudent.html'; ?>

     <h1>Payment Info</h1>  
    <?php foreach ($student as $item): ?>  
      <blockquote><h2 id="enrollment_fee_amount">  
        Pay amount : 
        <?php echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?>  
        ฿
      </h2></blockquote> 
    <?php  endforeach;?>

    <br> <br>
    <table class="data-table">
    <caption class="title" style="font-size:25px;">Payment History</caption>
    <thead>
      <tr>
        <th>NUMBER</th>
        <th>ACADEMIC YEAR</th>
        <th>SEMESTER</th>
        <th>TRANSACTION DATE</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $no   = 1;
    while ($row = mysqli_fetch_array($result2))
    {
      echo '<tr>
          <td>'.$no.'</td>
          <td>'.$row['yearr'].'</td>
          <td>'.$row['sem'].'</td>
          <td>'. date('F d, Y', strtotime($row['transaction_date'])) . '</td>
        </tr>';
      $no++;
    }?>
    </tbody>
    
    <tfoot>
      <tr/>
    </tfoot> 
  </table>
</div>

  </body>  
</html>


