<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class CuntomerService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createCustomer($data)
    {
        global $table_cu;

        $query = "INSERT INTO `$table_cu`
                    SET
                        `businessType`      = :businessType,
                        `texID`             = :texID,
                        `cusName`           = :cusName,
                        `cusTell`           = :cusTell,
                        `cusMail`           = :cusMail,
                        `cusWeb`            = :cusWeb,
                        `cusPost`           = :cusPost,
                        `cusTumbol`         = :cusTumbol,
                        `cusAumper`         = :cusAumper,
                        `cusProvince`       = :cusProvince,
                        `cusAddr`           = :cusAddr,
                        `cusGlo`            = :cusGlo,
                        `createAt`          = now(),
                        `updateAt`          = now()
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':businessType', $data->businessType);
        $stmt->bindParam(':texID', $data->texID);
        $stmt->bindParam(':cusName', $data->cusName);
        $stmt->bindParam(':cusTell', $data->cusTell);
        $stmt->bindParam(':cusMail', $data->cusMail);
        $stmt->bindParam(':cusWeb', $data->cusWeb);
        $stmt->bindParam(':cusPost', $data->cusPost);
        $stmt->bindParam(':cusTumbol', $data->cusTumbol);
        $stmt->bindParam(':cusAumper', $data->cusAumper);
        $stmt->bindParam(':cusProvince', $data->cusProvince);
        $stmt->bindParam(':cusAddr', $data->cusAddr);
        $stmt->bindParam(':cusGlo', $data->cusGlo);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function updateCustomer($data)
    {
        global $table_cu;

        $query = "UPDATE `$table_cu`
                    SET
                        `businessType`      = :businessType,
                        `texID`             = :texID,
                        `cusName`           = :cusName,
                        `cusTell`           = :cusTell,
                        `cusMail`           = :cusMail,
                        `cusWeb`            = :cusWeb,
                        `cusPost`           = :cusPost,
                        `cusTumbol`         = :cusTumbol,
                        `cusAumper`         = :cusAumper,
                        `cusProvince`       = :cusProvince,
                        `cusAddr`           = :cusAddr,
                        `cusGlo`            = :cusGlo,
                        `updateAt`          = now()
                    WHERE
                        `cusId` = :cusId
        ";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':cusId', $data->cusId);
        $stmt->bindParam(':businessType', $data->businessType);
        $stmt->bindParam(':texID', $data->texID);
        $stmt->bindParam(':cusName', $data->cusName);
        $stmt->bindParam(':cusTell', $data->cusTell);
        $stmt->bindParam(':cusMail', $data->cusMail);
        $stmt->bindParam(':cusWeb', $data->cusWeb);
        $stmt->bindParam(':cusPost', $data->cusPost);
        $stmt->bindParam(':cusTumbol', $data->cusTumbol);
        $stmt->bindParam(':cusAumper', $data->cusAumper);
        $stmt->bindParam(':cusProvince', $data->cusProvince);
        $stmt->bindParam(':cusAddr', $data->cusAddr);
        $stmt->bindParam(':cusGlo', $data->cusGlo);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function viewCustomer($id = null)
    {
        global $table_cu;
        $wid = null;
        if (isset($id)) {
            $wid = "WHERE `cusId` = $id ";
        }

        $query = " SELECT * FROM `$table_cu` $wid ORDER BY `cusId` DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addressList($data = null)
    {
        global $table_add;

        if (isset($data->id)) {
            $id = " AND `p_id` = '$data->id' ";
        }
        if (isset($data->postcode)) {
            $pt = " AND `postcode` = '$data->postcode' ";
        }
        if (isset($data->province)) {
            $po = " AND `province` LIKE '%$data->province%' ";
            $gpo = " ,`province` ";
        }
        if (isset($data->aumper)) {
            $am = " AND `aumper` LIKE '%$data->aumper%' ";
            $gam = " ,`aumper` ";
        }
        if (isset($data->tumbon)) {
            $tm = " AND `tumbon` LIKE '%$data->tumbon%' ";
            $gtm = " ,`province` ";
        }
        $query = "SELECT * FROM `$table_add` WHERE 1=1 $pt $po $am $tm $id GROUP BY `p_id` $gpo $gam $gtm ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
