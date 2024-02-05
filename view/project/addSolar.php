<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);
$data = null;

if (!empty($_POST['sssss'])) {
    // อัพโหลดรูปภาพ
    $uploadedImages = uploadFilesPS($_FILES['ssss']);

    // อัพโหลดเอกสาร
    $uploadedFiles = uploadFilesPS($_FILES['sssss']);
    
    $data = new stdClass();
    $data->proName = $_POST['ssss'];
    $data->proType = $_POST['ssss'];
    $data->proImage = $uploadedImages;
    $data->proFile = $uploadedFiles;

    $create = $prjService->createProject($data);
    $data = null;
?>
    <div class="modal fade bs-example-modal-center show" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
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
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">เพิ่มโครงการโซล่าร์เซลล์</h4>
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
                                    <select class="form-control" id="" name="">
                                        <option selected>- เลือกลูกค้า -</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะโครงการ<span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>- เลือกสถานะโครงการ -</option>
                                        <option value="ดำเนินการ">ดำเนินการ</option>
                                        <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                        <option value="ยกเลิก">ยกเลิก</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะงานขออนุญาต<span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>- เลือกสถานะโครงการ -</option>
                                        <option value="1">ดำเนินการ</option>
                                        <option value="2">เสร็จสิ้น</option>
                                        <option value="3">ยกเลิก</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-5">
                                    <h5 class="fs-18 fw-bold ">รูปถ่ายและเอกสารโครงการ</h5>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">รูปในโครงการ <span class="text-danger">*(.jpg ไม่เกิน 30 รูป)</span></label>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารการขออนุญาต <span class="text-danger">*(.pdf ไม่เกิน 5ไฟล์)</span></label>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารแนบโครงการ <span class="text-danger">*(.pdf ไม่เกิน 5ไฟล์)</span></label>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                                <div class="col-12 mt-5">
                                    <h5 class="fs-18 fw-bold ">รายละเอียดโครงการ</h5>
                                </div>
                                <div class="col-xxl-7 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">ชื่อโครงการ<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="labelInput">
                                    </div>
                                </div>
                                <div class="col-xxl-5 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">ประเภทโครงการ<span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>- เลือกประเภทโครงการ</option>
                                        <option value="1">Residential</option>
                                        <option value="2">Commercial</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">เลขที่โครงการ</label>
                                        <input type="text" class="form-control" id="labelInput">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">เลขที่ใบแจ้งหนี้</label>
                                        <input type="text" class="form-control" id="labelInput">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">เลขที่สัญญา</label>
                                        <input type="text" class="form-control" id="labelInput">
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <h5 class="fs-18 fw-bold ">ที่อยู่โครงการ</h5>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="labelInput">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">ตำบล/แขวง<span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>-</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">อำเภอ/เขต<span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>-</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">จังหวัด <span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>-</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">บ้านเลขที่/หมู่บ้าน/อาคาร<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="labelInput">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-6">
                                    <div>
                                        <label for="labelInput" class="form-label fs-15 text-dark">พิกัด Google Maps</label>
                                        <input type="text" class="form-control" id="labelInput" placeholder="https://www.google.co.th/maps/@18.3170581,99.3986862,17z?hl=th">
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
                                                    <input type="number" class="form-control" id="labelInput">
                                                </div>
                                                <div class="col-xxl-3 col-md-4 ">
                                                    <label for="labelInput" class="form-label fs-15 text-dark">เริ่มรับประกันงานติดตั้ง</label>
                                                    <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                                </div>
                                                <div class="col-xxl-3 col-md-4 ">
                                                    <label for="labelInput" class="form-label fs-15 text-dark">สิ้นสุดประกันงานติดตั้ง</label>
                                                    <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                                </div>

                                                <div class="row gy-2">
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">Phase</label>
                                                        <input type="text" class="form-control" id="labelInput">
                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ระบบการติดตั้ง <span class="text-danger">*</span></label>
                                                        <select class="form-control" aria-label="Default select example">
                                                            <option selected>-</option>
                                                            <option value="1">MEA</option>
                                                            <option value="2">PEA</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row gy-2 mt-3">

                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">กำลังไฟต่อแผง(Wp/แผง)<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="labelInput">
                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">จำนวน(แผง)<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="labelInput">
                                                    </div>
                                                    <div class="col-xxl-3 col-md-4 ">
                                                        <label for="labelInput" class="form-label fs-15 text-dark">กำลังไฟรวม(kWp)<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="labelInput">
                                                    </div>
                                                </div>
                                                <div class="col-xxl-12 col-md-12">
                                                    <div>
                                                        <label for="exampleFormControlTextarea5" class="form-label fs-15 text-dark">หมายเหตุ</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea5" rows="5"></textarea>
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
                                    <input type="number" class="form-control" id="labelInput">
                                </div>
                                <div class="col-xxl-3 col-md-4 ">
                                    <label for="labelInput" class="form-label fs-15 text-dark">เริ่มรับประกันสินค้า</label>
                                    <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                </div>
                                <div class="col-xxl-3 col-md-4 ">
                                    <label for="labelInput" class="form-label fs-15 text-dark">สิ้นสุดประกันสินค้า</label>
                                    <input type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                </div>
                                <div class="col-xxl-3 col-md-8">
                                    <label for="exampleDataList" class="form-label fs-15 text-dark">เพิ่มสินค้า<span class="text-danger">*</span></label>
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected>-เลือกสินค้า-</option>
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
                                </div>

                                <div class="col-xxl-3 col-md-4 ">
                                    <label for="labelInput" class="form-label fs-15 text-dark">จำนวนสินค้า</label>
                                    <input type="number" class="form-control" id="labelInput">
                                </div>

                                <div class="text-center"><!-- Base Buttons -->
                                    <!-- Outline Buttons -->
                                    <button type="button" class="btn btn-outline-dark waves-effect waves-light material-shadow-none fs-16">เพิ่มสินค้าย่อย</button>
                                </div>
                                <!--end col-->


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
                                    <a href="javascript:void(0);" class="btn btn-primary fs-18">ยืนยันการทำรายการ</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->





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

</div>
<!-- END layout-wrapper -->