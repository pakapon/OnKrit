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
        global $table_pj, $table_ps, $table_fl;

        $code = strtoupper(uniqid());

        $query = "INSERT INTO `$table_pj`
                    SET
                        `pojCus` = :pojCus,
                        `pojStatus` = :pojStatus,
                        `pojDocStatus` = :pojDocStatus,
                        
                        `pojName` = :pojName,
                        `pojType` = :pojType,
                        `pojCODE` = :pojCODE,
                        `pojVoidID` = :pojVoidID,
                        `pojContractID` = :pojContractID,
                        `pojPost` = :pojPost,
                        `pojTumbol` = :pojTumbol,
                        `pojAumper` = :pojAumper,
                        `pojProvince` = :pojProvince,
                        `pojAddr` = :pojAddr,
                        `pojGlo` = :pojGlo,
                        `pojWarranty` = :pojWarranty,
                        `pojStartWarranty` = :pojStartWarranty,
                        `pojEndWarranty` = :pojEndWarranty,
                        `pojPhase` = :pojPhase,
                        `pojSystem` = :pojSystem,
                        `pojWp` = :pojWp,
                        `pojPhaseQty` = :pojPhaseQty,
                        `pojTotalWatt` = :pojTotalWatt,
                        `pojRemark` = :pojRemark,

                        `pojListProduct` = :pojListProduct,
                        `pojListLot` = :pojListLot,
                        `pojListSerial` = :pojListSerial,
                        `pojListStartWarranty` = :pojListStartWarranty,
                        `pojListEndWarranty` = :pojListEndWarranty,

                        `pojServiceCode` = :pojServiceCode,

                        `pojCreate` = now(),
                        `pojUpdate` = now()
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pojCus', $data->pojCus);
        $stmt->bindParam(':pojStatus', $data->pojStatus);
        $stmt->bindParam(':pojDocStatus', $data->pojDocStatus);
        $stmt->bindParam(':pojName', $data->pojName);
        $stmt->bindParam(':pojType', $data->pojType);
        $stmt->bindParam(':pojCODE', $data->pojCODE);
        $stmt->bindParam(':pojVoidID', $data->pojVoidID);
        $stmt->bindParam(':pojContractID', $data->pojContractID);
        $stmt->bindParam(':pojPost', $data->pojPost);
        $stmt->bindParam(':pojTumbol', $data->pojTumbol);
        $stmt->bindParam(':pojAumper', $data->pojAumper);
        $stmt->bindParam(':pojProvince', $data->pojProvince);
        $stmt->bindParam(':pojAddr', $data->pojAddr);
        $stmt->bindParam(':pojGlo', $data->pojGlo);
        $stmt->bindParam(':pojWarranty', $data->pojWarranty);
        $stmt->bindParam(':pojStartWarranty', $data->pojStartWarranty);
        $stmt->bindParam(':pojEndWarranty', $data->pojEndWarranty);
        $stmt->bindParam(':pojPhase', $data->pojPhase);
        $stmt->bindParam(':pojSystem', $data->pojSystem);
        $stmt->bindParam(':pojWp', $data->pojWp);
        $stmt->bindParam(':pojPhaseQty', $data->pojPhaseQty);
        $stmt->bindParam(':pojTotalWatt', $data->pojTotalWatt);
        $stmt->bindParam(':pojRemark', $data->pojRemark);


        // `pojProductWaranty` = :pojProductWaranty,
        // `pojProductStartWaranty` = :pojProductStartWaranty,
        // `pojProductEndWaranty` = :pojProductEndWaranty,
        // `pojProduct` = :pojProduct,
        // `pojProductQty` = :pojProductQty,
        // $stmt->bindParam(':pojProductWaranty', $data->pojProductWaranty);
        // $stmt->bindParam(':pojProductStartWaranty', $data->pojProductStartWaranty);
        // $stmt->bindParam(':pojProductEndWaranty', $data->pojProductEndWaranty);
        // $stmt->bindParam(':pojProduct', $data->pojProduct);
        // $stmt->bindParam(':pojProductQty', $data->pojProductQty);

        $stmt->bindParam(':pojListProduct', $data->pojListProduct);
        $stmt->bindParam(':pojListLot', $data->pojListLot);
        $stmt->bindParam(':pojListSerial', $data->pojListSerial);
        $stmt->bindParam(':pojListStartWarranty', $data->pojListStartWarranty);
        $stmt->bindParam(':pojListEndWarranty', $data->pojListEndWarranty);

        $stmt->bindParam(':pojServiceCode', $code);
        $stmt->execute();
        $stmt = null;

        $datax = explode('|',$data->pojImage);
        foreach($datax as $pojImage){
            $query = "INSERT INTO `$table_fl` 
                        SET `fileCode` = :pojServiceCode,
                            `fileType` = 'pojImage',
                            `filePath` = :part,
                            `fileCreate` = now()
                        ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pojServiceCode', $code);
            $stmt->bindParam(':part', $pojImage);
            $stmt->execute();
            $stmt = null;
        }

        $datax = explode('|',$data->pojFile);
        foreach($datax as $pojFile){
            $query = "INSERT INTO `$table_fl` 
                        SET `fileCode` = :pojServiceCode,
                            `fileType` = 'pojFile',
                            `filePath` = :part,
                            `fileCreate` = now()
                        ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pojServiceCode', $code);
            $stmt->bindParam(':part', $pojFile);
            $stmt->execute();
            $stmt = null;
        }

        $datax = explode('|',$data->pojPDF);
        foreach($datax as $pojPDF){
            $query = "INSERT INTO `$table_fl` 
                        SET `fileCode` = :pojServiceCode,
                            `fileType` = 'pojPDF',
                            `filePath` = :part,
                            `fileCreate` = now()
                        ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pojServiceCode', $code);
            $stmt->bindParam(':part', $pojPDF);
            $stmt->execute();
            $stmt = null;
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

        $i = 0;
        foreach ($data->pojServiceTopic as $topic) {
            $date = convertDateToDBFormat($data->pojServiceDate[$i]);
            
            $query = " INSERT INTO `$table_ps`
                            SET
                                `pojServiceCode` = :pojServiceCode,
                                `pojServiceDate` = :pojServiceDate,
                                `pojServiceTopic` = :pojServiceTopic,
                                `pojServicePrices` = :pojServicePrices,
                                `pojServiceStatus` = :pojServiceStatus
            ";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':pojServiceCode', $code);
            $stmt->bindParam(':pojServiceDate', $date);
            $stmt->bindParam(':pojServiceTopic', $topic);
            $stmt->bindParam(':pojServicePrices', $data->pojServicePrices[$i]);
            $stmt->bindParam(':pojServiceStatus', $data->pojServiceStatus[$i]);
            $stmt->execute();
            $stmt = null;
            $i++;
        }

        return "บันทึกข้อมูลสำเร็จ";
    }

    public function editProject($data)
    {
        global $table_pj, $table_ps, $table_fl;


        $query = "UPDATE `$table_pj`
                    SET
                        `pojCus` = :pojCus,
                        `pojStatus` = :pojStatus,
                        `pojDocStatus` = :pojDocStatus,
                        `pojName` = :pojName,
                        `pojType` = :pojType,
                        `pojCODE` = :pojCODE,
                        `pojVoidID` = :pojVoidID,
                        `pojContractID` = :pojContractID,
                        `pojPost` = :pojPost,
                        `pojTumbol` = :pojTumbol,
                        `pojAumper` = :pojAumper,
                        `pojProvince` = :pojProvince,
                        `pojAddr` = :pojAddr,
                        `pojGlo` = :pojGlo,
                        `pojWarranty` = :pojWarranty,
                        `pojStartWarranty` = :pojStartWarranty,
                        `pojEndWarranty` = :pojEndWarranty,
                        `pojPhase` = :pojPhase,
                        `pojSystem` = :pojSystem,
                        `pojWp` = :pojWp,
                        `pojPhaseQty` = :pojPhaseQty,
                        `pojTotalWatt` = :pojTotalWatt,
                        `pojRemark` = :pojRemark,

                        `pojListProduct` = :pojListProduct,
                        `pojListLot` = :pojListLot,
                        `pojListSerial` = :pojListSerial,
                        `pojListStartWarranty` = :pojListStartWarranty,
                        `pojListEndWarranty` = :pojListEndWarranty,

                        `pojUpdate` = now()
                    WHERE
                        `pojID` = :pojID
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pojID', $data->pojID);
        $stmt->bindParam(':pojCus', $data->pojCus);
        $stmt->bindParam(':pojStatus', $data->pojStatus);
        $stmt->bindParam(':pojDocStatus', $data->pojDocStatus);
        $stmt->bindParam(':pojName', $data->pojName);
        $stmt->bindParam(':pojType', $data->pojType);
        $stmt->bindParam(':pojCODE', $data->pojCODE);
        $stmt->bindParam(':pojVoidID', $data->pojVoidID);
        $stmt->bindParam(':pojContractID', $data->pojContractID);
        $stmt->bindParam(':pojPost', $data->pojPost);
        $stmt->bindParam(':pojTumbol', $data->pojTumbol);
        $stmt->bindParam(':pojAumper', $data->pojAumper);
        $stmt->bindParam(':pojProvince', $data->pojProvince);
        $stmt->bindParam(':pojAddr', $data->pojAddr);
        $stmt->bindParam(':pojGlo', $data->pojGlo);
        $stmt->bindParam(':pojWarranty', $data->pojWarranty);
        $stmt->bindParam(':pojStartWarranty', $data->pojStartWarranty);
        $stmt->bindParam(':pojEndWarranty', $data->pojEndWarranty);
        $stmt->bindParam(':pojPhase', $data->pojPhase);
        $stmt->bindParam(':pojSystem', $data->pojSystem);
        $stmt->bindParam(':pojWp', $data->pojWp);
        $stmt->bindParam(':pojPhaseQty', $data->pojPhaseQty);
        $stmt->bindParam(':pojTotalWatt', $data->pojTotalWatt);
        $stmt->bindParam(':pojRemark', $data->pojRemark);

        // `pojProductWaranty` = :pojProductWaranty,
        // `pojProductStartWaranty` = :pojProductStartWaranty,
        // `pojProductEndWaranty` = :pojProductEndWaranty,
        // `pojProduct` = :pojProduct,
        // `pojProductQty` = :pojProductQty,
        // $stmt->bindParam(':pojProductWaranty', $data->pojProductWaranty);
        // $stmt->bindParam(':pojProductStartWaranty', $data->pojProductStartWaranty);
        // $stmt->bindParam(':pojProductEndWaranty', $data->pojProductEndWaranty);
        // $stmt->bindParam(':pojProduct', $data->pojProduct);
        // $stmt->bindParam(':pojProductQty', $data->pojProductQty);

        $stmt->bindParam(':pojListProduct', $data->pojListProduct);
        $stmt->bindParam(':pojListLot', $data->pojListLot);
        $stmt->bindParam(':pojListSerial', $data->pojListSerial);
        $stmt->bindParam(':pojListStartWarranty', $data->pojListStartWarranty);
        $stmt->bindParam(':pojListEndWarranty', $data->pojListEndWarranty);

        $stmt->execute();
        $stmt = null;

        if(!empty($data->pojImage)){
            $datax = explode('|',$data->pojImage);
            foreach($datax as $pojImage){
                $query = "INSERT INTO `$table_fl` 
                            SET `fileCode` = :pojServiceCode,
                                `fileType` = 'pojImage',
                                `filePath` = :part,
                                `fileCreate` = now()
                            ";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':pojServiceCode', $data->pojServiceCode);
                $stmt->bindParam(':part', $pojImage);
                $stmt->execute();
                $stmt = null;
            }
        }
        if(!empty($data->pojFile)){
            $datax = explode('|',$data->pojFile);
            foreach($datax as $pojFile){
                $query = "INSERT INTO `$table_fl` 
                            SET `fileCode` = :pojServiceCode,
                                `fileType` = 'pojFile',
                                `filePath` = :part,
                                `fileCreate` = now()
                            ";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':pojServiceCode', $data->pojServiceCode);
                $stmt->bindParam(':part', $pojFile);
                $stmt->execute();
                $stmt = null;
            }
        }
        if(!empty($data->pojPDF)){
            $datax = explode('|',$data->pojPDF);
            foreach($datax as $pojPDF){
                $query = "INSERT INTO `$table_fl` 
                            SET `fileCode` = :pojServiceCode,
                                `fileType` = 'pojPDF',
                                `filePath` = :part,
                                `fileCreate` = now()
                            ";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':pojServiceCode', $data->pojServiceCode);
                $stmt->bindParam(':part', $pojPDF);
                $stmt->execute();
                $stmt = null;
            }
        }

        include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

        $query2 = "DELETE FROM `$table_ps` WHERE `pojServiceCode` = :pojServiceCode";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':pojServiceCode', $data->pojServiceCode);
        $stmt2->execute();
        $stmt2 = null;

        $i = 0;
        foreach ($data->pojServiceTopic as $topic) {
            $date = convertDateToDBFormat($data->pojServiceDate[$i]);
            $query3 = " INSERT INTO `$table_ps`
                            SET
                                `pojServiceCode` = :pojServiceCode,
                                `pojServiceDate` = :pojServiceDate,
                                `pojServiceTopic` = :pojServiceTopic,
                                `pojServicePrices` = :pojServicePrices,
                                `pojServiceStatus` = :pojServiceStatus
            ";

            $stmt3 = $this->conn->prepare($query3);
            $stmt3->bindParam(':pojServiceCode', $data->pojServiceCode);
            $stmt3->bindParam(':pojServiceDate', $date);
            $stmt3->bindParam(':pojServiceTopic', $topic);
            $stmt3->bindParam(':pojServicePrices', $data->pojServicePrices[$i]);
            $stmt3->bindParam(':pojServiceStatus', $data->pojServiceStatus[$i]);
            $stmt3->execute();
            $stmt3 = null;
            $i++;
        }

        return "บันทึกข้อมูลสำเร็จ";
    }

    public function viewProject($id = null, $data = null)
    {
        global $table_pj;
        $wid = null;
        if (isset($id)) {
            $wid = "WHERE `pojID` = $id ";
        }

        $query = " SELECT * FROM `$table_pj` $wid ORDER BY `pojID` DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function viewProjectService($id = null)
    {
        global $table_ps;

        $wid = "WHERE `pojServiceCode` = '$id' ";

        $query = " SELECT * FROM `$table_ps` $wid ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function viewProjectFile($code=null,$type=null,$id =null)
    {
        global $table_fl;
if(empty($id)){
    $wid = "WHERE `fileCode` = '$code' AND `fileType` = '$type' ;";
}else{
    $wid = "WHERE `fileID` = '$id' ;";
}

        $query = " SELECT * FROM `$table_fl` $wid ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function deleteProjectFile($id)
    {
        global $table_fl;
        
        $query = "DELETE FROM `$table_fl` WHERE `fileID` = :fileID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fileID', $id);
        $stmt->execute();
        $stmt = null;

        return true;
    }
    

    public function viewQR($data = null, $g = null)
    {
        global $table_ps, $table_pj;

        if ($g == 1) {
            $group = " GROUP BY `pojID` ";
        }

        $where = " WHERE 1=1 ";
        if ($data->id) {
            $where .= " AND `pojID` = '$data->id' ";
        }
        if ($data->staus) {
            $where .= " AND `pojServiceStatus` = '$data->staus' ";
        }
        if ($data->start) {
            $where .= " AND `pojServiceDate` BETWEEN '$data->start' AND '$data->end'";
        }
        if ($data->type == 1) {
            $where .= " AND `pojWp` IS NOT NULL ";
        } elseif ($data->type == 2) {
            $where .= " AND `pojWp` IS NULL ";
        }

        $query = " SELECT * FROM `$table_ps` a LEFT JOIN `$table_pj` b ON a.pojServiceCode = b.pojServiceCode
                        $where $group ORDER BY `posID` DESC";
        // echo $query;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countProject()
    {
        global $table_pj;

        $query = " SELECT COUNT(1) AS counters FROM `$table_pj`  ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['counters'];
    }

    public function countService()
    {
        global $table_ps;

        $query = " SELECT COUNT(1) AS counters FROM `$table_ps`  ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['counters'];
    }
}
