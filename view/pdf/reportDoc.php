<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);

$data = null;
$data = new stdClass;

$data->staus = $_POST["staus"];
$data->start = convertDateToDBFormat($_POST["start"]);
$data->end = convertDateToDBFormat($_POST["end"]);
$data->type = $_POST["type"];

?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">รายงานการบริการ</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"></a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <form method="post" action="index.php?page=report" id="myForm">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-8">
                            <label for="exampleDataList" class="form-label fs-15 text-dark">สถานะ</label>
                            <select class="form-control" aria-label="Default select example" name="staus">
                                <option value="">-เลือกสถานะ-</option>
                                <option value="รอดำเนินการ"
                                    <?php if ($data->staus == 'รอดำเนินการ') echo "selected"; ?>>รอดำเนินการ</option>
                                <option value="ดำเนินการเสร็จสิ้น"
                                    <?php if ($data->staus == 'ดำเนินการเสร็จสิ้น') echo "selected"; ?>>
                                    ดำเนินการเสร็จสิ้น</option>
                                <option value="ยกเลิก" <?php if ($data->staus == 'ยกเลิก') echo "selected"; ?>>ยกเลิก
                                </option>
                            </select>
                        </div>
                        <div class="col-xxl-3 col-md-4 ">
                            <label for="labelInput" class="form-label fs-15 text-dark">วันที่เข้าบริการ</label>
                            <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"
                                data-date-format="d M, Y" readonly="readonly" name="start" value="<?= $data->start ?>">
                        </div>
                        <div class="col-xxl-3 col-md-4 ">
                            <label for="labelInput" class="form-label fs-15 text-dark">ถึงวันที่เข้าบริการ</label>
                            <input type="text" class="form-control flatpickr-input" data-provider="flatpickr"
                                data-date-format="d M, Y" readonly="readonly" name="end" value="<?= $data->end ?>">
                        </div>
                        <div class="col-xxl-3 col-md-4 ">
                            <label for="labelInput" class="form-label fs-15 text-dark">ประเภท</label>
                            <div class="mt-4 mt-lg-0">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox6" name="type"
                                        value="1"
                                        <?php if ($data->type == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="form-check-label fs-16 fw-medium"
                                        for="inlineCheckbox6">โซล่าร์</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox7" name="type"
                                        value="2"
                                        <?php if ($data->type == 2) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="form-check-label fs-16 fw-medium"
                                        for="inlineCheckbox7">อีวีชาร์จ</label>
                                </div>
                            </div>
                        </div>
                        </di>
                        <div class="row mt-3">
                            <div class="col-sm-4 align-self-start">
                                <button class="btn btn-success waves-effect waves-light fs-18"
                                    type="submit">ค้นหาแบบเจาะจง</button>
                            </div>
                            <div class="col-sm-4 align-self-center">
                            </div>
                            <div class="col-sm-4 align-self-end text-right" style="text-align-last: right !important;">
                                <a class="btn btn-primary waves-effect waves-light" href="./pdf/servicelist.php?staus=<?= $data->staus ?>&start=<?= $data->start ?>&end=<?= $data->end ?>&type=<?= $data->type ?>" role="button">Download PDF
                                    File</a>
                            </div>
                        </div>
                </form>
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <table id="alternative-pagination"
                                class="table  dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ชื่อโครงการ</th>
                                        <th>ประเภท</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>อีเมลติดต่อกลับ</th>
                                        <th>ที่อยู่</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $prjService->viewQR($data, 1);
                                    $num = $result->rowCount();
                                    if ($num > 0) {
                                        $i = 0;
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            $i++;
                                            $pojID = $row["pojID"];
                                            $pojName = $row["pojName"];
                                            $pojCODE = $row["pojCODE"];
                                            $pojStartWarranty = $row["pojStartWarranty"];
                                            $pojEndWarranty = $row["pojEndWarranty"];

                                            $pojStatus = getStatusButton($row["pojStatus"]);
                                            $pojDocStatus = getStatusButton($row["pojDocStatus"]);

                                            if (!empty($row['pojWp'])) {
                                                $pojType = "โซล่าร์";
                                            } else {
                                                $pojType = "อีวีชาร์จ";
                                            }

                                            $result_c = $cusService->viewCustomer($row['pojCus']);
                                            while ($row_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
                                                $cusName = $row_c['cusName'];
                                                $cusTell = $row_c['cusTell'];
                                                $cusMail = $row_c['cusMail'];
                                                $cusAddr = $row_c['cusAddr'] . " " . $row_c['cusTumbol'] . " " . $row_c['cusAumper'] . " " . $row_c['cusProvince'] . " " . $row_c['cusPost'];
                                            }
                                            $result_c = null;

                                    ?>

                                    <tr>
                                        <td><?= $pojCODE ?></td>
                                        <td><?= $pojName ?></td>
                                        <td><?= $cusName ?></td>
                                        <td><?= $cusTell ?></td>
                                        <td><?= $cusMail ?></td>
                                        <td><?= $cusAddr ?></td>
                                        <td>
                                            <?= $pojStatus ?>
                                        </td>
                                        <td>
                                            <a type="button"
                                                href="./pdf/servicelist.php?id=<?= $pojID ?>&staus=<?= $data->staus ?>&start=<?= $data->start ?>&end=<?= $data->end ?>&type=<?= $data->type ?>"
                                                target=”_blank”
                                                class="btn btn-primary btn-label waves-effect waves-light"><i
                                                    class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i>
                                                รายละเอียด</a>
                                        </td>
                                    </tr>
                                    <?php
                                            $i++;
                                        }
                                        $result = null;
                                    } else {
                                    } ?>

                                    <!-- <tr>
                                        <td>โครงการขี้เหล็ก</td>
                                        <td>อีวีชาร์จ</td>
                                        <td>คุณพงษ์นรินทร์ ชมชื่น</td>
                                        <td>0625359797</td>
                                        <td>mustanzaa@hotmail.com</td>
                                        <td>143 หมู่ 2 ตำบลหนองโรง อำเภอพนมทวน จังหวัดกาญจนบุรี 71140</td>
                                        <td>
                                            <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-center1">ดำเนินการ</button>
                                        </td>
                                        <td>
                                            <a type="button"
                                                href="file:///D:/%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%94%E0%B8%B9%E0%B9%81%E0%B8%A5%E0%B9%80%E0%B8%9E%E0%B8%88-%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A/%E0%B8%88%E0%B8%B9%E0%B8%99/%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%88%E0%B8%B9%E0%B8%99%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%82%E0%B8%B2%E0%B8%A2/%E0%B9%80%E0%B8%AD%E0%B8%81%E0%B8%AA%E0%B8%B2%E0%B8%A3%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%81%E0%B8%B1%E0%B8%99/service-list1.pdf"
                                                class="btn btn-primary btn-label waves-effect waves-light"><i
                                                    class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i>
                                                ดาวน์โหลด</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>โครงการบ้านช่อง</td>
                                        <td>อีวีชาร์จ</td>
                                        <td>บริษัท เฮงเฟงไท เทรดดิ้ง จำกัด</td>
                                        <td>0949472928</td>
                                        <td>moonoilinlin@gmail.com</td>
                                        <td>44/97 หมู่ 10 ตำบลคลองสอง อำเภอคลองหลวง จังหวัดปทุมธานี 12120</td>
                                        <td>
                                            <button type="button" class="btn btn-success " data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-center1">เสร็จสิ้น</button>
                                        </td>
                                        <td>
                                            <a type="button"
                                                href="file:///D:/%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%94%E0%B8%B9%E0%B9%81%E0%B8%A5%E0%B9%80%E0%B8%9E%E0%B8%88-%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A/%E0%B8%88%E0%B8%B9%E0%B8%99/%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%88%E0%B8%B9%E0%B8%99%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%82%E0%B8%B2%E0%B8%A2/%E0%B9%80%E0%B8%AD%E0%B8%81%E0%B8%AA%E0%B8%B2%E0%B8%A3%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%81%E0%B8%B1%E0%B8%99/service-list1.pdf"
                                                class="btn btn-primary btn-label waves-effect waves-light"><i
                                                    class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i>
                                                ดาวน์โหลด</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>โครงการบ้านช่อง</td>
                                        <td>โซล่าร์</td>
                                        <td>บริษัท เฮงเฟงไท เทรดดิ้ง จำกัด</td>
                                        <td>0949472928</td>
                                        <td>moonoilinlin@gmail.com</td>
                                        <td>44/97 หมู่ 10 ตำบลคลองสอง อำเภอคลองหลวง จังหวัดปทุมธานี 12120</td>
                                        <td>
                                            <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-center1">ยกเลิก</button>
                                        </td>
                                        <td>
                                            <a type="button"
                                                href="file:///D:/%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%94%E0%B8%B9%E0%B9%81%E0%B8%A5%E0%B9%80%E0%B8%9E%E0%B8%88-%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A/%E0%B8%88%E0%B8%B9%E0%B8%99/%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B8%88%E0%B8%B9%E0%B8%99%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%82%E0%B8%B2%E0%B8%A2/%E0%B9%80%E0%B8%AD%E0%B8%81%E0%B8%AA%E0%B8%B2%E0%B8%A3%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%81%E0%B8%B1%E0%B8%99/service-list1.pdf"
                                                class="btn btn-primary btn-label waves-effect waves-light"><i
                                                    class="ri-file-edit-line label-icon align-middle fs-16 me-2"></i>
                                                ดาวน์โหลด</a>
                                        </td>
                                    </tr> -->


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->


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