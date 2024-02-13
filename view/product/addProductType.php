<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$data = null;

if (!empty($_POST['catName'])) {
    $data = new stdClass();
    $data->catName  = $_POST['catName'];
    $create = $proService->createCategory($data);

?>
    <div class="modal fade bs-example-modal-center show"  style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3"><?php echo $create; ?></h4>
                        <div class="hstack gap-2 justify-content-center mt-2">
                            <a href="" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
if ($_GET["delete"] == 1) {
    $data = new stdClass();
    $data->catID  = $_GET['id'];
    $create = $proService->deleteCategory($data);
    ?>
    <div class="modal fade bs-example-modal-center show"  style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3"><?php echo $create; ?></h4>
                        <div class="hstack gap-2 justify-content-center mt-2">
                            <a href="index.php?page=addProductType" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
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
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">เพิ่มหน่วยสินค้า</h4>

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
                <div class="card col-md-8">
                    <form method="post" action="index.php?page=addProductType" id="myForm">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-5 col-md-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="ระบุหน่วยสินค้า" id="catName" name="catName">
                                            <button class="btn btn-outline-success fs-18" type="submit" id="button-addon2">บันทึก</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body mt-3" style="padding: 15px;background-color: #f9f9f9;">
                        <div class="row gy-2">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-nowrap mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col" style=" width: 5%;">รายการ</th>
                                                <th scope="col">หน่วยสินค้า</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = $proService->viewCategory();
                                            $num = $result->rowCount();
                                            if ($num > 0) {
                                                $i = 1;
                                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                    $catID = $row["catID"];
                                            ?>
                                                    <tr>
                                                        <th><?php echo $i; ?></th>
                                                        <td><?php echo $row["catName"]; ?></td>
                                                        <td>
                                                            <a type="button" href="javascript:void(0);" onclick="confirmDelete('<?php echo $catID; ?>')" class="btn btn-danger btn-label waves-effect waves-light"><i class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i> ลบ</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <th colspan="3">ไม่พบข้อมูล</th>
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
                </div>
            </div>
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

<script>
    function confirmDelete(cusId) {
        var confirmAction = confirm("คุณแน่ใจหรือไม่ว่าต้องการลบ?");
        if (confirmAction) {
            // ผู้ใช้ยืนยันการลบ, ดำเนินการต่อไปยัง URL ลบ
            window.location.href = "index.php?page=addProductType&delete=1&id=" + cusId;
        } else {
            // ผู้ใช้ยกเลิกการลบ
            // console.log("การลบถูกยกเลิก");
        }
    }
</script>