<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class ProductService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createProduct($data)
    {
        global $table_po;

        $query = "INSERT INTO `$table_po`
                    SET
                        `proName`   = :proName,
                        `proType`   = :proType,
                        `proImage`  = :proImage,
                        `proFile`   = :proFile,
                        `proCreate` = now(),
                        `proUpdate` = now()
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proType', $data->proType);
        $stmt->bindParam(':proImage', $data->proImage);
        $stmt->bindParam(':proFile', $data->proFile);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function editProduct($data)
    {
        global $table_po;

        $query = "UPDATE `$table_po`
                    SET
                        `proName`   = :proName,
                        `proType`   = :proType,
                        `proImage`  = :proImage,
                        `proFile`   = :proFile,
                        `proUpdate` = now()
                    WHERE
                        `proID`     =:proID
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':proID', $data->proID);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proType', $data->proType);
        $stmt->bindParam(':proImage', $data->proImage);
        $stmt->bindParam(':proFile', $data->proFile);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function viewProduct($id = null)
    {
        global $table_po;
        $wid = null;
        if (isset($id)) {
            $wid = "WHERE `proID` = $id ";
        }

        $query = " SELECT * FROM `$table_po` $wid ORDER BY `proID` DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function deleteProduct($data)
    {
        global $table_po;

        $query = "DELETE FROM `$table_po`
                     WHERE
                        `proID` = :proID
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':proID', $data->proID);

        if ($stmt->execute()) {
            return "ลบข้อมูลสำเร็จ";
        } else {
            return "ลบข้อมูลไม่สำเร็จ";
        }
    }

    public function createCategory($data)
    {
        global $table_ct;

        $query = "INSERT INTO `$table_ct`
                    SET
                        `catName`   = :catName,
                        `catCreate` = now()
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':catName', $data->catName);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function deleteCategory($data)
    {
        global $table_ct;

        $query = "DELETE FROM `$table_ct`
                     WHERE
                        `catID` = :catID
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':catID', $data->catID);

        if ($stmt->execute()) {
            return "ลบข้อมูลสำเร็จ";
        } else {
            return "ลบข้อมูลไม่สำเร็จ";
        }
    }

    public function viewCategory($id = null)
    {
        global $table_ct;
        $wid = null;
        if (isset($id)) {
            $wid = "WHERE `catID` = $id ";
        }

        $query = " SELECT * FROM `$table_ct` $wid ORDER BY `catID` DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
