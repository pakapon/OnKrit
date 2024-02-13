<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Document.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$docService = new docstoreService($conn);
$data = null;

if (!empty($_POST['dstName'])) {
    $data = new stdClass();
    $data->dstName  = $_POST['dstName'];
    $data->dstNumber  = $_POST['dstNumber'];
    $data->dstProject  = $_POST['dstProject'];
    $data->dstDoclist  = uploadFilesPS($_FILES['dstDoclist']);
    $create = $docService->createDockstore($data);
    $data = NULL;
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
    $create = $docService->deleteCategory($_GET['id']);
?>
    <div class="modal fade bs-example-modal-center show"  style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3"><?php echo $create; ?></h4>
                        <div class="hstack gap-2 justify-content-center mt-2">
                            <a href="index.php?page=dockStore" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
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
                        <h4 class="mb-sm-0">เพิ่มเอกสาร</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"></a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card col-12">
                    <form method="post" action="index.php?page=dockStore" id="myForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-4">
                                        <label for="dstName" class="form-label fs-15 text-dark">ระบุชื่อเอกสาร<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" aria-describedby="button-addon2" placeholder="ชื่อเอกสาร" id="dstName" name="dstName">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        <label for="dstNumber" class="form-label fs-15 text-dark">เลขที่เอกสาร<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" aria-describedby="button-addon2" placeholder="ระบุเลขที่เอกสาร" id="dstNumber" name="dstNumber">
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        <label for="dstProject" class="form-label fs-15 text-dark">ประเภทโครงการ<span class="text-danger">*</span></label>
                                        <select class="form-control" id="dstProject" name="dstProject">
                                            <option value="">- เลือกประเภทเอกสาร</option>
                                            <option value="Technical Bulletin">Technical Bulletin</option>
                                            <option value="Regulation">Regulation</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-xxl-3 col-md-6">
                                            <label for="exampleDataList" class="form-label fs-15 text-dark">เอกสารอัพโหลด</label>
                                            <input class="form-control" type="file"  id="dstDoclist" name="dstDoclist" multiple>
                                        </div>
                                        <div class="input-group mt-5">
                                            <button class="btn btn-outline-success fs-18" type="submit" id="button-addon2">บันทึก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="alternative-pagination" class="table  dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style=" width: 5%;">รายการ</th>
                                                    <th scope="col">ประเภท</th>
                                                    <th scope="col">เลขที่เอกสาร</th>
                                                    <th scope="col">ชื่อเอกสาร</th>
                                                    <th scope="col">ไฟล์</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = $docService->viewDockstore();
                                                $num = $result->rowCount();
                                                if ($num > 0) {
                                                    $i = 0;
                                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                        $i++;
                                                        $dstID = $row["dstID"];
                                                        $fileData = $row["dstDoclist"];
                                                ?>
                                                        <tr>
                                                            <th scope="row"><?= $i ?></th>
                                                            <td><?= $row["dstProject"] ?></td>
                                                            <td><?= $row["dstNumber"] ?></td>
                                                            <td><?= $row["dstName"] ?></td>
                                                            <td>
                                                                <?php
                                                                $file = explode("|", $fileData);
                                                                foreach ($file as $fileData) {
                                                                    echo '<h5 class="fs-13 mb-1"><a href="' . $fileData . '" class=" fs-16" target="_blank">#' . str_replace("../uploads/", "", $fileData) . '<i class="ri-file-download-line text-danger"></i></a></h5>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="mt-2">
                                                                    <a type="button" href="javascript:void(0);" onclick="confirmDelete('<?php echo $dstID; ?>')" class="btn btn-danger btn-label waves-effect waves-light " type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
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

<script>
    function confirmDelete(proID) {
        var confirmAction = confirm("คุณแน่ใจหรือไม่ว่าต้องการลบ?");
        if (confirmAction) {
            // ผู้ใช้ยืนยันการลบ, ดำเนินการต่อไปยัง URL ลบ
            window.location.href = "index.php?page=dockStore&delete=1&id=" + proID;
        } else {
            // ผู้ใช้ยกเลิกการลบ
            // console.log("การลบถูกยกเลิก");
        }
    }
</script>