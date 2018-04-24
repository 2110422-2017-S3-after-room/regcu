
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
 
  <head> 

    <title>Student Info</title>  
    <meta http-equiv="content-type"  
        content="text/html; charset=utf-8"/> 
    
    <link rel="stylesheet" href="backbutton.css">
    <link rel="stylesheet" href="tablee.css">
    <link rel="stylesheet" href="sidebar.css">
    <style>
    

    
  </style>
  </head>  
  <body >  
   <!-- w3-include-html="sideb.html" -->




<div class="splitleft" >
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Phra_Kiao.svg/1200px-Phra_Kiao.svg.png"  style="max-width:50%;
max-height:100%; padding-bottom:20px;" />
  <p id="regcu">REG CU</p>
  <div class = "asdf">
  
  <button class="accordion"> Personal Information </button>
  <div class = "panel">
    <button class="inacc" onclick="location.href='showInfo.php'">Payment Info </button>
    <button class="inacc" onclick="location.href='showTranscript.php'">Transcript </button>
    
  </div>
  <div class = "panel">
    <button class="inacc" onclick="location.href='logout.php'">Logout </button>
  </div>

  <button class="accordion"> Course </button>
  <div class = "panel">
    
    <button class="inacc" onclick="location.href='EnrollCourse.php'">Enroll </button>
    <button class="inacc" onclick="location.href='Withdraw.php'"> Withdraw </button>
    <button class="inacc" onclick="location.href='SearchCourses.php'"> Search Courses </button>
    <button class="inacc" onclick="location.href='showEnrolledCourse.php'"> Show Enrolled Course </button>


  </div>
  <button class="accordion"> Scholarships </button>
  <div class = "panel">
    <button class="inacc" onclick="location.href='ViewSch.php'"> View Scholarships </button>
    <button class="inacc" onclick="location.href='ApplySch.php'"> Check Scholarship Qualification </button>
  </div>
</div></div>



<div class="splitright">
 <button class="back" onclick="location.href='studenthome.php'">◄</button>

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

<script>
var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0 ; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
        });
    }
includeHTML();
</script>
  </body>  
</html>


