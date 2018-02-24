<?php
// +--------------------------------------------------------------------------
// | ProjectName :best_gms_oversea_api
// +--------------------------------------------------------------------------
// | Description :Response.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/15 下午8:06
// +--------------------------------------------------------------------------


namespace Http;




class Response {


    /**
     * @param $resp
     */
    public static function setResponseBody( \Exception $e, $body ) {
        $e->body = $body;
    }

    public static function getResponseBody( \Exception $e ) {
        return $e->body;
    }


}