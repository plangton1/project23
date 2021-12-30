<center>
     <?php include('fontthai.php');?>
<?php  
 require('../connection/connection.php');
 $query = "SELECT * FROM main_std ORDER BY standard_idtb desc";  
 $result = sqlsrv_query($conn, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>   
      <?php include('../include/head.php'); ?>
      <body>  
           <br /><br />  
        
           <div class="container" style="width:900px;">  
                <h2 align="center">รายงานเอกสารตามช่วงเวลา</h2>   
                <div class="col-md-3">  
                <input type="text" name="standard_create" id="standard_create" class="form-control" placeholder="จากวันที่" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="standard_day" id="standard_day" class="form-control" placeholder="ถึงวันที่" />  
                </div>  
                <div class="col-md-5">     
                     <input type="button" name="filter" id="filter" value="ค้นหาเอกสาร" class="btn btn-info" />  
                </div>  
                <div style="clear:both"></div>                 
                <br />  
                <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr>      
                               <th width="5%">ลำดับ</th>   
                               <th width="5%">หมายเลขเอกสาร</th>  
                               <th width="30%">วันที่เปลี่ยนแปลงสถานะ</th>  
                               <th width="10%">หมายเหตุ</th>  
                               <th width="10%">หมายเลข tacking</th>  
                               <th width="30%">วันที่เพิ่มเอกสาร</th>  
                          </tr>  
                     <?php  
                     $i = 1;
                     while($row  = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))   
                     {  
                     ?>  
                          <tr>  
                              <td><?php echo $i++ ; ?></td>  
                               <td><?php echo $row["standard_idtb"]; ?></td>  
                               <td><?php echo $row["standard_day"]; ?></td>  
                               <td><?php echo $row["standard_note"]; ?></td>  
                               <td><?php echo $row["standard_tacking"]; ?></td>  
                               <td><?php echo $row["standard_create"]; ?></td>  
                          </tr>  
                     <?php  
                     }  
                     ?>  
                     </table>  
              
<a href="MyReport.pdf">โหลดรายงาน</a>
<a style="" onclick="window.history.go(-1); return false;">ย้อนกลับ</a>
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'dd-mm-yy'   
           });  
           $(function(){  
                $("#standard_create").datepicker();  
                $("#standard_day").datepicker();  
           });  
           $('#filter').click(function(){  
                var standard_create = $('#standard_create').val();  
                var standard_day = $('#standard_day').val();  
                if(standard_create != '' && standard_day != '')  
                {  
                     $.ajax({  
                          url:"./report_filter.php",  
                          method:"POST",  
                          data:{standard_create:standard_create, standard_day:standard_day},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("โปรดกรอกวันที่เริ่มการค้นหาก่อน");  
                }  
           });  
      });  
 </script>
 </center>