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
                        `pojCus` = :pojCus,
                        `pojStatus` = :pojStatus,
                        `pojDocStatus` = :pojDocStatus,
                        `pojImage` = :pojImage,
                        `pojFile` = :pojFile,
                        `pojPDF` = :pojPDF,
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
                        `pojProductWaranty` = :pojProductWaranty,
                        `pojProductStartWaranty` = :pojProductStartWaranty,
                        `pojProductEndWaranty` = :pojProductEndWaranty,
                        `pojProduct` = :pojProduct,
                        `pojProductQty` = :pojProductQty,

                        `pojListProduct` = :pojListProduct,
                        `pojListLot` = :pojListLot,
                        `pojListSerial` = :pojListSerial,
                        `pojListStartWarranty` = :pojListStartWarranty,
                        `pojListEndWarranty` = :pojListEndWarranty,

                        `pojServiceDate` = :pojServiceDate,
                        `pojServiceTopic` = :pojServiceTopic,
                        `pojServicePrices` = :pojServicePrices,
                        `pojServiceStatus` = :pojServiceStatus,

                        `pojCreate` = now(),
                        `pojUpdate` = now()
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pojCus', $data->pojCus);
        $stmt->bindParam(':pojStatus', $data->pojStatus);
        $stmt->bindParam(':pojDocStatus', $data->pojDocStatus);
        $stmt->bindParam(':pojImage', $data->pojImage);
        $stmt->bindParam(':pojFile', $data->pojFile);
        $stmt->bindParam(':pojPDF', $data->pojPDF);
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
        $stmt->bindParam(':pojProductWaranty', $data->pojProductWaranty);
        $stmt->bindParam(':pojProductStartWaranty', $data->pojProductStartWaranty);
        $stmt->bindParam(':pojProductEndWaranty', $data->pojProductEndWaranty);
        $stmt->bindParam(':pojProduct', $data->pojProduct);
        $stmt->bindParam(':pojProductQty', $data->pojProductQty);

        $stmt->bindParam(':pojListProduct', $data->pojListProduct);
        $stmt->bindParam(':pojListLot', $data->pojListLot);
        $stmt->bindParam(':pojListSerial', $data->pojListSerial);
        $stmt->bindParam(':pojListStartWarranty', $data->pojListStartWarranty);
        $stmt->bindParam(':pojListEndWarranty', $data->pojListEndWarranty);

        $stmt->bindParam(':pojServiceDate', $data->pojServiceDate);
        $stmt->bindParam(':pojServiceTopic', $data->pojServiceTopic);
        $stmt->bindParam(':pojServicePrices', $data->pojServicePrices);
        $stmt->bindParam(':pojServiceStatus', $data->pojServiceStatus);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }
    
    public function editProject($data)
    {
        global $table_pj;

        $query = "UPDATE `$table_pj`
                    SET
                        `pojCus` = :pojCus,
                        `pojStatus` = :pojStatus,
                        `pojDocStatus` = :pojDocStatus,
                        `pojImage` = :pojImage,
                        `pojFile` = :pojFile,
                        `pojPDF` = :pojPDF,
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
                        `pojProductWaranty` = :pojProductWaranty,
                        `pojProductStartWaranty` = :pojProductStartWaranty,
                        `pojProductEndWaranty` = :pojProductEndWaranty,
                        `pojProduct` = :pojProduct,
                        `pojProductQty` = :pojProductQty,

                        `pojListProduct` = :pojListProduct,
                        `pojListLot` = :pojListLot,
                        `pojListSerial` = :pojListSerial,
                        `pojListStartWarranty` = :pojListStartWarranty,
                        `pojListEndWarranty` = :pojListEndWarranty,

                        `pojServiceDate` = :pojServiceDate,
                        `pojServiceTopic` = :pojServiceTopic,
                        `pojServicePrices` = :pojServicePrices,
                        `pojServiceStatus` = :pojServiceStatus,

                        `pojUpdate` = now()
                    WHERE
                        `pojID` = :pojID
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':pojID', $data->pojID);
        $stmt->bindParam(':pojCus', $data->pojCus);
        $stmt->bindParam(':pojStatus', $data->pojStatus);
        $stmt->bindParam(':pojDocStatus', $data->pojDocStatus);
        $stmt->bindParam(':pojImage', $data->pojImage);
        $stmt->bindParam(':pojFile', $data->pojFile);
        $stmt->bindParam(':pojPDF', $data->pojPDF);
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
        $stmt->bindParam(':pojProductWaranty', $data->pojProductWaranty);
        $stmt->bindParam(':pojProductStartWaranty', $data->pojProductStartWaranty);
        $stmt->bindParam(':pojProductEndWaranty', $data->pojProductEndWaranty);
        $stmt->bindParam(':pojProduct', $data->pojProduct);
        $stmt->bindParam(':pojProductQty', $data->pojProductQty);

        $stmt->bindParam(':pojListProduct', $data->pojListProduct);
        $stmt->bindParam(':pojListLot', $data->pojListLot);
        $stmt->bindParam(':pojListSerial', $data->pojListSerial);
        $stmt->bindParam(':pojListStartWarranty', $data->pojListStartWarranty);
        $stmt->bindParam(':pojListEndWarranty', $data->pojListEndWarranty);

        $stmt->bindParam(':pojServiceDate', $data->pojServiceDate);
        $stmt->bindParam(':pojServiceTopic', $data->pojServiceTopic);
        $stmt->bindParam(':pojServicePrices', $data->pojServicePrices);
        $stmt->bindParam(':pojServiceStatus', $data->pojServiceStatus);

        if ($stmt->execute()) {
            return "บันทึกข้อมูลสำเร็จ";
        } else {
            return "บันทึกข้อมูลไม่สำเร็จ";
        }
    }

    public function viewProject($id = null)
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
}