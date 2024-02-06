<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$data = null;

if ($_GET["delete"] == 1) {
    $data = new stdClass();
    $data->proID  = $_GET['id'];
    $create = $proService->deleteProduct($data);
    ?>
    <div class="modal fade bs-example-modal-center show"  style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3"><?php echo $create; ?></h4>
                        <div class="hstack gap-2 justify-content-center mt-2">
                            <a href="home.php?page=viewProduct" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">รายการสินค้า</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="live-preview">
                            <table id="alternative-pagination" class="table  dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style=" width: 5%;">รายการ</th>
                                        <th style=" width: 10%;">รูปสินค้า</th>
                                        <th style=" width: 30%;">ชื่อสินค้า</th>
                                        <th style=" width: 10%;">หน่วย</th>
                                        <th>เอกสาร</th>
                                        <th style=" width: 10%;">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody> <?php
                                        $result = $proService->viewProduct();
                                        $num = $result->rowCount();
                                        if ($num > 0) {
                                            $i = 0;
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                $i ++;
                                                $proID = $row["proID"];
                                                $proName = $row["proName"];
                                                $proType = $row["proType"];
                                                $proImage = $row["proImage"];
                                                $proFile = $row["proFile"];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?=$i?></td>
                                                <td>
                                                    <div class="flex-shrink-0 me-3">
                                                        <div>
                                                            <img class="image avatar-lg rounded" alt="" src="<?= $proImage ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $proName ?></td>
                                                <td><?= $proType ?></td>
                                                <td class="col">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <?php
                                                            $file = explode(",", $proFile);
                                                            foreach ($file as $fileData) {
                                                                echo '<h5 class="fs-13 mb-1"><a href="'.$fileData.'" class=" fs-16" target="_blank">#'.str_replace("../uploads/","",$fileData).'</a></h5>';
                                                            }
                                                            ?>
                                                        </div>
                                                </td>
                                                <td>
                                                    <div class="mt-2">
                                                        <a type="button" href="home.php?page=editProduct&id=<?= $proID ?>" class="btn btn-primary btn-label waves-effect waves-light" >
                                                            <i class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i> แก้ไข</a>
                                                    </div>
                                                    <div class="mt-2">
                                                        <a type="button" href="javascript:void(0);" onclick="confirmDelete('<?php echo $proID; ?>')"  class="btn btn-danger btn-label waves-effect waves-light " type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                                                            <i class="ri-delete-bin-line label-icon align-middle fs-16 me-2"></i> ลบ</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                                $i++;
                                            }
                                        } else {
                                        ?>
                                        <tr>
                                            <th colspan="6">ไม่พบข้อมูล</th>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <div>
                                <h4 class="mb-4">คุณต้องการยืนยันการทำรายการหรือไม่?</h4>
                                <div class="hstack gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                    <a href="javascript:void(0);" class="btn btn-primary fs-18">ยืนยันการทำรายการ</a>
                                </div>
                            </div>
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
</div>
<!-- END layout-wrapper -->

<script>
    function confirmDelete(proID) {
        var confirmAction = confirm("คุณแน่ใจหรือไม่ว่าต้องการลบ?");
        if (confirmAction) {
            // ผู้ใช้ยืนยันการลบ, ดำเนินการต่อไปยัง URL ลบ
            window.location.href = "home.php?page=viewProduct&delete=1&id=" + proID;
        } else {
            // ผู้ใช้ยกเลิกการลบ
            // console.log("การลบถูกยกเลิก");
        }
    }
</script>