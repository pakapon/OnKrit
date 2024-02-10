<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$page = $_GET['page'];
if ($page == 'addEV') {
    $header = "เพิ่มโครงการอีวีชาร์จเจอร์";
} else {
    $header = "เพิ่มโครงการโซล่าร์เซลล์";
}

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);
$data = null;
if ($_GET["id"]) {

    $result = $prjService->viewProject($_GET["id"]);
    $num = $result->rowCount();
    if ($num > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $pojID = $row["pojID"];
            $pojCus = $row["pojCus"];
            $pojStatus = $row["pojStatus"];
            $pojDocStatus = $row["pojDocStatus"];
            $pojImage = $row["pojImage"];
            $pojFile = $row["pojFile"];
            $pojPDF = $row["pojPDF"];
            $pojName = $row["pojName"];
            $pojTypea = $row["pojType"];
            $pojCODE = $row["pojCODE"];
            $pojVoidID = $row["pojVoidID"];
            $pojContractID = $row["pojContractID"];
            $pojPost = $row["pojPost"];
            $pojTumbol = $row["pojTumbol"];
            $pojAumper = $row["pojAumper"];
            $pojProvince = $row["pojProvince"];
            $pojAddr = $row["pojAddr"];
            $pojGlo = $row["pojGlo"];
            $pojWarranty = $row["pojWarranty"];
            $pojStartWarranty = $row["pojStartWarranty"];
            $pojEndWarranty = $row["pojEndWarranty"];
            $pojPhase = $row["pojPhase"];
            $pojSystem = $row["pojSystem"];
            $pojWp = $row["pojWp"];
            $pojPhaseQty = $row["pojPhaseQty"];
            $pojTotalWatt = $row["pojTotalWatt"];
            $pojRemark = $row["pojRemark"];
            $pojProductWaranty = $row["pojProductWaranty"];
            $pojProductStartWaranty = $row["pojProductStartWaranty"];
            $pojProductEndWaranty = $row["pojProductEndWaranty"];
            $pojProduct = $row["pojProduct"];
            $pojProductQty = $row["pojProductQty"];
            $pojListProduct = $row["pojListProduct"];
            $pojListLot = $row["pojListLot"];
            $pojListSerial = $row["pojListSerial"];
            $pojListStartWarranty = $row["pojListStartWarranty"];
            $pojListEndWarranty = $row["pojListEndWarranty"];
            $pojServiceDate = $row["pojServiceDate"];
            $pojServiceTopic = $row["pojServiceTopic"];
            $pojServicePrices = $row["pojServicePrices"];
            $pojServiceStatus = $row["pojServiceStatus"];

            if (!empty($row['pojWp'])) {
                $pojType = "โซล่าร์";
                $header = "เพิ่มโครงการโซล่าร์เซลล์";
                $page = "";
            } else {
                $pojType = "อีวีชาร์จ";
                $header = "เพิ่มโครงการอีวีชาร์จเจอร์";
                $page = "addEV";
            }

            $result_c = $cusService->viewCustomer($row['pojCus']);
            while ($row_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
                $cusName = $row_c['cusName'];
                $cusTell = $row_c['cusTell'];
                $cusMail = $row_c['cusMail'];
                $cusAddr = $row_c['cusAddr'];
                $row_c['cusTumbol'] . " " . $row_c['cusAumper'] . " " . $row_c['cusProvince'] . " " . $row_c['cusPost'];
            }
            $result_c = null;
        }
    }
}

