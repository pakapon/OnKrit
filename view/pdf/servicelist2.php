<?php
require_once __DIR__ . '/vendor/autoload.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 9,
    'margin_footer' => 9
]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            $result = $prjService->viewProject($_GET['id']);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $projectAddr = $row['pojAddr'] . ' ' . $row['pojTumbol'] . ' ' . $row['pojAumper'] . ' ' . $row['pojProvince'] . ' ' . $row['pojPost'];

                $result_c = $cusService->viewCustomer($row['pojCus']);
                while ($row_c = $result_c->fetch(PDO::FETCH_ASSOC)) {
                    $cusName = $row_c['cusName'] . " " . $row_c['cusTell'] . " " . $row_c['cusMail'];
                    $cusAddr = $row_c['cusAddr'] . " " . $row_c['cusTumbol'] . " " . $row_c['cusAumper'] . " " . $row_c['cusProvince'] . " " . $row_c['cusPost'];
                }
                $result_c = null;

                $sd = explode("|", $row["pojServiceDate"]);
                $st = explode("|", $row["pojServiceTopic"]);
                $sp = explode("|", $row["pojServicePrices"]);
                $pss = explode("|", $row["pojServiceStatus"]);

                $s = 0;
                foreach ($st as $sts) {
            ?>
                    <tr>
                        <td><?= convertDateStToDMY(trim($sd[$s])) ?></td>
                        <td><?= trim($row['pojName']) ?></td>
                        <td><?= trim($projectAddr) ?></td>
                        <td><?= trim($sts) ?></td>
                        <td><?= trim($pss[$s]) ?></td>
                        <td><img src="<?php echo GenQr(trim($row["pojGlo"])); ?>" alt="QR Code"></td>
                    </tr>
            <?php
                    $s++;
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php
$html = ob_get_clean();

// Instantiate Dompdf with our options
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html, 'UTF-8');

// $dompdf->getOptions()->set('defaultFont', 'TH Sarabun New');
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("service-list.pdf", array("Attachment" => false));
?>