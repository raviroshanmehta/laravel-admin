<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

if(!function_exists('sendPushNotification')){
    function sendPushNotification($FcmToken,$data){
        // $data = [
        //     "registration_ids" => $FcmToken,
        //     "notification" => [
        //         "title" => "Test Title",
        //         "body" => "Test Body",  
        //     ],
        //     "data" => [
        //         "action" => "content_detail",
        //         "actionId" => "1"
        //     ]
        // ];
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = env('FCM');
        $data["registration_ids"] = $FcmToken;
        $encodedData = json_encode($data);
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }  
        // Close connection
        curl_close($ch);
        // FCM response
        return $result;    
    }
}