if (!empty($_POST['pojName'])) {
    // อัพโหลดรูปภาพ
    $uploadedImages = uploadFilesPS($_FILES['ssss']);
    // อัพโหลดเอกสาร
    $uploadedFiles = uploadFilesPS($_FILES['sssss']);

    $data = new stdClass();

    $ic1 = uploadFilesPS($_FILES["pojImage"]);
    if ($ic1 == null) {
        $i1 = $pojImage;
    } else {
        $i1 = $ic1;
    }
    $ic2 = uploadFilesPS($_FILES["pojFile"]);
    if ($ic2 == null) {
        $i2 = $pojFile;
    } else {
        $i2 = $ic2;
    }
    $ic3 = uploadFilesPS($_FILES["pojPDF"]);
    if ($ic3 == null) {
        $i3 = $pojPDF;
    } else {
        $i3 = $ic3;
    }

    $data->pojID = $_GET["id"];
    $data->pojCus = $_POST["pojCus"];
    $data->pojStatus = $_POST["pojStatus"];
    $data->pojDocStatus = $_POST["pojDocStatus"];
    $data->pojImage = $i1;
    $data->pojFile = $i2;
    $data->pojPDF = $i3;
    $data->pojName = $_POST["pojName"];
    $data->pojType = $_POST["pojType"];
    $data->pojCODE = $_POST["pojCODE"];
    $data->pojVoidID = $_POST["pojVoidID"];
    $data->pojContractID = $_POST["pojContractID"];
    $data->pojPost = $_POST["pojPost"];
    $data->pojTumbol = $_POST["pojTumbol"];
    $data->pojAumper = $_POST["pojAumper"];
    $data->pojProvince = $_POST["pojProvince"];
    $data->pojAddr = $_POST["pojAddr"];
    $data->pojGlo = $_POST["pojGlo"];
    $data->pojWarranty = $_POST["pojWarranty"];
    $data->pojStartWarranty = convertDateToDBFormat($_POST["pojStartWarranty"]);
    $data->pojEndWarranty = convertDateToDBFormat($_POST["pojEndWarranty"]);
    $data->pojPhase = $_POST["pojPhase"];
    $data->pojSystem = $_POST["pojSystem"];
    $data->pojWp = $_POST["pojWp"];
    $data->pojPhaseQty = $_POST["pojPhaseQty"];
    $data->pojTotalWatt = $_POST["pojTotalWatt"];
    $data->pojRemark = $_POST["pojRemark"];
    $data->pojProductWaranty = $_POST["pojProductWaranty"];
    $data->pojProductStartWaranty = convertDateToDBFormat($_POST["pojProductStartWaranty"]);
    $data->pojProductEndWaranty = convertDateToDBFormat($_POST["pojProductEndWaranty"]);
    $data->pojProduct = $_POST["pojProduct"];
    $data->pojProductQty = $_POST["pojProductQty"];
    $data->pojListProduct = grouptext($_POST["pojListProduct"]);
    $data->pojListLot = grouptext($_POST["pojListLot"]);
    $data->pojListSerial = grouptext($_POST["pojListSerial"]);
    $data->pojListStartWarranty = grouptext($_POST["pojListStartWarranty"]);
    $data->pojListEndWarranty = grouptext($_POST["pojListEndWarranty"]);
    $data->pojServiceDate = grouptext($_POST["pojServiceDate"]);
    $data->pojServiceTopic = grouptext($_POST["pojServiceTopic"]);
    $data->pojServicePrices = grouptext($_POST["pojServicePrices"]);
    $data->pojServiceStatus = grouptext($_POST["pojServiceStatus"]);

    $create = $prjService->editProject($data);
    $data = null;
?>
    <div class="modal fade bs-example-modal-center show" style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
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

?>

<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<form method="post" action="home.php?page=editSolar&id=<?= $pojID ?>" id="myForm" enctype="multipart/form-data">
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"><?= $header ?></h4>
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
                                <div class="row gy-4">
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">ผู้ดูแลโครงการ</h5>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ลูกค้า<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojCus" name="pojCus">
                                            <option value="<?= $pojCus ?>"><?= $cusName ?></option>
                                            <?php
                                            $result = $cusService->viewCustomer();
                                            $num = $result->rowCount();
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $row["cusId"]; ?>">
                                                    <?php echo $row["cusName"]; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะโครงการ<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojStatus" name="pojStatus" required>
                                            <option value="<?= $pojStatus ?>"><?= $pojStatus ?></option>
                                            <option value="ดำเนินการ">ดำเนินการ</option>
                                            <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                            <option value="ยกเลิก">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะงานขออนุญาต<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojDocStatus" name="pojDocStatus" required>
                                            <option <?= $pojDocStatus ?>><?= $pojDocStatus ?></option>
                                            <option value="ดำเนินการ">ดำเนินการ</option>
                                            <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                            <option value="ยกเลิก">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">รูปถ่ายและเอกสารโครงการ</h5>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">รูปในโครงการ
                                            <span class="text-danger">*(.jpg ไม่เกิน 30 รูป)</span></label>
                                        <input class="form-control" type="file" id="pojImage" name="pojImage[]" multiple>
                                        <?php
                                        $file = explode("|", $pojImage);
                                        foreach ($file as $fileData) {
                                            echo '<h5 class="fs-13 mb-1"><a href="' . trim($fileData) . '" class=" fs-16" target="_blank">#' . str_replace("../uploads/", "", trim($fileData)) . '</a></h5>';
                                        }
                                        $file = null;
                                        $fileData = null;
                                        ?>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารการขออนุญาต <span class="text-danger">*(.pdf ไม่เกิน 5ไฟล์)</span></label>
                                        <input class="form-control" type="file" id="pojFile" name="pojFile[]" multiple>
                                        <?php
                                        $file = explode("|", $pojFile);
                                        foreach ($file as $fileData) {
                                            echo '<h5 class="fs-13 mb-1"><a href="' . trim($fileData) . '" class=" fs-16" target="_blank">#' . str_replace("../uploads/", "", trim($fileData)) . '</a></h5>';
                                        }
                                        $file = null;
                                        $fileData = null;
                                        ?>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารแนบโครงการ
                                            <span class="text-danger">*(.pdf ไม่เกิน 5ไฟล์)</span></label>
                                        <input class="form-control" type="file" id="pojPDF" name="pojPDF[]" multiple>
                                        <?php
                                        $file = explode("|", $pojPDF);
                                        foreach ($file as $fileData) {
                                            echo '<h5 class="fs-13 mb-1"><a href="' . trim($fileData) . '" class=" fs-16" target="_blank">#' . str_replace("../uploads/", "", trim($fileData)) . '</a></h5>';
                                        }
                                        $file = null;
                                        $fileData = null;
                                        ?>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">รายละเอียดโครงการ</h5>
                                    </div>
                                    <div class="col-xxl-7 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">ชื่อโครงการ<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pojName" name="pojName" value="<?= $pojName ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-5 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ประเภทโครงการ<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojType" name="pojType" required>
                                            <option value="<?= $pojTypea ?>"><?= $pojTypea ?></option>
                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขที่โครงการ</label>
                                            <input type="text" class="form-control" id="pojCODE" name="pojCODE" value="<?= $pojCODE ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขที่ใบแจ้งหนี้</label>
                                            <input type="text" class="form-control" id="pojVoidID" name="pojVoidID" value="<?= $pojVoidID ?>">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขที่สัญญา</label>
                                            <input type="text" class="form-control" id="pojContractID" name="pojContractID" value="<?= $pojContractID ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">ที่อยู่โครงการ</h5>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pojPost" name="pojPost" value="<?= $pojPost ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ตำบล/แขวง<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojTumbol" name="pojTumbol" required>
                                            <option value="<?= $pojTumbol ?>"><?= $pojTumbol ?></option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">อำเภอ/เขต<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojAumper" name="pojAumper" required>
                                            <option value="<?= $pojAumper ?>"><?= $pojAumper ?></option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">จังหวัด <span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojProvince" name="pojProvince" required>
                                            <option value="<?= $pojProvince ?>"><?= $pojProvince ?></option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">บ้านเลขที่/หมู่บ้าน/อาคาร<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pojAddr" name="pojAddr" value="<?= $pojAddr ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">พิกัด Google
                                                Maps</label>
                                            <input type="text" class="form-control" id="pojGlo" name="pojGlo" value="<?= $pojGlo ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">รายละเอียดการติดตั้ง</h5>
                                    </div>
                                    <div class="card-body" style="padding: 15px;background-color: #f9f9f9;">

                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active show" id="developers" role="tabpanel">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">รับประกันงานติดตั้ง(ปี)</label>
                                                        <input type="number" class="form-control" id="pojWarranty" name="pojWarranty" value="<?= $pojWarranty ?>">
                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">เริ่มรับประกันงานติดตั้ง</label>
                                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojStartWarranty" name="pojStartWarranty" value="<?= $pojStartWarranty ?>">

                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">สิ้นสุดประกันงานติดตั้ง</label>
                                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojEndWarranty" name="pojEndWarranty" value="<?= $pojEndWarranty ?>">
                                                    </div>

                                                    <div class="row gy-2">
                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="labelInput" class="form-label fs-15 text-dark">Phase</label>
                                                            <input type="text" class="form-control" id="pojPhase" name="pojPhase" value="<?= $pojPhase ?>">
                                                        </div>
                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="exampleDataList" class="form-label fs-15 text-dark">ระบบการติดตั้ง <span class="text-danger">*</span></label>
                                                            <select class="form-control" id="pojSystem" name="pojSystem">
                                                                <option value="<?= $pojSystem ?>"><?= $pojSystem ?>
                                                                </option>
                                                                <option value="MEA">MEA</option>
                                                                <option value="MEA">PEA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?PHP
                                                    if ($page  == 'addEV') {
                                                    ?>
                                                    <?PHP
                                                    } else {
                                                    ?>
                                                        <div class="row gy-2 mt-3">

                                                            <div class="col-xxl-3 col-md-4 ">
                                                                <label for="labelInput" class="form-label fs-15 text-dark">กำลังไฟต่อแผง(Wp/แผง)<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="pojWp" name="pojWp" value="<?= $pojWp ?>">
                                                            </div>
                                                            <div class="col-xxl-3 col-md-4 ">
                                                                <label for="labelInput" class="form-label fs-15 text-dark">จำนวน(แผง)<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="pojPhaseQty" name="pojPhaseQty" value="<?= $pojPhaseQty ?>">
                                                            </div>
                                                            <div class="col-xxl-3 col-md-4 ">
                                                                <label for="labelInput" class="form-label fs-15 text-dark">กำลังไฟรวม(kWp)<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="pojTotalWatt" name="pojTotalWatt" value="<?= $pojTotalWatt ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-12 col-md-12">
                                                            <div>
                                                                <label for="exampleFormControlTextarea5" class="form-label fs-15 text-dark">หมายเหตุ</label>
                                                                <textarea class="form-control" id="pojRemark" name="pojRemark" rows="5"><?= $pojRemark ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?PHP
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">สินค้าโครงการ</h5>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">รับประกันงานสินค้า(ปี)</label>
                                        <input type="number" class="form-control" id="pojProductWaranty" name="pojProductWaranty" value="<?= $pojProductWaranty ?>">
                                    </div>
                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">เริ่มรับประกันสินค้า</label>
                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojProductStartWaranty" name="pojProductStartWaranty" value="<?= $pojProductStartWaranty ?>">
                                    </div>
                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">สิ้นสุดประกันสินค้า</label>
                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojProductEndWaranty" name="pojProductEndWaranty" value="<?= $pojProductEndWaranty ?>">
                                    </div>
                                    <div class="col-xxl-3 col-md-8">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">เพิ่มสินค้า<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojProduct" name="pojProduct">
                                            <option value="<?= $pojProduct ?>"><?= $pojProduct ?></option>
                                            <?php
                                            $result = $proService->viewProduct();
                                            $num = $result->rowCount();
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $row["proName"]; ?>">
                                                    <?php echo $row["proName"]; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">จำนวนสินค้า</label>
                                        <input type="number" class="form-control" id="pojProductQty" name="pojProductQty" value="<?= $pojProductQty ?>">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" onclick="addSubProduct()" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">เพิ่มสินค้าย่อย</button>
                                    </div>

                                    <div class="card-body mt-5" style="padding: 15px;background-color: #f9f9f9;">
                                        <div class="row gy-2">
                                            <div>
                                                <button type="button" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center2">อัพโหลดไฟล์</button>
                                            </div>
                                            <div class="live-preview">
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap mt-3">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">รายการ</th>
                                                                <th scope="col" style=" width: 25%;">ชื่อสินค้า</th>
                                                                <th scope="col" style=" width: 5%;">Lot No</th>
                                                                <th scope="col">Serial No</th>
                                                                <th scope="col">เริ่มรับประกัน</th>
                                                                <th scope="col">สิ้นสุดรับประกัน</th>
                                                                <th scope="col">จัดการ</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="addSubProductBody">
                                                            <?php
                                                            $lp = explode("|", $pojListProduct);
                                                            $ll = explode("|", $pojListLot);
                                                            $ls = explode("|", $pojListSerial);
                                                            $lws = explode("|", $pojListStartWarranty);
                                                            $lwe = explode("|", $pojListEndWarranty);

                                                            $s = 0;
                                                            foreach ($lp as $lps) {
                                                                $s++;
                                                            ?>
                                                                <tr class="SubProductRow" data-id="<?= $s ?>">
                                                                    <th scope="row"><?= $s ?></th>
                                                                    <td>
                                                                        <select class="form-control1 form-control-sm fs-12" id="pojListProduct" name="pojListProduct[]" aria-label="Default select example">
                                                                            <option value="<?= trim($lps) ?>"><?= trim($lps) ?></option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control1 form-control-sm fs-12 lotno" id="pojListLot" name="pojListLot[]" type="text" placeholder="-" data-lotno="<?= $s ?>" value="<?= trim($ll[$s - 1]) ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control1 form-control-sm fs-12 serialno" id="pojListSerial" name="pojListSerial[]" type="text" placeholder="1101111111111" data-serialno="<?= $s ?>" value="<?= trim($ls[$s - 1]) ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojListStartWarranty" name="pojListStartWarranty[]" placeholder="24-01-2024" value="<?= trim($lws[$s - 1]) ?>">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojListEndWarranty" name="pojListEndWarranty[]" placeholder="24-01-2024" value="<?= trim($lwe[$s - 1]) ?>">
                                                                    </td>
                                                                    <td>
                                                                        <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" onclick="deleteSubProductRowSetId(<?= $s ?>)"></i>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                    <div class="text-center">
                                                        <button type="button" onclick="addSubProductBodyInRow()" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">+
                                                            ช่องสินค้า</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">การบริการ</h5>
                                    </div>

                                    <div class="live-preview mt-2">
                                        <div class="table-responsive">
                                            <table class="table table-nowrap ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">รายการ</th>
                                                        <th scope="col" style=" width: 25%;">กำหนดเข้าบริการ</th>
                                                        <th scope="col">หัวข้องานบริการ</th>
                                                        <th scope="col">ค่าบริการ</th>
                                                        <th scope="col">สถานะบริการ</th>
                                                        <th scope="col">จัดการ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="serviceListBody">
                                                    <?php
                                                    $sd = explode("|", $pojServiceDate);
                                                    $st = explode("|", $pojServiceTopic);
                                                    $sp = explode("|", $pojServicePrices);
                                                    $pss = explode("|", $pojServiceStatus);

                                                    $s = 0;
                                                    foreach ($st as $sts) {
                                                        $s++;
                                                    ?>
                                                        <tr class="serviceRow" data-id="<?= $s ?>">
                                                            <th scope="row"><?= $s ?>
                                                            </th>
                                                            <td>
                                                                <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024" id="pojServiceDate" name="pojServiceDate[]" value="<?= trim($sd[$s - 1]) ?>">
                                                            </td>
                                                            <td>
                                                                <input class="form-control1 form-control-sm fs-12" type="text" placeholder="งานบริการ" id="pojServiceTopic" name="pojServiceTopic[]" value="<?= trim($sts) ?>">
                                                            </td>
                                                            <td>
                                                                <input class="form-control1 form-control-sm fs-12" type="text" placeholder="0.00" id="pojServicePrices" name="pojServicePrices[]" value="<?= trim($sp[$s - 1]) ?>">
                                                            </td>
                                                            <td class="serviceButton" data-button="<?= $s ?>">
                                                                <button type="button" class="btn btn-<?php echo getStatuColor(trim($pss[$s - 1])) ?> btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center1" onclick="changeServiceStatus(<?= $s ?>)"><?= trim($pss[$s - 1]) ?></button>
                                                            </td>
                                                            <td class="serviceType" data-type="<?= $s ?>">
                                                                <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-service" onclick="deleteServiceRowSetId(<?= $s ?>)"></i>
                                                            </td>
                                                            <input type="hidden" id="pojServiceStatus" class="pojServiceStatus" name="pojServiceStatus[]" data-pojServiceStatus="<?= $s ?>" value="<?= trim($pss[$s - 1]) ?>">
                                                        </tr>

                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <!-- Base Buttons -->
                                                <!-- Outline Buttons -->
                                                <button type="button" onclick="addServiceRow()" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">+
                                                    ช่องบริการ</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center3" class="btn btn-primary btn-label waves-effect waves-light right ms-auto nexttab nexttab fs-24" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-24 ms-2"></i>บันทึก</button>
                                        <button type="submit" id="submitBtn" style="display: none;">Submit</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->



                <!-- modal-content -->

                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <div>
                                    <h4 class="mb-4">คุณต้องการยืนยันการทำรายการหรือไม่ ?</h4>
                                    <div class="hstack gap-2 justify-content-center">
                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="#" class="btn btn-primary fs-18" data-bs-dismiss="modal" onclick="deleteSubProductRow(); return false;">ยืนยันการทำรายการ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bs-example-modal-center-service" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <div>
                                    <h4 class="mb-4">คุณต้องการยืนยันการทำรายการหรือไม่?</h4>
                                    <div class="hstack gap-2 justify-content-center">
                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="#" class="btn btn-primary fs-18" data-bs-dismiss="modal" onclick="deleteServiceRow(); return false;">ยืนยันการทำรายการ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <div>
                                    <h4 class="mb-4">คุณต้องการยืนยันการทำรายการหรือไม่ ?</h4>
                                    <div class="hstack gap-2 justify-content-center">
                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="#" class="btn btn-primary fs-18" data-bs-dismiss="modal" onclick="simulateButtonClick(); return false;">ยืนยันการทำรายการ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <div>
                                    <h4 class="mb-4">Import Serial No (.xlx, .xlsx)</h4>
                                    <!-- Buttons Input -->
                                    <div class="12">

                                        <div class="input-group col-xxl-2 col-md-2">
                                            <input class="form-control form-control-sm  fs-14" type="text" id="formFileNo" placeholder="ระบุลำดับที่ต้องการ *1-5, 6-10 ">
                                        </div>
                                        <div class="input-group col-xxl-2 col-md-2 mt-4">
                                            <input class="form-control form-control-sm tn btn-outline-dark waves-effect waves-light material-shadow-none fs-13" id="formFileSm" type="file">
                                            <button class="btn btn-outline-primary" type="button" id="button-addon1">อัพโหลดไฟล์</button>
                                        </div>

                                    </div>
                                    <div class="hstack gap-2 justify-content-center mt-5">

                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="javascript:void(0);" class="btn btn-primary fs-18" onclick="readExcelFile()">ยืนยันการทำรายการ</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


                <div class="modal fade bs-example-modal-center1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <div>
                                    <h4 class="mb-4">เลือกสถานะการบริการ</h4>
                                    <div class="col-12 mt-3">
                                        <select class="form-control" aria-label="Default select example" id="selectService">
                                            <option value="1">กำลังดำเนินการ</option>
                                            <option value="2">ดำเนินการเสร็จสิ้น</option>
                                            <option value="3">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="hstack gap-2 justify-content-center mt-5">
                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="javascript:void(0);" onclick="changeServiceStatusConfirm()" class="btn btn-primary fs-18">ยืนยันการทำรายการ</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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
</form>
</div>

<!-- END layout-wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var productLists = [];
    var productListsOptionHtml = ``;
    var deleteSubProductRowId = null;
    var deleteServiceRowId = null;
    getProductList();

    document.getElementById('pojPost').addEVentListener('change', function() {
        var postcode = this.value;
        fetch(`option/get_address_data.php?postcode=${postcode}`)
            .then(response => response.json())
            .then(data => {
                var tumbolSelect = document.getElementById('pojTumbol');
                var aumperSelect = document.getElementById('pojAumper');
                var provinceSelect = document.getElementById('pojProvince');

                tumbolSelect.innerHTML = '<option selected>กรุณาเลือก</option>';
                aumperSelect.innerHTML = '<option selected>กรุณาเลือก</option>';
                provinceSelect.innerHTML = '<option selected>กรุณาเลือก</option>';

                var tumbols = new Set();
                var aumpers = new Set();
                var provinces = new Set();
                data.forEach(item => {
                    tumbols.add(item.tumbon);
                    aumpers.add(item.aumper);
                    provinces.add(item.province);
                });

                tumbols.forEach(tumbol => {
                    tumbolSelect.innerHTML += `<option value="${tumbol}">${tumbol}</option>`;
                });

                aumpers.forEach(aumper => {
                    aumperSelect.innerHTML += `<option value="${aumper}">${aumper}</option>`;
                });

                provinces.forEach(province => {
                    provinceSelect.innerHTML += `<option value="${province}">${province}</option>`;
                });
            })
            .catch(error => console.error('Error:', error));
    });

    function addSubProduct() {
        var productListsOptionHtml_ = ``;
        var pojProduct = document.getElementById('pojProduct').value;
        var pojProductQty = document.getElementById('pojProductQty').value;
        var pojProductStartWaranty = document.getElementById('pojProductStartWaranty').value;
        var pojProductEndWaranty = document.getElementById('pojProductEndWaranty').value;

        if (pojProductQty) {
            document.getElementById('addSubProductBody').innerHTML = ``;
            productLists.forEach(item => {
                productListsOptionHtml_ +=
                    `<option value="${item}" ${pojProduct.trim() == item.trim() ? 'selected' : ''}>${item}</option>`;
            });

            for (let index = 0; index < pojProductQty; index++) {
                var getHtml = createHtmlProductRow(index + 1, productListsOptionHtml_);
                document.getElementById('addSubProductBody').innerHTML += getHtml;
            }

            flatpickr('#pojListStartWarranty', {
                dateFormat: 'd M, Y',
            })
            flatpickr('#pojListEndWarranty', {
                dateFormat: 'd M, Y',
            })
        }
    }

    function addSubProductBodyInRow() {
        var productListsOptionHtml_ = ``;
        var SubProductRow = $('.SubProductRow').length;
        var pojProduct = $('#pojProduct').value;
        productLists.forEach(item => {
            if (pojProduct) {
                pojProduct = pojProduct.trim();
            }
            productListsOptionHtml_ +=
                `<option value="${item}" ${pojProduct == item.trim() ? 'selected' : ''}>${item}</option>`;
        });
        var getHtml = createHtmlProductRow(SubProductRow + 1, productListsOptionHtml_);

        $('#addSubProductBody').append(getHtml);

        flatpickr('#pojListStartWarranty', {
            dateFormat: 'd M, Y',
        })
        flatpickr('#pojListEndWarranty', {
            dateFormat: 'd M, Y',
        })
    }

    function createHtmlProductRow(rowNumber, productListsOptionHtml_) {
        var pojProductQty = document.getElementById('pojProductQty').value;
        var pojProductStartWaranty = document.getElementById('pojProductStartWaranty').value;
        var pojProductEndWaranty = document.getElementById('pojProductEndWaranty').value;

        var html = `<tr class="SubProductRow" data-id="${rowNumber}">
                        <th scope="row">${rowNumber}</th>
                        <td>
                            <select class="form-control1 form-control-sm fs-12"
                                id="pojListProduct" name="pojListProduct[]"
                                aria-label="Default select example">
                                ${productListsOptionHtml_}
                            </select>
                        </td>
                        <td>
                            <input class="form-control1 form-control-sm fs-12 lotno"
                                id="pojListLot" name="pojListLot[]"
                                type="text" placeholder="-" data-lotno="${rowNumber}">
                        </td>
                        <td>
                            <input class="form-control1 form-control-sm fs-12 serialno"
                                id="pojListSerial" name="pojListSerial[]"
                                type="text" placeholder="1101111111111" data-serialno="${rowNumber}">
                        </td>
                        <td>
                            <input type="text"
                                class="form-control1 form-control-sm fs-12 flatpickr-input"
                                data-provider="flatpickr"
                                data-date-format="d M, Y" readonly="readonly"
                                id="pojListStartWarranty" name="pojListStartWarranty[]"
                                placeholder="24-01-2024" value="${pojProductStartWaranty}">
                        </td>
                        <td>
                            <input type="text"
                                class="form-control1 form-control-sm fs-12 flatpickr-input"
                                data-provider="flatpickr"
                                data-date-format="d M, Y" readonly="readonly"
                                id="pojListEndWarranty" name="pojListEndWarranty[]"
                                placeholder="24-01-2024" value="${pojProductEndWaranty}">
                        </td>
                        <td>
                            <i class="ri-delete-bin-line fs-18 text-danger"
                                type="button" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-center" onclick="deleteSubProductRowSetId(${rowNumber})"></i>
                        </td>
                    </tr>`;

        return html;
    }

    function deleteSubProductRow() {
        var dataArray = [];
        var updatedHtml = ``;
        var qq = $('.SubProductRow[data-id="' + deleteSubProductRowId + '"]');
        qq.remove();


        $('.SubProductRow').each(function(index, element) {
            var newIndex = index + 1;
            var $element = $(element);

            $element.attr('data-id', newIndex);
            $element.find('.lotno').attr('data-lotno', newIndex);
            $element.find('.serialno').attr('data-serialno', newIndex);
            $element.find('[onclick^="deleteSubProductRowSetId"]').attr('onclick', 'deleteSubProductRowSetId(' +
                newIndex + ')');
            $element.find('th').text(newIndex);

        });
    }

    function deleteSubProductRowSetId(id) {
        deleteSubProductRowId = id;
    }

    function getProductList() {
        var productList = [];
        fetch(`option/get_product_data.php`)
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {
                    productList.push(item.proName);
                });

                productLists = productList;
            })
            .catch(error => console.error('Error:', error));
    }

    function readExcelFile() {
        const formFileNo = document.getElementById('formFileNo').value;
        const input = document.getElementById('formFileSm');
        const file = input.files[0];

        var formFileNoArray = makeNumberToArray(formFileNo);

        const reader = new FileReader();

        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {
                type: 'array'
            });

            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            var excelArray = XLSX.utils.sheet_to_json(firstSheet);

            formFileNoArray.forEach((element) => {
                document.getElementsByClassName('lotno')[(element - 1)].value = excelArray[(element - 1)]
                    .ln;
                document.getElementsByClassName('serialno')[(element - 1)].value = excelArray[(element - 1)]
                    .sn;
            });


        };

        reader.readAsArrayBuffer(file);
    }

    function makeNumberToArray(formFileNo) {
        var range = formFileNo.split("-");

        var start = parseInt(range[0]);
        var end = parseInt(range[1]);

        var result = [];

        for (var i = start; i <= end; i++) {
            result.push(i);
        }

        return result;

    }

    // ----------------------------------------------------------------------------------------------------
    function addServiceRow() {

        var rowNumber = $('.serviceRow').length + 1;

        var html = `<tr class="serviceRow" data-id="${rowNumber}">
                    <th scope="row">${rowNumber}
                    </th>
                    <td>
                        <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr"
                            data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024" id="pojServiceDate" name="pojServiceDate[]">
                    </td>
                    <td>
                        <input class="form-control1 form-control-sm fs-12"
                            type="text" placeholder="งานบริการ" id="pojServiceTopic" name="pojServiceTopic[]">
                    </td>
                    <td>
                        <input class="form-control1 form-control-sm fs-12"
                            type="text" placeholder="0.00" id="pojServicePrices" name="pojServicePrices[]">
                    </td>
                    <td class="serviceButton" data-button="${rowNumber}">
                        <button type="button" class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"  
                            data-bs-target=".bs-example-modal-center1" onclick="changeServiceStatus(${rowNumber})">รอดำเนินการ</button>
                    </td>
                    <td class="serviceType" data-type="${rowNumber}">
                        <i class="ri-delete-bin-line fs-18 text-danger"
                            type="button" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-center-service" onclick="deleteServiceRowSetId(${rowNumber})"></i>
                    </td>
                    <input type="hidden" id="pojServiceStatus" class="pojServiceStatus" name="pojServiceStatus[]" data-pojServiceStatus="${rowNumber}" value="รอดำเนินการ">
                </tr>`;
        $('#serviceListBody').append(html)

        flatpickr('#pojServiceDate', {
            dateFormat: 'd M, Y',
        })
    }

    var serviceStatus = null;

    function changeServiceStatus(id) {
        serviceStatus = id;
    }


    function changeServiceStatusConfirm() {
        var selectService = $("#selectService").val();
        var html = ``;
        var serviceStatusText = "";
        if (selectService == 1) {
            serviceStatusText = "รอดำเนินการ";
            html =
                `<button type="button" class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center1" onclick="changeServiceStatus(${serviceStatus})">รอดำเนินการ</button>`;
        } else if (selectService == 2) {
            serviceStatusText = "ดำเนินการเสร็จสิ้น";
            html =
                `<button type="button" class="btn btn-success btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center1" onclick="changeServiceStatus(${serviceStatus})">ดำเนินการเสร็จสิ้น</button>`;
        } else if (selectService == 3) {
            serviceStatusText = "ยกเลิก";
            html =
                `<button type="button" class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center1" onclick="changeServiceStatus(${serviceStatus})">ยกเลิก</button>`;
        }

        $('.serviceButton[data-button="' + serviceStatus + '"]').html(``).append(html);

        $('#pojServiceStatus[data-pojServiceStatus="' + serviceStatus + '"]').val(serviceStatusText);
    }

    function deleteServiceRowSetId(id) {
        deleteServiceRowId = id;
    }

    function deleteServiceRow() {
        var dataArray = [];
        var updatedHtml = ``;
        var qq = $('.serviceRow[data-id="' + deleteServiceRowId + '"]');
        qq.remove();


        $('.serviceRow').each(function(index, element) {
            var newIndex = index + 1;
            var $element = $(element);
            var $serviceType = $element.find('.serviceType');
            var $serviceButton = $element.find('.serviceButton');

            $element.attr('data-id', newIndex);
            $serviceType.attr('data-type', newIndex);
            $serviceButton.attr('data-button', newIndex);
            $element.find('[onclick^="deleteServiceRowSetId"]').attr('onclick', 'deleteServiceRowSetId(' +
                newIndex + ')');
            $element.find('th').text(newIndex);

        });
    }

    function simulateButtonClick() {
        document.getElementById('submitBtn').click();
    }
</script>