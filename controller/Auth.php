<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use \Firebase\JWT\JWT;

class AuthService
{
    private $conn;
    private $secret_key;
    private $secret_key_refresh;
    private $expiretimesec;
    private $expiretimesec_refresh;

    public function __construct($db)
    {

        global $secret_key;
        global $secret_key_refresh;
        global $expiretimesec;
        global $expiretimesec_refresh;

        $this->conn = $db->getConnection();
        $this->secret_key = $secret_key;
        $this->secret_key_refresh = $secret_key_refresh;
        $this->expiretimesec = $expiretimesec;
        $this->expiretimesec_refresh = $expiretimesec_refresh;
    }

    public function loginUser($data)
    {
        global $table_ur;
        if (!empty($data->users)) {
            $query = "SELECT * FROM `" . $table_ur . "` WHERE u_mail = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $data->users);
        }

        $stmt->execute() or die(json_encode(
            array(
                "message"   => "execute not success.",
                "error"     => $stmt->errorInfo()
            ),
            http_response_code(400)
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        if (!$row || !password_verify($data->passWord, $row['u_password'])) {
            return null;
        } else {
            $token = $this->createToken($row['u_code']);
            $token_refresh = $this->createRefreshToken($row['u_code']);
        }


        $this->updateTokensInDatabase($data->users, $token, $token_refresh);

        return [
            "token" => $token,
            "refreshToken" => $token_refresh
        ];
    }

    public function refreshUser($data)
    {
        global $table_ur;
        $query = "SELECT * FROM `" . $table_ur . "` WHERE refresh_token = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $data->refreshToken);
        $stmt->execute() or die(json_encode(
            array(
                "message"   => "execute not success.",
                "error"     => $stmt->errorInfo()
            ),
            http_response_code(400)
        ));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        $token = $this->createToken($row['u_mail']);
        $users = $row['u_mail'];
        $token_refresh = $data->refreshToken;

        if ($users == null) {
            return [];
        }

        $this->updateTokensInDatabase($users, $token, $token_refresh);

        return [
            "token" => $token,
            "refreshToken" => $token_refresh
        ];
    }

    private function updateTokensInDatabase($users, $jwt, $jwt_refresh)
    {
        global $table_ur;
        $query = "UPDATE `" . $table_ur . "` SET token = ?, refresh_token = ? WHERE u_mail = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $jwt);
        $stmt->bindParam(2, $jwt_refresh);
        $stmt->bindParam(3, $users);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update tokens in database.");
        }
    }
    private function createToken($id)
    {
        return $this->createJWT($id, $this->expiretimesec, $this->secret_key);
    }

    private function createRefreshToken($id)
    {
        return $this->createJWT($id, $this->expiretimesec_refresh, $this->secret_key_refresh);
    }

    private function createJWT($id, $expiry, $key)
    {
        $issuer_claim = "API_Mamber_Ocpp";
        $audience_claim = "API_Mamber_Ocpp";
        $issuedat_claim = time();
        $notbefore_claim = $issuedat_claim + 1;
        $expire_claim = $issuedat_claim + $expiry;

        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id
            )
        );

        return JWT::encode($token, $key, 'HS256');
    }
}
