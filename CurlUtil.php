<?php

/**
 * Curl util for handling CRUD operations with curl
 */
Class CurlUtil {

    /**
     * 300 seconds, for this time a connection to server will be active
     *
     * @var type 
     */
    private static $CONNECTTIMEOUT = 0;

    /**
     * Never timeout for processing a request
     * 
     * @var type 
     */
    private static $TIMEOUT = 0;

    /**
     * User name for login
     *
     * @var type 
     */
    private static $USERNAME = "adminJT1";

    /**
     * Password for login
     *
     * @var type 
     */
    private static $PASSWORD = "admin";

    /**
     * 
     * @param type $method
     * @param string $url
     * @param type $obj
     * @return type
     */
    public static function exec($method, $url, $obj = array()) {
      
        $curl = curl_init();
        
        switch ($method) {
            case 'GET':
                if (strrpos($url, "?") === FALSE) {
                    $url .= '?' . http_build_query($obj);
                }
                break;

            case 'POST':
                curl_setopt($curl, CURLOPT_POST, TRUE);
          
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj));
                break;

            case 'PUT':
            case 'DELETE':
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method)); // method
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj)); // body
        }


       // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      //  curl_setopt($curl, CURLOPT_USERPWD, static::$USERNAME . ':' . static::$PASSWORD);
       // curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_URL, $url);
       // curl_setopt($curl, CURLOPT_HEADER, TRUE);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
       // curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, static::$CONNECTTIMEOUT);
        //curl_setopt($curl, CURLOPT_TIMEOUT, static::$TIMEOUT);
       
        // Exec
        try {
            $response = curl_exec($curl);
        } catch (Exception $e) {
            throw new Exception('No records found');
        }
       
        try {
            $info = curl_getinfo($curl);
        } catch (Exception $e) {
            throw new Exception('No information is provided');
        }

        curl_close($curl);

        // Data
        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return array('status' => $info['http_code'], 'header' => $header, 'data' => json_decode($body));
    }

    public static function get($url, $obj = array()) {
        return RestCurl::exec("GET", $url, $obj);
    }

    public static function post($url, $obj = array()) {
        
        return RestCurl::exec("POST", $url, $obj);
    }

    public static function put($url, $obj = array()) {
        return RestCurl::exec("PUT", $url, $obj);
    }

    public static function delete($url, $obj = array()) {
        return RestCurl::exec("DELETE", $url, $obj);
    }

}
