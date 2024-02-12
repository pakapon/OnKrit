<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
// ob_start();
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>ONKRIT POWER CO., LTD. - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    
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
                        <p class="fw-medium mb-2 fs-15" id="billing-name">Kos Jos</p>
                        <p class="text-dark mb-1 fs-13 fw-semibold" id="billing-address-line-1">
                            Address :ที่อยู่ลูกค้า</p>
                        <p class="text-dark mb-1 fs-13">123 คลองถนน สายไหม กรุงเทพมหานคร 10220</p>
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
                                            <h5 class="fs-13 mb-0">3</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                No. Invoice :<br>เลขที่ใบแจ้งหนี้</p>
                                        </td>
                                        <td class="text-end">
                                            <h5 class="fs-13 mb-0"></h5>
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
                <p class="text-dark text-center text-uppercase mt-3 fs-14">Kos Jos, 3 แผง, 230 KWP, 3 PHASE</p>
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
                                <td class="fs-13 text-end">5 ปี</td>
                            </tr>

                            <tr>
                                <th scope="row">02</th>
                                <td class="text-start">
                                    <span class="fw-medium">เริ่มงานรับประกัน Installation
                                        Month</span>
                                </td>
                                <td class="fs-13 text-end">20 January 2024</td>
                            </tr>

                            <tr>
                                <th scope="row">03</th>
                                <td class="text-start">
                                    <span class="fw-medium">การรับประกันสิ้นสุด Warranty
                                        Expired</span>
                                </td>
                                <td class="fs-13 text-end">20 January 2024</td>
                            </tr>
                                                        <tr>
                                <th scope="row">04</th>
                                <td class="text-start">
                                    <span class="fw-medium">ฟรี
                                        การบำรุงรักษาระบบโซล่าเซลล์</span>
                                </td>
                                <td class="fs-13 text-end">3 ครั้ง</td>
                            </tr>
                                                            <tr>
                                    <th scope="row"></th>
                                    <td class="text-start">
                                    </td>
                                    <td class="fs-13 text-end">ครั้งที่ 1 &nbsp; &nbsp; &nbsp;
                                        &nbsp; 16 February 2024                                    </td>
                                </tr>
                                                            <tr>
                                    <th scope="row"></th>
                                    <td class="text-start">
                                    </td>
                                    <td class="fs-13 text-end">ครั้งที่ 2 &nbsp; &nbsp; &nbsp;
                                        &nbsp; 09 February 2024                                    </td>
                                </tr>
                                                            <tr>
                                    <th scope="row"></th>
                                    <td class="text-start">
                                    </td>
                                    <td class="fs-13 text-end">ครั้งที่ 3 &nbsp; &nbsp; &nbsp;
                                        &nbsp; 01 February 2024                                    </td>
                                </tr>
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
            </div>
            <!--end card-body-->
        </div>
        <!--end col-->
    </div>
</body>

</html>

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