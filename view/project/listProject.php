<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);

$data = null;


?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">จัดการโครงการ</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"></a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="alternative-pagination" class="table  dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>เลขที่โครงการ</th>
                                        <th>ชื่อโครงการ</th>
                                        <th>ประเภท</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>อีเมลติดต่อกลับ</th>
                                        <th>ที่อยู่โครงการ</th>
                                        <th>รับประกันการติดตั้ง</th>
                                        <th>สถานะขออนุญาติ</th>
                                        <th>สถานะการติดตั้ง</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $prjService->viewProject();
                                    $num = $result->rowCount();
                                    if ($num > 0) {
                                        $i = 0;
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            $i++;
                                            $pojID = $row["pojID"];
                                            $pojName = $row["pojName"];
                                            $pojCODE = $row["pojCODE"] == '' ? '-' : $row["pojCODE"];
                                            $pojStartWarranty = $row["pojStartWarranty"];
                                            $pojEndWarranty = $row["pojEndWarranty"];
                                            $pojFullAddr = $row['pojAddr']." ". $row['pojTumbol']." ". $row['pojAumper']." ". $row['pojProvince']." ". $row['pojPost'];

                                            $pojStatus = getStatusButton($row["pojStatus"]);
                                            $pojDocStatus = getStatusButton($row["pojDocStatus"]);

                                            if (!empty($row['pojWp'])) {
                                                $pojType = "โซล่าร์";
                                            } else {
                                                $pojType = "อีวีชาร์จ";
                                            }

                                            $result_c = $cusService->viewCustomer($row['pojCus']);
                                            while ($row_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
                                                $cusName = $row_c['cusName'];
                                                $cusTell = $row_c['cusTell'];
                                                $cusMail = $row_c['cusMail'];
                                                $cusAddr = $row_c['cusAddr'] . " " . $row_c['cusTumbol'] . " " . $row_c['cusAumper'] . " " . $row_c['cusProvince'] . " " . $row_c['cusPost'];
                                            }
                                            $result_c = null;

                                    ?>

                                            <tr>
                                                <td><?= $pojCODE ?></td>
                                                <td><?= $pojName ?></td>
                                                <td><?= $pojType ?></td>
                                                <td><?= $cusName ?></td>
                                                <td><?= $cusTell ?></td>
                                                <td><?= $cusMail ?></td>
                                                <td><?= $pojFullAddr ?></td>
                                                <td>เริ่ม : <?= $pojStartWarranty ?><br>ถึง : <?= $pojEndWarranty ?></td>
                                                <td>
                                                    <?= $pojStatus ?>
                                                </td>
                                                <td>
                                                    <?= $pojDocStatus ?>
                                                </td>
                                                <td>
                                                    <!-- Buttons with Label -->
                                                    <a type="button" href="index.php?page=editSolar&id=<?= $pojID ?>" class="btn btn-primary btn-label waves-effect waves-light"><i class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i> แก้ไข</a>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                        $result = null;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Develop By LJ ALL MEDIA CO.,LTD.
                </div>

            </div>
        </div>
    </footer>
</div>