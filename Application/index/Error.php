<?php
// +--------------------------------------------------------------------------
// | ProjectName :best_gms_oversea_api
// +--------------------------------------------------------------------------
// | Description :Error.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/15 下午5:53
// +--------------------------------------------------------------------------


namespace App\index\controller;


use \App\Common\controller\Common;
use \Extend\Error\ErrorNo;
use \Extend\Error\HttpException;
use \Log\Log;


class Error extends Common {
    public function errorAction( \Exception $exception ) {
        if ( $exception instanceof HttpException ) {
            $resp = $exception->body;
        } else {
            $resp = $this->data( [], ErrorNo::FAIL );
        }
        Log::recordException( $exception );
        return $this->response( $resp );
    }

}