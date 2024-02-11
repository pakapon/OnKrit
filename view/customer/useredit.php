<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$cusService = new CuntomerService($conn);
$data = null;

if (!empty($_GET['id'])) {
    $result = $cusService->viewCustomer($_GET['id']);
    $data = new stdClass();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data->cusId = $row['cusId'];
        $data->businessType = $row['businessType'];
        $data->texID = $row['texID'];
        $data->cusName = $row['cusName'];
        $data->cusTell = $row['cusTell'];
        $data->cusMail = $row['cusMail'];
        $data->cusWeb = $row['cusWeb'];
        $data->cusPost = $row['cusPost'];
        $data->cusTumbol = $row['cusTumbol'];
        $data->cusAumper = $row['cusAumper'];
        $data->cusProvince = $row['cusProvince'];
        $data->cusAddr = $row['cusAddr'];
        $data->cusGlo = $row['cusGlo'];
    }
}

if (!empty($_POST['cusName'])) {

    $data->cusId = $_GET['id'];
    $data->businessType = $_POST['businessType'];
    $data->texID = $_POST['texID'];
    $data->cusName = $_POST['cusName'];
    $data->cusTell = $_POST['cusTell'];
    $data->cusMail = $_POST['cusMail'];
    $data->cusWeb = $_POST['cusWeb'];
    $data->cusPost = $_POST['cusPost'];
    $data->cusTumbol = $_POST['cusTumbol'];
    $data->cusAumper = $_POST['cusAumper'];
    $data->cusProvince = $_POST['cusProvince'];
    $data->cusAddr = $_POST['cusAddr'];
    $data->cusGlo = $_POST['cusGlo'];

    $create = $cusService->updateCustomer($data);

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
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">เพิ่มข้อมูลลูกค้า</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"></a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form method="post" action="index.php?page=useredit&id=<?php echo $data->cusId ?>" id="myForm">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ประเภทธุรกิจ</label>
                                        <select class="form-control" id="businessType" name="businessType" required>
                                            <option> กรุณาเลือก </option>
                                            <option value="บุคคลธรรมดา" <?php echo ($data->businessType == 'บุคคลธรรมดา') ? 'selected' : ''; ?>>บุคคลธรรมดา</option>
                                            <option value="นิติบุคคล" <?php echo ($data->businessType == 'นิติบุคคล') ? 'selected' : ''; ?>>นิติบุคคล</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เลขประจำตัวผู้เสียภาษี/เลขประจำตัวประชาชน<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="texID" name="texID" value="<?php echo $data->texID ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">ชื่อลูกค้า<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cusName" name="cusName" value="<?php echo $data->cusName ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cusTell" name="cusTell" value="<?php echo $data->cusTell ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">อีเมล์สำหรับติดต่อ<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cusMail" name="cusMail" value="<?php echo $data->cusMail ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">เว็บไซต์ (ถ้าหากมี)</label>
                                            <input type="text" class="form-control" id="cusWeb" name="cusWeb" value="<?php echo $data->cusWeb ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <h5 class="fs-18 fw-bold ">ที่อยู่ลูกค้า</h5>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">รหัสไปรษณีย์<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cusPost" name="cusPost" value="<?php echo $data->cusPost ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">ตำบล/แขวง<span class="text-danger">*</span></label>
                                        <select class="form-control" id="cusTumbol" name="cusTumbol" required>
                                            <?php echo '<option value="' . $data->cusTumbol . '" selected >' . $data->cusTumbol . '</option>'; ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">อำเภอ/เขต<span class="text-danger">*</span></label>
                                        <select class="form-control" id="cusAumper" name="cusAumper" required>
                                            <?php echo '<option value="' . $data->cusAumper . '" selected >' . $data->cusAumper . '</option>'; ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <label for="exampleDataList" class="form-label fs-15 text-dark">จังหวัด <span class="text-danger">*</span></label>
                                        <select class="form-control" id="cusProvince" name="cusProvince" required>
                                            <?php echo '<option value="' . $data->cusProvince . '" selected >' . $data->cusProvince . '</option>'; ?>
                                        </select>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">บ้านเลขที่/หมู่บ้าน/อาคาร<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="cusAddr" name="cusAddr" value="<?php echo $data->cusAddr ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-6">
                                        <div>
                                            <label for="labelInput" class="form-label fs-15 text-dark">พิกัด Google Maps</label>
                                            <input type="text" class="form-control" id="cusGlo" name="cusGlo" value="<?php echo $data->cusGlo ?>" required>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
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
            </form>
        </div>
    </div>
</div>
<!--end row-->

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
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script>
    function simulateButtonClick() {
        document.getElementById('submitBtn').click();
    }
</script>

<script>
    document.getElementById('cusPost').addEventListener('change', function() {
        var postcode = this.value;
        fetch(`option/get_address_data.php?postcode=${postcode}`)
            .then(response => response.json())
            .then(data => {
                var tumbolSelect = document.getElementById('cusTumbol');
                var aumperSelect = document.getElementById('cusAumper');
                var provinceSelect = document.getElementById('cusProvince');

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