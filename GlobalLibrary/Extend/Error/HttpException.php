<?php
// +--------------------------------------------------------------------------
// | ProjectName :best_gms_oversea_api
// +--------------------------------------------------------------------------
// | Description :HttpException.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/16 上午12:19
// +--------------------------------------------------------------------------


namespace Extend\Error;


use Throwable;

class HttpException extends \Exception {

    public $body;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL ) {
        $this->body = $previous->body;
        parent::__construct( $message, $code, $previous );
    }

}