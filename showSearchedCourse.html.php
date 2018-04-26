

  
    <table class="data-table">
    <caption class="title">  <h1>Search Result</h1>  </caption>
    <thead style="display:inline-block;">
      
      <tr>
        <th> # </th>
        <th>COURSE ID</th>
        <th>SECTION <br> NUMBER</th>
        <th>COURSE NAME</th>
        <th>CREDITS</th>
        <th>TEACHER NAME</th>
      </tr>
    </thead>
    <tbody style="display:block; overflow:auto;max-height: 250px; ">
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


