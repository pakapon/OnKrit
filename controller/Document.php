<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class docstoreService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createDockstore($data)
    {
        global $table_st;

        $query = "INSERT INTO `$table_st`
                    SET
                        `dstName`       = :dstName,
                        `dstNumber`     = :dstNumber,
                        `dstProject`    = :dstProject,
                        `dstDoclist`    = :dstDoclist,
                        `dstCreate`     = now()
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':dstName', $data->dstName);
        $stmt->bindParam(':dstNumber', $data->dstNumber);
        $stmt->bindParam(':dstProject', $data->dstProject);
        $stmt->bindParam(':dstDoclist', $data->dstDoclist);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function viewDockstore($id = null)
    {
        global $table_st;
        $wid = null;
        if (isset($id)) {
            $wid = "WHERE `dstID` = $id ";
        }

        $query = " SELECT * FROM `$table_st` $wid ORDER BY `dstID` DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
}