<?php

class WeixinSDK{

    private $appId;
    private $appSecret;
    private $dataWrapper;

    public function __construct( $appId, $appSecret, $dataWrapper ){
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->dataWrapper = $dataWrapper;
    }

    public function getSignPackage() {
        $jsapi_ticket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonce_str = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapi_ticket&noncestr=$nonce_str&timestamp=$timestamp&url=$url";

        $signature = sha1( $string );

        $signPackage = array(
            "nonce_str"  => $nonce_str,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "raw_string" => $string
        );

        return $signPackage; 
    }

    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket() {

        $ticket = $this->dataWrapper->get( 'jsapi_ticket' );

        if ( empty( $ticket ) ){
            $ticket = $this->getJsApiTicketFromWx();
        } 

        return $ticket;
    }

    private function getJsApiTicketFromWx(){
        $access_token = $this->getAccessToken();

        // 如果是企业号用以下 URL 获取 ticket
        // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$access_token";
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$access_token";
        $res = json_decode( $this->httpGet( $url ) );
        $ticket = $res->ticket;
        
        if ( $ticket ) {
            $this->dataWrapper->set( "jsapi_ticket", $ticket );
        }

        return $ticket;
    }

    private function getAccessToken() {
        $access_token = $this->dataWrapper->get( 'access_token' );          

        if ( empty( $access_token ) ) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $access_token = $this->getAccessTokenFromWx();
        }

        return $access_token;
    }

    private function getAccessTokenFromWx(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
        $response = json_decode( $this->httpGet( $url ) );

        $access_token = $response->access_token;
        
        if ( $access_token ) {
            $this->dataWrapper->set( "access_token", $access_token, $response->expires_in / 60 );
        }

        return $access_token;
    }

    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}

