<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class ProjectService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createProject($data)
    {
        global $table_pj;

        $query = "INSERT INTO `$table_pj`
                    SET
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proName`   = :proName,
                        `proCreate` = now(),
                        `proUpdate` = now()
        ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);
        $stmt->bindParam(':proName', $data->proName);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }
}