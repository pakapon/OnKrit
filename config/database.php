<?php
include "tablelist.php";

if ($is_pro == 1) {
    // Production Environment
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header("HTTP/1.1 200 OK");
        return;
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Googlebot') !== false) {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
    // header("Access-Control-Allow-Origin: * "); // การตั้งค่า CORS ให้อนุญาตทุกๆ Origin ในการเรียกใช้ API ของคุณ
    // header("Content-Type: application/json; charset=UTF-8"); // การตั้งค่า Content-Type สำหรับการตอบกลับให้เป็น JSON
    // header("Content-Type: charset=UTF-8"); // การตั้งค่า Content-Type สำหรับการตอบกลับให้เป็น JSON
    // header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS"); // การตั้งค่า HTTP Methods ที่อนุญาตให้ใช้งานใน CORS
    // header("Access-Control-Max-Age: 60"); // การตั้งค่าสูงสุดเวลาที่ข้อมูล CORS ถูกแคชไว้ (ในวินาที)
    // header('Access-Control-Allow-Credentials: true'); // การอนุญาตให้ส่งข้อมูลการรับรองตัวตน (credentials) ใน CORS
    // header("Access-Control-Allow-Headers: *"); // การอนุญาตให้ส่งหัวข้อ (headers) ใดๆ ใน CORS


    // header('X-Robots-Tag: noindex'); // ป้องกันการทำ index
    date_default_timezone_set('Asia/Bangkok');
    ini_set('log_errors', 'On');
    ini_set('display_errors', 'off');
    ini_set('error_reporting', E_ALL);
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', true);
} else {
    // Development Environment
    // header("Access-Control-Allow-Origin: http://localhost"); // อนุญาตให้เฉพาะ Origin ของ localhost เข้าถึง API ของคุณ
    // header("Content-Type: charset=UTF-8");
    // header("Content-Type: application/json; charset=UTF-8");
    // header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    // header("Access-Control-Max-Age: 60");
    // header("Access-Control-Allow-Credentials: true");
    // header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization"); // ตัวอย่างเฉพาะสำหรับหัวข้อที่คุณต้องการให้ใช้งานใน Development
    date_default_timezone_set('Asia/Bangkok');
    ini_set('log_errors', 'On');
    ini_set('display_errors', 'On'); // เปิดการแสดงข้อผิดพลาดใน Development
    ini_set('error_reporting', E_ALL);
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true); // บันทึกข้อผิดพลาดลงในไฟล์ใน Development
    define('WP_DEBUG_DISPLAY', true);
}
// used to get mysql database connection
class DatabaseService
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_password;
    private $connection;

    public function __construct()
    {
        global $is_pro;
        if ($is_pro == 1) {
            $this->db_host = "127.0.0.1";
            $this->db_name = "onkrit";
            $this->db_user = "root";
            $this->db_password = "moonchildroot";
        } else {
            $this->db_host = "127.0.0.1";
            $this->db_name = "onkrit";
            $this->db_user = "root";
            $this->db_password = "moonchildroot";
        }

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
        } catch (PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }

        return $this->connection;
    }

    public function getConnection()
    {
        if ($this->connection instanceof PDO) {
            return $this->connection;
        }
    }

}
