
<h2> Search Result </h2>
  <div style="padding-left: 30px;">

    <table class="data-table" style="display:inline-block; overflow:auto; max-height: 350px; min-width:600px; width:650px; margin-left:20px; ">
    
    <thead >
      
      <tr>
        <th> # </th>
        <th>COURSE ID</th>
        <th>SECTION <br> NUMBER</th>
        <th>COURSE NAME</th>
        <th>CREDITS</th>
        <th>TEACHER NAME</th>
       
      </tr>
    </thead>
    <tbody  >
    <?php
      $no   = 1;
      $total  = 0;
    while ($row = mysqli_fetch_array($result))
    {
      echo '<tr align="center">
          <td>' .$no.'</td>
          <td>' .$row['cid'].     '</td>
          <td>' .$row['sec_id'].  '</td>
          <td style="text-align:left;">' .$row['cname'].   '</td>
          <td>' .$row['credits']. '</td>
          <td>' .$row['tname'].   '</td> 
        </tr>';
      $no++;
    }?>
    </tbody>
    <tfoot>
      <tr/>
    </tfoot> 
  </table>
</div>

</div>
</body>
</html>
