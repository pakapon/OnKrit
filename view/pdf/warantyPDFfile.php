<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);

$data = null;

$data = new stdClass;
$data->id = $_GET['id'];

$result = $prjService->viewQR($data, 1);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $projectAddr = $row['pojName'] . ' ' . $row['pojAddr'] . ' ' . $row['pojTumbol'] . ' ' . $row['pojAumper'] . ' ' . $row['pojProvince'] . ' ' . $row['pojPost'];


    $result_c = $cusService->viewCustomer($row['pojCus']);
    while ($row_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
        $cusName = $row_c['cusName'];
        $cusNameDT = $row_c['cusName'] . " " . $row_c['cusTell'] . " " . $row_c['cusMail'];
        $cusAddr = $row_c['cusAddr'] . " " . $row_c['cusTumbol'] . " " . $row_c['cusAumper'] . " " . $row_c['cusProvince'] . " " . $row_c['cusPost'];
    }
    $result_c = null;

    $pojCODE = $row['pojCODE'];
    $pojVoidID = $row['pojVoidID'];
    $pojPhaseQty = $row['pojPhaseQty'];
    $pojTotalWatt = $row['pojTotalWatt'];
    $pojPhase = $row['pojPhase'];
    $headerS = $cusName . ", " . $pojPhaseQty . " แผง, " . number_format($pojTotalWatt, 0) . " KWP, " . $pojPhase . " PHASE";
    $pojWarranty = $row['pojWarranty'];
    $pojStartWarranty = convertDBFormatToFulldate($row['pojStartWarranty']);
    $pojEndWarranty = convertDBFormatToFulldate($row['pojEndWarranty']);
}
$result = null;

