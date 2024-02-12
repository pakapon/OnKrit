<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$prjService = new ProjectService($conn);
$data = null;

if (isset($_POST['index'])) {
    $index = $_POST['index'];

    $resultService = $prjService->viewProjectFile($index);
    while ($rowService = $resultService->fetch(PDO::FETCH_ASSOC)) {
        $filePath = $rowService['filePath'];
    }
    
    $file = $prjService->deleteProjectFile($index); // return true ท่าสำเร็จ
    unset($filePath); 

    if ($file) { // ถ้าลบจากฐานข้อมูลสำเร็จ
        if (file_exists($filePath)) {
            unlink($filePath); // ลบไฟล์จากเซิร์ฟเวอร์
        }
        echo "success";
    } else {
        echo "error";
    }
    
}
?>
