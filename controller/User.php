<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class UserService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createUser($ocppTag, $data)
    {
        global $table_ur;

        $query = "INSERT INTO `" . $table_ur . "`
            SET
                `u_code`        = :u_code,
                `u_tell`        = :u_tell,
                `u_mail`        = :u_mail,
                `u_password`    = :u_password,
                `u_name`        = :u_name,
                `u_lastname`    = :u_lastname,
                `u_create`      = now()
        ";
        $stmt = $this->conn->prepare($query);

        $password_hash = password_hash($data->passWord, PASSWORD_BCRYPT);

        $code = strtoupper(uniqid());
        $stmt->bindParam(':u_code', $code);
        $stmt->bindParam(':u_tell', $data->tell);
        $stmt->bindParam(':u_mail', $data->mail);
        $stmt->bindParam(':u_password', $password_hash);
        $stmt->bindParam(':u_name', $data->name);
        $stmt->bindParam(':u_lastname', $data->last);

        $stmt->execute() or die(json_encode(
            array(
                "message"   => "execute not success.",
                "error"     => $stmt->errorInfo()
            ),
            http_response_code(400)
        ));
    }

    public function viewUser($world_id)
    {
        global $table_m_user, $table_add, $world_point;

        $query = " SELECT * FROM `" . $table_m_user . "` a LEFT JOIN `" . $table_add . "` b ON a.u_address_id = b.p_id WHERE u_id = :world_id ";

        $stmt = $this->conn->prepare($query);

        // Binding parameters
        $stmt->bindParam(':world_id', $world_id);

        $stmt->execute() or die(json_encode(
            array(
                "message"   => "execute not success.",
                "error"     => $stmt->errorInfo()
            ),
            http_response_code(400)
        ));

        $num = $stmt->rowCount();

        $userData = array();

        if ($num > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userData[] = array(
                    "name"              => $row['u_name'] . " " . $row['u_lastname'],
                    "userTag"           => $row['u_ocpp_tagid'],
                    "fist_name"         => $row['u_name'],
                    "last_name"         => $row['u_lastname'],
                    "email"             => $row['u_email'],
                    "tel"               => $row['u_tell'],
                    "sex"               => $row['u_sex'],
                    "address"           => $row['u_address'],
                    "u_address_id"      => $row['u_address_id'],
                    "postcode"          => $row['postcode'],
                    "tumbon"            => $row['tumbon'],
                    "aumper"            => $row['aumper'],
                    "province"          => $row['province'],
                    "date_of_birth"     => $row['u_date_birth'],
                    "day"               => date_format(date_create($row['u_date_birth']), "d"),
                    "month"             => date_format(date_create($row['u_date_birth']), "m"),
                    "years"             => date_format(date_create($row['u_date_birth']), "Y"),
                    "line_name"         => $row['u_line_name'],
                    "image"             => $row['u_line_image'],
                    "cradit"            => round($world_point, 2),
                );
            }
        }

        return $userData;
    }

    public function updateUser($data, $world_id)
    {
        global $table_m_user, $world_id;

        $query = "UPDATE " . $table_m_user . "
                    SET
                        u_name = :firstname,
                        u_lastname = :lastname,
                        u_address = :address,
                        u_address_id= :address_id,
                        u_update_at = now()
                    WHERE
                        u_id = :world_id
                ";

        $stmt = $this->conn->prepare($query);

        $date_of_birth = date('Y-m-d', strtotime($data->userDateOfBirth));

        $stmt->bindParam(':firstname', $data->userName);
        $stmt->bindParam(':lastname', $data->userLastname);
        $stmt->bindParam(':address', $data->userAddress);
        $stmt->bindParam(':address_id', $data->userAddressID);
        $stmt->bindParam(':world_id', $world_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return $stmt->errorInfo();
        }
    }

    public function Usersearch($tel)
    {
        global $table_m_user;

        $query = " SELECT * FROM `" . $table_m_user . "` WHERE u_tell = :tel ";

        $stmt = $this->conn->prepare($query);

        // Binding parameters
        $stmt->bindParam(':tel', $tel);

        $stmt->execute() or die(json_encode(
            array(
                "message"   => "execute not success.",
                "error"     => $stmt->errorInfo()
            ),
            http_response_code(400)
        ));

        $num = $stmt->rowCount();

        $userData = array();

        if ($num > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userData[] = array(
                    "uID"               => $row['u_id'],
                    "name"              => $row['u_name'],
                    "last_name"         => $row['u_lastname'],
                    "tel"               => $row['u_tell']
                );
            }
        }

        return $userData;
    }
}