?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>ONKRIT POWER CO., LTD. - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Layout config Js -->
    <script src="../assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("../../fonts/THSarabunNew.ttf") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <div class=" p-2">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <img src="../assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="70">
                        <img src="../assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="70">

                    </div>
                    <div class="flex-shrink-0 mt-sm-0 mt-1">
                        <h6 class="text-dark fw-normal fs-16">บริษัท ออนกฤษ พาวเวอร์ จำกัด
                            (สำนักงานใหญ่)</span></h6>
                        <h7 class="text-dark fw-normal fs-12">ONKRIT POWER Co., LTD.</h7>
                        <p class="fs-11">8/88 หมู่ 3 ตำบลบางเดื่อ อำเภอเมืองปทุมธานี
                            จังหวัดปทุมธานี 12000</p>
                    </div>
                </div>
            </div>
            <!--end card-header-->
        </div>
        <!--end col-->
        <div class="col-lg-12">
            <div>
                <div class="alert alert-dark text-center">
                    <p class="mb-0 fs-16 fw-semibold text-dark">ใบรับประกัน (Certificate of
                        Warranty)
                    </p>
                </div>
                <p class="text-dark text-center text-uppercase mt-3 fs-10">บริษัท ออนกฤษ
                    พาวเวอร์ จำกัด (สำนักงานใหญ่) ยืนยันการรับประกันระบบโซลาร์เซลล์ตามรายละเอียด
                    ดังต่อไปนี้
                    <br>ONKRIT POWER Co., LTD. guarantee the warranty of solar cell system with
                    the detail as per followed
                </p>
            </div>

        </div>
        <!--end col-->
        <div class="col-lg-12">
            <div class="card-body p-2 ">
                <div class="row g-3">
                    <div class="col-6">
                        <h6 class="text-dark  fw-semibold">Customer Name : ชื่อลูกค้า</h6>
                        <p class="fw-medium mb-2 fs-15" id="billing-name"><?= $cusName ?></p>
                        <p class="text-dark mb-1 fs-13 fw-semibold" id="billing-address-line-1">
                            Address :ที่อยู่ลูกค้า</p>
                        <p class="text-dark mb-1 fs-13"><?= $cusAddr ?></p>
                    </div>
                    <!--end col-->
                    <div class="col-6">
                        <div class=" mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                No. Job :<br>เลขที่โครงการ
                                            </p>
                                        </td>
                                        <td class="text-end">
                                            <h5 class="fs-13 mb-0"><?= $pojCODE ?></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                No. Invoice :<br>เลขที่ใบแจ้งหนี้</p>
                                        </td>
                                        <td class="text-end">
                                            <h5 class="fs-13 mb-0"><?= $pojVoidID ?></h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end card-body-->
        </div>
        <!--end col-->

        <div class="col-lg-12">
            <div>
                <div class="alert alert-dark text-center">
                    <p class="mb-0 fs-16 fw-semibold text-dark">รายละเอียดงานและส่งมอบงาน
                        (Detail of the work and Deliver)</p>
                </div>
                <p class="text-dark text-center text-uppercase mt-3 fs-14"><?= $headerS ?></p>
            </div>

        </div>
        <!--end col-->


        <div class="col-lg-12">
            <div class="alert alert-dark text-center">
                <p class="mb-0 fs-16 fw-semibold text-dark">งานรับประกัน (Warranty Work)</p>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">

                        <tbody id="products-list">
                            <tr>
                                <th scope="row">01</th>
                                <td class="text-start">
                                    <span class="fw-medium  ">รับประกันงานติดตั้งระบบโซล่าเซลล์
                                    </span>
                                </td>
                                <td class="fs-13 text-end"><?= $pojWarranty ?> ปี</td>
                            </tr>

                            <tr>
                                <th scope="row">02</th>
                                <td class="text-start">
                                    <span class="fw-medium">เริ่มงานรับประกัน Installation
                                        Month</span>
                                </td>
                                <td class="fs-13 text-end"><?= $pojStartWarranty ?></td>
                            </tr>

                            <tr>
                                <th scope="row">03</th>
                                <td class="text-start">
                                    <span class="fw-medium">การรับประกันสิ้นสุด Warranty
                                        Expired</span>
                                </td>
                                <td class="fs-13 text-end"><?= $pojEndWarranty ?></td>
                            </tr>
                            <?php
                            $result = $prjService->viewQR($data);
                            $counter = $result->rowCount();
                            ?>
                            <tr>
                                <th scope="row">04</th>
                                <td class="text-start">
                                    <span class="fw-medium">ฟรี
                                        การบำรุงรักษาระบบโซล่าเซลล์</span>
                                </td>
                                <td class="fs-13 text-end"><?= $counter ?> ครั้ง</td>
                            </tr>
                            <?php
                            if ($counter > 0) {
                                $n = 1;
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="text-start">
                                        </td>
                                        <td class="fs-13 text-end">ครั้งที่ <?= $n ?></td>
                                        <td class="fs-13 text-end" min-width="200px">>
                                            <?= convertDBFormatToFulldate($row['pojServiceDate']) ?>
                                        </td>
                                    </tr>
                            <?php
                                    $n++;
                                }
                            }
                            ?>
                            <tr>
                                <th scope="row">05</th>
                                <td class="text-start">
                                    <span class="fw-medium">การรับประกันสินค้า</span>
                                </td>
                                <td class="fs-13 text-end"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td class="text-start">
                                    <span class="fw-medium">- แผงโซล่าเซลล์ (Warranty for
                                        Materials)</span>
                                </td>
                                <td class="fs-13 text-end">______ ปี</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td class="text-start">
                                    <span class="fw-medium">- แผงโซล่าเซลล์ (Warranty for Linear
                                        Power Output)</span>
                                </td>
                                <td class="fs-13 text-end">______ ปี</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td class="text-start">
                                    <span class="fw-medium">- Inverter รับประกัน</span>
                                </td>
                                <td class="fs-13 text-end">______ ปี</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td class="text-start">
                                    <span>- ________________________________</span>
                                </td>
                                <td class="fs-13 text-end">______ ปี</td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class="mt-4">
                    <p class="text-center text-danger">** หมายเหตุ การรับประกันอุปกรณ์อ้างอิง
                        Serial Number
                    </p>
                </div>
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-6 text-center">
                                <p class="text-dark mb-3">________________________</p>
                                <p class="text-dark mb-3 ">(________________________)</p>
                                <p class="text-dark mb-3 " id="billing-address-line-1">
                                    ลูกค้าลงนาม</p>
                                <p class="text-dark mb-3 ">ลงวันที่:_________________________
                                </p>
                            </div>
                            <!--end col-->
                            <div class="col-6 text-center">
                                <p class="text-dark mb-3">________________________</p>
                                <p class="text-dark mb-3 ">(________________________)</p>
                                <p class="text-dark mb-3 " id="billing-address-line-1">
                                    บริษัทลงนาม</p>
                                <p class="text-dark ">ลงวันที่:_________________________</p>
                                <p class="text-dark ">บริษัท ออนกฤษ พาวเวอร์ จำกัด
                                    (สำนักงานใหญ่)</p>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                    <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end col-->
    </div>
</body>

</html>
<!-- end main content-->
<?php
$html = ob_get_clean();

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        $_SERVER['DOCUMENT_ROOT']  . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf',
        ],
    ],
    'default_font' => 'sarabun'
]);

$mpdf->WriteHTML($html);

$mpdf->Output('service_list.pdf', 'I'); // 'I' for inline, 'D' for download, 'F' for saving to a file
?>

<!-- JAVASCRIPT -->
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../assets/libs/node-waves/waves.min.js"></script>
<script src="../assets/libs/feather-icons/feather.min.js"></script>
<script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="../assets/js/plugins.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="../assets/js/pages/datatables.init.js"></script>
<!-- App js -->
<script src="../assets/js/app.js"></script>