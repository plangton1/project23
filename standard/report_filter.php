<?php  
 //filter.php  
 if(isset($_POST["standard_create"], $_POST["standard_day"]))  
 {  
      require('../connection/connection.php');
      $output = '';  
      $query = "  
           SELECT * FROM main_std  
           WHERE standard_day BETWEEN '".$_POST["standard_create"]."' AND '".$_POST["standard_day"]."'  
      ";  
      $result = sqlsrv_query($conn, $query);  
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">ลำดับ</th> 
                     <th width="5%">หมายเลขเอกสาร</th>  
                     <th width="30%">วันที่เปลี่ยนแปลงสถานะ</th>  
                     <th width="10%">หมายเหตุ</th>  
                     <th width="10%">หมายเลข tacking</th>  
                     <th width="30%">วันที่เพิ่มเอกสาร</th>  
                </tr>  
      ';  
      if(sqlsrv_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                     <td>'. $row["standard_idtb"].'</td>  
                     <td>'. $row["standard_day"].'</td>  
                     <td>'.$row["standard_note"].'</td>  
                     <td>'.$row["standard_tacking"].'</td>  
                     <td>'.$row["standard_create"].'</td> 
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">ไม่มีเอกสารตามระยะเวลาที่ระบุ</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>