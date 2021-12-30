<?php
if (isset($_GET['standard_idtb']) && !empty($_GET['standard_idtb'])) {
    $standard_idtb = $_GET['standard_idtb'];
$sql = "SELECT *  , a.standard_idtb,a.standard_status,b.statuss_name AS name_status 
 FROM  main_std a INNER JOIN select_status b ON a.standard_status = b.id_statuss WHERE standard_idtb = " . $_REQUEST["standard_idtb"];
$query = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($query);
    }
    if (isset($_POST) && !empty($_POST)) {

        $standard_number = $_POST['standard_number'];
        $standard_meet = $_POST['standard_meet'];
        $standard_detail = $_POST['standard_detail'];
        $standard_mandatory = $_POST['standard_mandatory'];
        $standard_tacking = $_POST['standard_tacking'];
        $standard_note = $_POST['standard_note'];
        $standard_status = $_POST['standard_status'];
        $standard_day = $_POST['standard_day'];

        $sql = "UPDATE main_std 
        SET standard_number= '$standard_number' ,
            standard_meet = '$standard_meet' , 
            standard_detail = '$standard_detail' ,
            standard_mandatory = '$standard_mandatory' ,
            standard_tacking = '$standard_tacking' ,
            standard_status ='$standard_status' ,
            standard_day = '$standard_day'
         WHERE standard_idtb = '$standard_idtb' ";
        if (sqlsrv_query($conn, $sql)) {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("แก้ไขสถานะสำเร็จ !!");';
            $alert .= 'window.location.href = "?page=status";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . sqlsrv_errors($conn);
        }
        sqlsrv_close($conn);
    }
?>