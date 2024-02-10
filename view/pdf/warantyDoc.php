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

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">พิมพ์ใบรับประกัน</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"></a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-lg-12">




                    <div class="card">
                        <div class="card-body">
                            <table id="alternative-pagination"
                                class="table  dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>เลขที่โครงการ</th>
                                        <th>ชื่อโครงการ</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>อีเมลติดต่อกลับ</th>
                                        <th>ที่อยู่</th>
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
                                            $pojCODE = $row["pojCODE"];
                                            $pojStartWarranty = $row["pojStartWarranty"];
                                            $pojEndWarranty = $row["pojEndWarranty"];

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
                                        <td><?= $cusName ?></td>
                                        <td><?= $cusTell ?></td>
                                        <td><?= $cusMail ?></td>
                                        <td><?= $cusAddr ?></td>
                                        <td>
                                            <a type="button"
                                                href="file:///D:/%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%94%E0%B8%B9%E0%B9%81%E0%B8%A5%E0%B9%80%E0%B8%9E%E0%B8%88-%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A/%E0%B8%88%E0%B8%B9%E0%B8%99/%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%88%E0%B8%B9%E0%B8%99%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%82%E0%B8%B2%E0%B8%A2/%E0%B9%80%E0%B8%AD%E0%B8%81%E0%B8%AA%E0%B8%B2%E0%B8%A3%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%81%E0%B8%B1%E0%B8%99/Book35.pdf"
                                                class="btn btn-primary btn-label waves-effect waves-light"><i
                                                    class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i>
                                                ดาวน์โหลด</a>
                                        </td>
                                    </tr>
                                    <?php
                                            $i++;
                                        }
                                        $result = null;
                                    }?>

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
<!-- end main content-->