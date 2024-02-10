<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$data = null;

$result = $proService->viewProduct($_GET['id']);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $proID = $row["proID"];
    $proName = $row["proName"];
    $proType = $row["proType"];
    $proImage = $row["proImage"];
    $proFile = $row["proFile"];
}

if (!empty($_POST['proName'])) {
    // อัพโหลดรูปภาพ
    $uploadedImages = uploadFilesPS($_FILES['proImage']);
    if($uploadedImages == null){
        $uploadedImages = $proImage;
    }

    // อัพโหลดเอกสาร
    $uploadedFiles = uploadFilesPS($_FILES['proFile']);
    if($uploadedFiles == null){
        $uploadedFiles = $proFile;

    }

    $data = new stdClass();

    $data->proID = $_GET['id'];
    $data->proName = $_POST['proName'];
    $data->proType = $_POST['proType'];
    $data->proImage = $uploadedImages;
    $data->proFile = $uploadedFiles;

    $create = $proService->editProduct($data);
    $data = null;

?>
    <div class="modal fade bs-example-modal-center show"  style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3"><?php echo $create; ?></h4>
                        <div class="hstack gap-2 justify-content-center mt-2">
                            <a href="home.php?page=editProduct&id=<?= $proID ?>" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
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
    <form method="post" action="home.php?page=editProduct&id=<?= $proID ?>" id="myForm" enctype="multipart/form-data">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">แก้ไขสินค้า</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-md-8">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-5 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">ชื่อสินค้า<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="proName" name="proName" value="<?= $proName ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">หน่วยสินค้า</label>
                                        <select class="form-control" aria-label="Default select example" id="proType" name="proType" required>
                                            <option value="<?= $proType ?>"><?= $proType ?></option>
                                            <?php
                                            $result = $proService->viewCategory();
                                            $num = $result->rowCount();
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                $catID = $row["catID"];
                                                echo '<option value="' . $row["catName"] . '" >' . $row["catName"] . "</option>";
                                                $i++;
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="row gap-4 mt-4">
                                        <!-- Buttons Input -->
                                        <div class="col-xxl-5 col-md-6">
                                            <label for="proImage" class="form-label fs-15 text-dark">อัพโหลดรูปสินค้า</label>
                                            <div class="input-group col-xxl-2 col-md-2">
                                                <input class="form-control" type="file" id="proImage" name="proImage">
                                            </div>
                                        </div>
                                        <div>
                                            <img class="image avatar-lg rounded" alt="" src="<?= $proImage ?>">
                                        </div>
                                        <div class="col-xxl-5 col-md-6">
                                            <label for="proFile" class="form-label fs-15 text-dark">เอกสารสินค้า </label>
                                            <div class="input-group col-xxl-2 col-md-2">
                                                <input class="form-control" type="file" id="proFile" name="proFile[]" multiple>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <?php
                                            $file = explode("|", $proFile);
                                            foreach ($file as $fileData) {
                                                echo '<h5 class="fs-13 mb-1"><a href="' . $fileData . '" class=" fs-16" target="_blank">#' . str_replace("../uploads/", "", $fileData) . '</a></h5>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-5">
                                        <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" class="btn btn-primary btn-label waves-effect waves-light right ms-auto nexttab nexttab fs-24" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-24 ms-2"></i>บันทึก</button>
                                        <button type="submit" id="submitBtn" style="display: none;">Submit</button>
                                    </div>

                                </div>

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
                                        <a href="#" class="btn btn-primary fs-18" onclick="simulateButtonClick(); return false;">ยืนยันการทำรายการ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    function simulateButtonClick() {
        document.getElementById('submitBtn').click();
    }
</script>