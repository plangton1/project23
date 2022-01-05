<?php
require('../connection/connection.php');
if(($_POST['query']) != '')
{
 $search_text = implode(",",$_POST['query']);
 $query = "SELECT *  FROM dimension_department  WHERE id_dimension_department IN ($search_text) ";
}
else
{
 $query = "SELECT *  FROM dimension_department ";
}

$statement = sqlsrv_query($conn,$query);
$total_row = sqlsrv_num_rows($statement);
$output = '';
$i=1;
// var_dump($_POST['query']);

   while($row = sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC)){
  $output .= '
  <table class="table table-bordered">
  <tr>
   <td>'.$i++.'</td>
   <td>'.$row["id_dimension_department"].'</td>
   <td>'.$row["standard_idtb"].'</td>
   <td>'.$row["department_id"].'</td>
  </tr>
  </table>
  ';
   }
   
echo $output;
exit();
?>