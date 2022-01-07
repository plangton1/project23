<?php
$page = (isset($_GET['page'])) ? $_GET['page'] : '';

if (isset($_GET['standard_idtb']) && !empty($_GET['standard_idtb'])) {
    $standard_idtb = $_GET['standard_idtb'];
    $sql = "SELECT * , a.standard_idtb,a.standard_status,b.statuss_name AS name_status 
     FROM main_std a INNER JOIN select_status b ON a.standard_status = b.id_statuss WHERE standard_idtb = '$standard_idtb' ";
    $query = sqlsrv_query($conn, $sql);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
}


$sql2 = "SELECT * FROM select_status";
$query2 = sqlsrv_query($conn, $sql2);
$sql3 = "SELECT * FROM type_tb";
$query3 = sqlsrv_query($conn, $sql3);

?>
<h1 class="app-page-title text-end">รายงานเอกสาร / Report</h1>
<a href="#" onclick="window.print()" class="btn btn-sm btn-warning text-white non-printable" style="font-size:20px;">พิมพ์รายงาน</a>
<div class="container">

    <h5>สถาบันวิจัยวิทยาศาสตร์และเทคโนโลยีแห่งประเทศไทย 35 เทคโนธานี <h5>
        <h5>ถนนเลียบคลองห้า ตำบลคลองห้า อำเภอคลองหลวง จังหวัดปทุมธานี 12120</h5>
    <hr>
    <p class="justify-content-right" style="font-size: 18px;">
        <?php
        date_default_timezone_set('asia/bangkok');
        $date = date('วันที่ d เดือน m พ.ศ. Y');
        $date2 = date('เวลา h:i:s');
        echo '<p align=end>';
        echo $date;
        echo '</p>';
        echo '<p align=end>';
        echo $date2;
        echo '</p>';
        ?>
         <?php
        if (isset($_GET['standard_idtb']) && !empty($_GET['standard_idtb'])) {
            $standard_idtb = $_GET['standard_idtb'];
            $sql2 = "SELECT * FROM main_std WHERE standard_idtb=$standard_idtb";
            $query2 = sqlsrv_query($conn, $sql2);
            $row = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC);
            echo "<tr>";
            echo "<td width='85' valign='top'><b>หมายเลขเอกสาร : </b></td>";
            echo "<td width='279'>" . $row["standard_idtb"] . "</td>";
            echo "<hr width='200'>";
            echo "</tr>";
            echo "<tr>";
            echo "<td width='85' valign='top'><b>ชื่อเอกสาร :</b></td>";
            echo "<td width='279'>" . $row["standard_detail"] . "</td>";
            echo "<br style='line-height: 18pt'>";
            echo "</tr>";
            echo "<tr>";
            echo "<td valign='top'><b>วันที่เพิ่ม :</b></td>";
            echo "<td>" . $row["standard_create"] . "</td>";
            echo "</tr>";
     echo "<br>";

    //         echo "<tr>";
    //         echo "<td valign='top'><b>อีเมล์ :</b></td>";
    //         echo "<td>" . $row["s_email"] . "</td>";
    //         echo "</tr>";
    //  echo "<br>";

    //         echo "<tr>";
    //         echo "<td valign='top'><b>เบอร์ติดต่อ :</b></td>";
    //         echo "<td>" . $row["s_phone"] . "</td>";
    //         echo "</tr>";
     echo "<br>";
     echo "<hr>";
        }
        ?>
<table class="table  table-responsive-xl table-striped text-center pt-5"
                    style="background-color: white;" id="tableall">
                    <thead>
                        <tr>
                          
                            <th class="col-2">วันที่เพิ่มเอกสาร</th>
                            <th class="col-2">วาระจากในที่ประชุมสมอ.</th>
                            <th class="col-1">เลขที่มอก.</th>
                            <th class="col-1">ชื่อมาตรฐาน</th>
                            <th class="col-2">วันที่แต่งตั้งสถานะ</th>
                            <!-- <th class="col-1">เลขที่เอกสาร</th> -->
                            <th class="col-2">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                            <td class="align-middle"><?= date($result['standard_create']) ?></td>
                            <td class="align-middle"><?= $result['standard_number'] ?></td>
                            <td class="align-middle"><?= $result['standard_mandatory'] ?></td>
                            <td class="align-middle"><?= $result['standard_detail'] ?></td>
                            <?php if($result['standard_day'] == '') : ?>
                            <td class="align-middle" >ยังไม่ได้ระบุสถานะ</td>
                            <?php endif ; ?>
                            <?php if($result['standard_day']) : ?>
                            <td class="align-middle" ><?= dateThai($result['standard_day']) ;?></td>
                            <?php endif ; ?>
                            <?php if($result['id_statuss'] == 1 ) : ?>
                            <td class="align-middle " style="background-color: #daf7a6"><?= $result['name_status'] ?></td>
                            <?php endif ; ?>
                            <?php if($result['id_statuss'] == 2 ) : ?>
                            <td class="align-middle  text-lighred" style="background-color: #5F9EA0">
                                <?= $result['name_status'] ?></td>
                            <?php endif ; ?>
                            <?php if($result['id_statuss'] == 3 ) : ?>
                            <td class="align-middle bg-danger text-white"><?= $result['name_status'] ?></td>
                            <?php endif ; ?>
                            <?php if($result['id_statuss'] == 4 ) : ?>
                            <td class="align-middle text-white" style="background-color : #FF7F50 ;">
                                <?= $result['name_status'] ?></td>
                            <?php endif ; ?>
                            <?php if($result['id_statuss'] == ''  ) : ?>
                            <td class="align-middle text-white" style="background-color : #FF7F50 ;">
                                <?= $result['name_status'] ?></td>
                            <?php endif ; ?>
                      
                        </tr>
                

                    </tbody>
                </table>    

                