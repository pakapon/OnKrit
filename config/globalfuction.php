<?php
function zero_num($number, $length)
{
    $string = substr(str_repeat(0, $length) . $number, -$length);
    return $string;
}


function datesale()
{
    $today = strtotime(date("d-m-Y"));
    $nextmonth = strtotime('+1 month', $today);

    $month_arr = array(
        "01" => "มกราคม",
        "02" => "กุมภาพันธ์",
        "03" => "มีนาคม",
        "04" => "เมษายน",
        "05" => "พฤษภาคม",
        "06" => "มิถุนายน",
        "07" => "กรกฎาคม",
        "08" => "สิงหาคม",
        "09" => "กันยายน",
        "10" => "ตุลาคม",
        "11" => "พฤศจิกายน",
        "12" => "ธันวาคม"
    );

    if (date("d") < 16) {
        $date = "16 " . $month_arr[date("m")] . " " . (date("Y") + 543);
    } elseif (date("d") >= 16) {
        $date = "1 " . $month_arr[date("m", $nextmonth)] . " " . (date("Y", $nextmonth) + 543);
    }

    return $date;
}

function link_to_image($image_link)
{
    $filetype = substr($image_link, -3);
    $b64image = 'data:image/' . $filetype . ';base64,' . base64_encode(file_get_contents($image_link));
    return  $b64image;
}

function call_push_ms($token, $body)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);  
    return $response;
}

function createImage($image, $folder)
{
    $imagebase_r = explode("data:image", $image);
    if ($imagebase_r[0] == "") {
        $datapart = $_SERVER['DOCUMENT_ROOT'] . "api/" . $folder . "/";
        return "api/" . $folder . "/" . base64_to_image($image, $datapart);
    } else {
        return $image;
    }
}

function base64_to_image($base64_code, $path, $image_name = null)
{

    if (!empty($base64_code) && !empty($path)) {
        $string_pieces = explode(";base64,", $base64_code);

        /*@ Get type of image ex. png, jpg, etc. */
        // $image_type[1] will return type
        $image_type_pieces = explode("image/", $string_pieces[0]);

        $image_type = $image_type_pieces[1];

        /*@ Create full path with image name and extension */
        $name = md5(uniqid()) . '.' . $image_type;
        $store_at = $path .  $name;

        /*@ If image name available then use that  */
        if (!empty($image_name)) :
            $store_at = $path . $image_name . '.' . $image_type;
        endif;

        $decoded_string = base64_decode($string_pieces[1]);

        file_put_contents($store_at, $decoded_string);

        return $name;
    } else {
        return false;
    }
}

function checkNotEmpty($data, $message)
{
    if (empty($data)) {
        http_response_code(400);
        echo json_encode(array("errror" => $message));
        exit();
    } else {
        return $data;
    }
}

function uploadFilesPS($filesArray) {
    $uploadedFiles = [];

    // ตรวจสอบว่าเป็นไฟล์เดี่ยวหรือหลายไฟล์
    if (!is_array($filesArray['name'])) {
        // ไฟล์เดี่ยว
        $filesArray = ['name' => [$filesArray['name']], 'tmp_name' => [$filesArray['tmp_name']], 'error' => [$filesArray['error']]];
    }

    foreach ($filesArray['name'] as $key => $value) {
        if ($filesArray['error'][$key] === 0) {
            $fileName = time() . "_" . basename($filesArray['name'][$key]);
            $targetFilePath = "../uploads/" . $fileName;

            if (move_uploaded_file($filesArray['tmp_name'][$key], $targetFilePath)) {
                $uploadedFiles[] = $targetFilePath;
            }
        }
    }

    // ตรวจสอบจำนวนไฟล์ที่อัพโหลดสำเร็จ
    if (count($uploadedFiles) > 1) {
        return implode(", ", $uploadedFiles);
    } elseif (count($uploadedFiles) == 1) {
        return $uploadedFiles[0];
    }

    return null;
}