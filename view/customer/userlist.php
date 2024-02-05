<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();
$cusService = new CuntomerService($conn);
?>
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

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
                        <h4 class="mb-sm-0">รายการลูกค้า</h4>

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
                                        <th>ชื่อลูกค้า</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>อีเมลติดต่อกลับ</th>
                                        <th>ที่อยู่</th>
                                        <th>จัดการ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $cusService->viewCustomer();
                                    $num = $result->rowCount();
                                    if ($num > 0) {
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row["cusName"];?></td>
                                                <td><?php echo $row["cusTell"];?></td>
                                                <td><?php echo $row["cusMail"];?></td>
                                                <td><?php echo $row["cusAddr"]." ".$row["cusTumbol"]." ".$row["cusAumper"]." ".$row["cusProvince"]." ".$row["cusPost"];?></td>
                                                <td>
                                                    <a type="button" href="home.php?page=useredit&id=<?php echo $row["cusId"];?>" class="btn btn-primary btn-label waves-effect waves-light"><i class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i> แก้ไข</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5">ไม่พบข้อมูล</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->


        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

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

</div>
<!-- END layout-wrapper -->