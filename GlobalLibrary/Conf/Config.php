<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :Config.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/10 下午7:50
// +--------------------------------------------------------------------------

namespace Conf;

use Syx\Application;

class Config {

    /**
     * @param null $name
     * @return mixed
     */
    public static function get( $name = NULL ) {
        if ( $name ) {
            $config = Application::app()->getConfig()->get( $name );
            if ( is_object( $config ) ) {
                return $config->toArray();
            }
            return $config;
        } else {
            return Application::app()->getConfig()->toArray();
        }
    }

    /**
     * @return array
     */
    public static function getConfigLocalNamespace() {
        $local_namespace = Application::app()->getConfig()->get( 'local_namespace' );
        return explode( ',', $local_namespace );
    }
}