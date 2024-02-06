<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';


if($_GET['page'] == 'addVE'){
    $header = "เพิ่มโครงการอีวีชาร์จเจอร์";
}else{
    $header = "เพิ่มโครงการโซล่าร์เซลล์";
}

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);
$data = null;

if (!empty($_POST['pojName'])) {
    // อัพโหลดรูปภาพ
    $uploadedImages = uploadFilesPS($_FILES['ssss']);
    // อัพโหลดเอกสาร
    $uploadedFiles = uploadFilesPS($_FILES['sssss']);

    $data = new stdClass();

    // $data->pojID= $_POST["pojID"];
    $data->pojCus = $_POST["pojCus"];
    $data->pojStatus = $_POST["pojStatus"];
    $data->pojDocStatus = $_POST["pojDocStatus"];
    $data->pojImage = uploadFilesPS($_FILES["pojImage"]);
    $data->pojFile = uploadFilesPS($_FILES["pojFile"]);
    $data->pojPDF = uploadFilesPS($_FILES["pojPDF"]);
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
    $data->pojStartWarranty = $_POST["pojStartWarranty"];
    $data->pojEndWarranty = $_POST["pojEndWarranty"];
    $data->pojPhase = $_POST["pojPhase"];
    $data->pojSystem = $_POST["pojSystem"];
    $data->pojWp = $_POST["pojWp"];
    $data->pojPhaseQty = $_POST["pojPhaseQty"];
    $data->pojTotalWatt = $_POST["pojTotalWatt"];
    $data->pojRemark = $_POST["pojRemark"];
    $data->pojProductWaranty = $_POST["pojProductWaranty"];
    $data->pojProductStartWaranty = '2024-02-06';$_POST["pojProductStartWaranty"];
    $data->pojProductEndWaranty = '2024-02-06';$_POST["pojProductEndWaranty"];
    $data->pojProduct = $_POST["pojProduct"];
    $data->pojProductQty = $_POST["pojProductQty"];

    $create = $prjService->createProject($data);
    $data = null;
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
?>

<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<form method="post" action="home.php?page=addSolar" id="myForm" enctype="multipart/form-data">
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"><?=$header?></h4>
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
                                            <option value="">- เลือกลูกค้า -</option>
                                            <?php
                                            $result = $cusService->viewCustomer();
                                            $num = $result->rowCount();
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $row["cusName"]; ?>"><?php echo $row["cusName"]; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะโครงการ<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojStatus" name="pojStatus" required>
                                            <option selected>- เลือกสถานะโครงการ -</option>
                                            <option value="ดำเนินการ">ดำเนินการ</option>
                                            <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                            <option value="ยกเลิก">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะงานขออนุญาต<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojDocStatus" name="pojDocStatus" required>
                                            <option selected>- เลือกสถานะโครงการ -</option>
                                            <option value="ดำเนินการ">ดำเนินการ</option>
                                            <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                            <option value="ยกเลิก">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">รูปถ่ายและเอกสารโครงการ</h5>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">รูปในโครงการ <span class="text-danger">*(.jpg ไม่เกิน 30 รูป)</span></label>
                                        <input class="form-control" type="file" id="pojImage" name="pojImage[]" multiple>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารการขออนุญาต <span class="text-danger">*(.pdf ไม่เกิน 5ไฟล์)</span></label>
                                        <input class="form-control" type="file" id="pojFile" name="pojFile[]" multiple>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารแนบโครงการ <span class="text-danger">*(.pdf ไม่เกิน 5ไฟล์)</span></label>
                                        <input class="form-control" type="file" id="pojPDF" name="pojPDF[]" multiple>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">รายละเอียดโครงการ</h5>
                                    </div>
                                    <div class="col-xxl-7 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">ชื่อโครงการ<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pojName" name="pojName" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-5 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ประเภทโครงการ<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojType" name="pojType" required>
                                            <option value="">- เลือกประเภทโครงการ</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขที่โครงการ</label>
                                            <input type="text" class="form-control" id="pojCODE" name="pojCODE" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขที่ใบแจ้งหนี้</label>
                                            <input type="text" class="form-control" id="pojVoidID" name="pojVoidID">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขที่สัญญา</label>
                                            <input type="text" class="form-control" id="pojContractID" name="pojContractID">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">ที่อยู่โครงการ</h5>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pojPost" name="pojPost" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ตำบล/แขวง<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojTumbol" name="pojTumbol" required>
                                            <option selected>กรุณาเลือก</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">อำเภอ/เขต<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojAumper" name="pojAumper" required>
                                            <option selected>กรุณาเลือก</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">จังหวัด <span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojProvince" name="pojProvince" required>
                                            <option selected>กรุณาเลือก</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">บ้านเลขที่/หมู่บ้าน/อาคาร<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="pojAddr" name="pojAddr" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">พิกัด Google Maps</label>
                                            <input type="text" class="form-control" id="pojGlo" name="pojGlo" required>
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
                                                        <input type="number" class="form-control" id="pojWarranty" name="pojWarranty">
                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">เริ่มรับประกันงานติดตั้ง</label>
                                                        <input type="date" class="form-control flatpickr-input" id="pojStartWarranty" name="pojStartWarranty">
                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">สิ้นสุดประกันงานติดตั้ง</label>
                                                        <input type="date" class="form-control flatpickr-input" id="pojEndWarranty" name="pojEndWarranty">
                                                    </div>

                                                    <div class="row gy-2">
                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="labelInput" class="form-label fs-15 text-dark">Phase</label>
                                                            <input type="text" class="form-control" id="pojPhase" name="pojPhase">
                                                        </div>
                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="exampleDataList" class="form-label fs-15 text-dark">ระบบการติดตั้ง <span class="text-danger">*</span></label>
                                                            <select class="form-control" id="pojSystem" name="pojSystem">
                                                                <option value="">เหลือกระบบการติดตั้ง</option>
                                                                <option value="MEA">MEA</option>
                                                                <option value="MEA">PEA</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-2 mt-3">

                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="labelInput" class="form-label fs-15 text-dark">กำลังไฟต่อแผง(Wp/แผง)<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pojWp" name="pojWp">
                                                        </div>
                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="labelInput" class="form-label fs-15 text-dark">จำนวน(แผง)<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pojPhaseQty" name="pojPhaseQty">
                                                        </div>
                                                        <div class="col-xxl-3 col-md-4 ">
                                                            <label for="labelInput" class="form-label fs-15 text-dark">กำลังไฟรวม(kWp)<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pojTotalWatt" name="pojTotalWatt">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-12 col-md-12">
                                                        <div>
                                                            <label for="exampleFormControlTextarea5" class="form-label fs-15 text-dark">หมายเหตุ</label>
                                                            <textarea class="form-control" id="pojRemark" name="pojRemark" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">สินค้าโครงการ</h5>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">รับประกันงานสินค้า(ปี)</label>
                                        <input type="number" class="form-control" id="pojProductWaranty" name="pojProductWaranty">
                                    </div>
                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">เริ่มรับประกันสินค้า</label>
                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojProductStartWaranty" name="pojProductStartWaranty">
                                        <!-- <input type="date" class="form-control flatpickr-input" id="pojProductStartWaranty" name="pojProductStartWaranty"> -->
                                    </div>
                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">สิ้นสุดประกันสินค้า</label>
                                        <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" id="pojProductEndWaranty" name="pojProductEndWaranty">
                                        <!-- <input type="date" class="form-control flatpickr-input" id="pojProductEndWaranty" name="pojProductEndWaranty"> -->
                                    </div>
                                    <div class="col-xxl-3 col-md-8">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">เพิ่มสินค้า<span class="text-danger">*</span></label>
                                        <select class="form-control" id="pojProduct" name="pojProduct">
                                            <option value="">-เลือกสินค้า-</option>
                                            <?php
                                            $result = $proService->viewProduct();
                                            $num = $result->rowCount();
                                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $row["proName"]; ?>"><?php echo $row["proName"]; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 ">
                                        <label for="labelInput" class="form-label fs-15 text-dark">จำนวนสินค้า</label>
                                        <input type="number" class="form-control" id="pojProductQty" name="pojProductQty">
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">เพิ่มสินค้าย่อย</button>
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
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>
                                                                    <select class="form-control1 form-control-sm fs-12" aria-label="Default select example">
                                                                        <option value="1">Home Charge AC 7kW 1 Plug (1 Phase)</option>
                                                                        <option value="2">Home Charge AC 11kW 1 Plug (3 Phase)</option>
                                                                        <option value="3">Home Charge AC 22kW 1 Plug (3 Phase)</option>
                                                                        <option value="4">Public AC 7kW 1 Plug (1 Phase)</option>
                                                                        <option value="5">Public AC 11kW 1 Plug (3 Phase)</option>
                                                                        <option value="6">Public AC 22kW 1 Plug (3 Phase)</option>
                                                                        <option value="7">Public DC 30kW 1 Plug (3 Phase)</option>
                                                                        <option value="8">Public DC 80kW 2 Plugs (3 Phase)</option>
                                                                        <option value="9">Public DC 120kW 2 Plugs (3 Phase)</option>
                                                                        <option value="10">Public DC 160kW 2 Plugs (3 Phase)</option>
                                                                        <option value="11">Public DC 180kW 2 Plugs (3 Phase)</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input class="form-control1 form-control-sm fs-12" type="text" placeholder="-">
                                                                </td>

                                                                <td>
                                                                    <input class="form-control1 form-control-sm fs-12" type="text" placeholder="122326051146">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                                </td>
                                                                <td>
                                                                    <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"></i>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>
                                                                    <select class="form-control1 form-control-sm fs-12" aria-label="Default select example">
                                                                        <option value="1">Home Charge AC 7kW 1 Plug (1 Phase)</option>
                                                                        <option value="2">Home Charge AC 11kW 1 Plug (3 Phase)</option>
                                                                        <option value="3">Home Charge AC 22kW 1 Plug (3 Phase)</option>
                                                                        <option value="4">Public AC 7kW 1 Plug (1 Phase)</option>
                                                                        <option value="5">Public AC 11kW 1 Plug (3 Phase)</option>
                                                                        <option value="6">Public AC 22kW 1 Plug (3 Phase)</option>
                                                                        <option value="7">Public DC 30kW 1 Plug (3 Phase)</option>
                                                                        <option value="8">Public DC 80kW 2 Plugs (3 Phase)</option>
                                                                        <option value="9">Public DC 120kW 2 Plugs (3 Phase)</option>
                                                                        <option value="10">Public DC 160kW 2 Plugs (3 Phase)</option>
                                                                        <option value="11">Public DC 180kW 2 Plugs (3 Phase)</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input class="form-control1 form-control-sm fs-12" type="text" placeholder="-">
                                                                </td>

                                                                <td>
                                                                    <input class="form-control1 form-control-sm fs-12" type="text" placeholder="122326051146">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                                </td>
                                                                <td>
                                                                    <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"></i>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>
                                                                    <select class="form-control1 form-control-sm fs-12" aria-label="Default select example">
                                                                        <option value="1">Home Charge AC 7kW 1 Plug (1 Phase)</option>
                                                                        <option value="2">Home Charge AC 11kW 1 Plug (3 Phase)</option>
                                                                        <option value="3">Home Charge AC 22kW 1 Plug (3 Phase)</option>
                                                                        <option value="4">Public AC 7kW 1 Plug (1 Phase)</option>
                                                                        <option value="5">Public AC 11kW 1 Plug (3 Phase)</option>
                                                                        <option value="6">Public AC 22kW 1 Plug (3 Phase)</option>
                                                                        <option value="7">Public DC 30kW 1 Plug (3 Phase)</option>
                                                                        <option value="8">Public DC 80kW 2 Plugs (3 Phase)</option>
                                                                        <option value="9">Public DC 120kW 2 Plugs (3 Phase)</option>
                                                                        <option value="10">Public DC 160kW 2 Plugs (3 Phase)</option>
                                                                        <option value="11">Public DC 180kW 2 Plugs (3 Phase)</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input class="form-control1 form-control-sm fs-12" type="text" placeholder="-">
                                                                </td>

                                                                <td>
                                                                    <input class="form-control1 form-control-sm fs-12" type="text" placeholder="122326051146">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                                </td>
                                                                <td>
                                                                    <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"></i>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                    <div class="text-center"><!-- Base Buttons -->
                                                        <!-- Outline Buttons -->
                                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">+ ช่องสินค้า</button>
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
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>
                                                            <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                        </td>
                                                        <td>
                                                            <input class="form-control1 form-control-sm fs-12" type="text" placeholder="งานบริการ">
                                                        </td>
                                                        <td>
                                                            <input class="form-control1 form-control-sm fs-12" type="text" placeholder="-">
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center1">รอดำเนินการ</button>
                                                        </td>
                                                        <td>
                                                            <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"></i>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>
                                                            <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                        </td>
                                                        <td>
                                                            <input class="form-control1 form-control-sm fs-12" type="text" placeholder="งานบริการ">
                                                        </td>
                                                        <td>
                                                            <input class="form-control1 form-control-sm fs-12" type="text" placeholder="-">
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center1">ดำเนินการเสร็จสิ้น</button>
                                                        </td>
                                                        <td>
                                                            <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"></i>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>
                                                            <input type="text" class="form-control1 form-control-sm fs-12 flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly" placeholder="24-01-2024">
                                                        </td>
                                                        <td>
                                                            <input class="form-control1 form-control-sm fs-12" type="text" placeholder="งานบริการ">
                                                        </td>
                                                        <td>
                                                            <input class="form-control1 form-control-sm fs-12" type="text" placeholder="-">
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center1">ยกเลิก</button>
                                                        </td>
                                                        <td>
                                                            <i class="ri-delete-bin-line fs-18 text-danger" type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"></i>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            <div class="text-center"><!-- Base Buttons -->
                                                <!-- Outline Buttons -->
                                                <button type="button" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">+ ช่องบริการ</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" class="btn btn-primary btn-label waves-effect waves-light right ms-auto nexttab nexttab fs-24" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-24 ms-2"></i>บันทึก</button>
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





                <div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                                <div>
                                    <h4 class="mb-4">Import Serial No (.xlx, .xlsx)</h4>
                                    <!-- Buttons Input -->
                                    <div class="12">

                                        <div class="input-group col-xxl-2 col-md-2">
                                            <input class="form-control form-control-sm  fs-14" type="text" placeholder="ระบุลำดับที่ต้องการ *1-5, 6-10 ">
                                        </div>
                                        <div class="input-group col-xxl-2 col-md-2 mt-4">
                                            <input class="form-control form-control-sm tn btn-outline-dark waves-effect waves-light material-shadow-none fs-13" id="formFileSm" type="file">
                                            <button class="btn btn-outline-primary" type="button" id="button-addon1">อัพโหลดไฟล์</button>
                                        </div>

                                    </div>
                                    <div class="hstack gap-2 justify-content-center mt-5">

                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="javascript:void(0);" class="btn btn-primary fs-18">ยืนยันการทำรายการ</a>
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
                                        <select class="form-control" aria-label="Default select example">
                                            <option value="1">กำลังดำเนินการ</option>
                                            <option value="2">ดำเนินการเสร็จสิ้น</option>
                                            <option value="3">ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="hstack gap-2 justify-content-center mt-5">
                                        <button type="button" class="btn btn-light fs-18" data-bs-dismiss="modal">ยกเลิก</button>
                                        <a href="javascript:void(0);" class="btn btn-primary fs-18">ยืนยันการทำรายการ</a>
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

<script>
    document.getElementById('pojPost').addEventListener('change', function() {
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
    })
</script>

<script>
    function simulateButtonClick() {
        document.getElementById('submitBtn').click();
    }
</script>