<!-- $query = "  
           SELECT * FROM main_std  
           WHERE standard_day BETWEEN '".$_POST["standard_create"]."' AND '".$_POST["standard_day"]."'  
      ";   -->
<?php  
 //filter.php  
//  if(isset($_POST["standard_create"], $_POST["standard_day"]))  
//  {  
      include('../connection/connection.php');
      $output = '';  
     //  $query = "SELECT * FROM  main_std WHERE standard_create  = '12/28/2021' AND standard_day = '12/31/2021'";
      $query = "SELECT * FROM  main_std WHERE standard_create  = '".$_POST["standard_create"]."' AND standard_day = '".$_POST["standard_day"]."'";
      print_r($query);
      $stmt = sqlsrv_query($conn, $query);  
     // $result = sqlsrv_num_rows($stmt);
     print_r($stmt);
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
     //  if($result > 0)  
     //  {  
           while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))  
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
     //  }  
     //  else  
     //  {  
     //       $output .= '  
     //            <tr>  
     //                 <td colspan="5">ไม่มีเอกสารตามระยะเวลาที่ระบุ</td>  
     //            </tr>  
     //       ';  
     //  }  
      $output .= '</table>';  
      echo $output;  
//  }  
 ?>