<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customsms {

    private $_CI;
    var $AUTH_KEY = ""; //your AUTH_KEY here
    var $senderId = ""; //your senderId here
    var $routeId = ""; //your routeId here
    var $smsContentType = ""; //your smsContentType here

    function __construct() {
        $this->_CI = & get_instance();
        $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
    } 

    function sendSMS($to, $message) {

        $url = 'https://quicksms.advantasms.com/api/services/sendsms/';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
                'partnerID' => '3519',
                'apikey' => 'a477795344887ae6e3ce08b3ad749700',
                'mobile' => $to,
                'message' => $message,
                'shortcode' => 'KingsInt.Ac',
                'pass_type' => 'plain', //bm5 {base64 encode} or plain
        );
        // json encode the parameters
        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); // pass the JSON request body

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

//        $content = 'AUTH_KEY=' . rawurlencode($this->AUTH_KEY) .
//                '&message=' . rawurlencode($message) .
//                '&senderId=' . rawurlencode($this->senderId) .
//                '&routeId=' . rawurlencode($this->routeId) .
//                '&mobileNos=' . rawurlencode($to) .
//                '&smsContentType=' . rawurlencode($this->smsContentType);
//        $ch = curl_init('https://yourapiurl.com' . $content);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $response = curl_exec($ch);
//        curl_close($ch);
//        return $response;
    }

}

?>