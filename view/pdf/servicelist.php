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
$data->staus = $_GET['staus'];
$data->start = $_GET['start'];
$data->end = $_GET['end'];
$data->type = $_GET['type'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Service List</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .qr-code {
            width: 50px;
            height: 50px;
        }

        thead th {
            background-color: black;
            color: white;
            text-align: center;
        }

        tbody td {
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr style="background-color: black;">
                <th>เข้าบริการ</th>
                <th>โครงการ</th>
                <th>ลูกค้า</th>
                <th>หัวข้อบริการ</th>
                <th>สถานะ</th>
                <th>MAP QR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $prjService->viewQR($data);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $projectAddr = $row['pojName'] . ' ' . $row['pojAddr'] . ' ' . $row['pojTumbol'] . ' ' . $row['pojAumper'] . ' ' . $row['pojProvince'] . ' ' . $row['pojPost'];

                $result_c = $cusService->viewCustomer($row['pojCus']);
                while ($row_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
                    $cusName = $row_c['cusName'] . " " . $row_c['cusTell'] . " " . $row_c['cusMail'];
                    $cusAddr = $row_c['cusAddr'] . " " . $row_c['cusTumbol'] . " " . $row_c['cusAumper'] . " " . $row_c['cusProvince'] . " " . $row_c['cusPost'];
                }
                $result_c = null;
            ?>
                <tr>
                    <td><?= convertDBFormatToday($row['pojServiceDate']) ?></td>
                    <td><?= $projectAddr ?></td>
                    <td><?= $cusName ?></td>
                    <td><?= $row['pojServiceTopic'] ?></td>
                    <td><?= $row['pojServiceStatus'] ?></td>
                    <td><img src="<?php echo GenQr(trim($row["pojGlo"])); ?>" alt="QR Code"></td>
                </tr>
            <?php
                $s++;
            }
            ?>
        </tbody>
    </table>
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
