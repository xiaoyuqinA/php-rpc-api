<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :Log.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/10 下午7:37
// +--------------------------------------------------------------------------

namespace Log;

use Syx\Application;

class Log {

    public static function record( $msg ) {


        $msg = self::formatMessage( $msg );

        $dir = self::makeDir();

        if ( empty( $dir ) ) {
            return FALSE;
        }

        $file_name = $dir . '/' . date( 'Y-m-d' ) . '.log';

        $size = self::write( $file_name, $msg );

        if ( $size ) {
            return TRUE;
        }
        return FALSE;

    }

    public static function write( $file_name, $msg ) {
        return file_put_contents( $file_name, $msg, FILE_APPEND );
    }

    public static function makeDir() {
        $log_dir = \Conf\Config::get( 'application.log_path' );
        if ( !is_dir( $log_dir ) ) {
            @mkdir( $log_dir, 0777, TRUE );
        }
        if ( !is_writable( $log_dir ) ) {
            @chmod( $log_dir, 0777 );
        }

        return $log_dir;
    }

    public static function formatMessage( $msg ) {
        if ( is_array( $msg ) ) {
            $msg = var_export( $msg, TRUE );
        }

        $module_name = \Http\Request::getRouterModuleName();
        $controller_name = \Http\Request::getRouterControllerName();
        $action_name = \Http\Request::getRouterActionName();

        $text = "\n[{$module_name}/{$controller_name}/{$action_name}] ---- \n";
        $text .= $msg . "\n";
        $text .= date( 'Y-m-d H:i:s' ) . "\n";
        return $text;
    }

    public static function recordException( \Exception $exception ) {
        $msg = self::converExceptionToStr( $exception );
        self::record( $msg );
    }

    public static function converExceptionToStr( \Exception $exception ) {
        $msg = $exception->getMessage();
        $code = $exception->getCode();
        $file = $exception->getFile();
        $line = $exception->getLine();
        return self::formatErrorMessage( $msg, $code, $file, $line );
    }

    public static function formatErrorMessage( $msg, $code, $file = '', $line = 0 ) {
        $err_msg = "[msg]:{$msg},[code]:${code},[file]:{$file},[line]:{$line}";
        return $err_msg;
    }


}