<?php
// +--------------------------------------------------------------------------
// | ProjectName :best_gms_oversea_api
// +--------------------------------------------------------------------------
// | Description :ErrorHandel.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/15 下午11:50
// +--------------------------------------------------------------------------


namespace Extend\Error;


class ErrorHandel {

    /**
     * 注册异常处理
     * @return void
     */
    public static function register() {
        set_error_handler( [ __CLASS__, 'appError' ] );
        register_shutdown_function( [ __CLASS__, 'appShutdown' ] );
    }


    public static function appError( $errno, $errstr, $errfile = '', $errline = 0, $errcontext = [] ) {
        $msg = \Log\Log::formatErrorMessage( $errno, $errstr, $errfile, $errline );
        \Log\Log::record( $msg );

    }



}