<?php
// +--------------------------------------------------------------------------
// | ProjectName :best_gms_oversea_api
// +--------------------------------------------------------------------------
// | Description :Request.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/15 下午7:48
// +--------------------------------------------------------------------------


namespace Http;


use Helper\ArrayHelp;
use Syx\Application;

class Request {

    /**
     * @var $this
     */
    protected static $instance = '';

    /**
     * @var \Syx\RequestAbstract;
     */
    protected $request = '';

    protected function __construct() {
        $this->request = self::getRequest();
    }


    public static function recordRouterInfo() {
        self::setRouterModuleName();
        self::setRouterControllerName();
        self::setRouterActionName();
    }


    public static function setRouterModuleName( $module_name = '' ) {
        if ( empty( $module_name ) ) {
            $module_name = self::getRequest()->getModuleName();
        }
        \Syx\Registry::set( 'module_name', $module_name );
    }

    public static function setRouterControllerName( $controller_name = '' ) {
        if ( empty( $controller_name ) ) {
            $controller_name = self::getRequest()->getControllerName();
        }
        \Syx\Registry::set( 'controller_name', $controller_name );
    }

    public static function setRouterActionName( $action_name = '' ) {
        if ( empty( $action_name ) ) {
            $action_name = self::getRequest()->getActionName();
        }
        \Syx\Registry::set( 'action_name', $action_name );
    }

    public static function getRouterModuleName() {
        return \Syx\Registry::get( 'module_name' );
    }

    public static function getRouterControllerName() {
        return \Syx\Registry::get( 'controller_name' );
    }

    public static function getRouterActionName() {
        return \Syx\Registry::get( 'action_name' );
    }

    /**
     * @return null|\Syx\RequestAbstract
     */
    public static function getRequest() {
        return Application::app()->getDispatcher()->getRequest();
    }

    public static function recordRequestParam() {
        $query = self::getRequest()->getQuery();
        $post = self::getRequest()->getPost();
        \Log\Log::record( "post:" . var_export( $post, TRUE ) . ",\nget:" . var_export( $query, TRUE ) );
    }

    public static function getInstance() {
        if ( !self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * @param $url
     * @return array
     * @throws \Syx\Exception
     */
    public static function parseUrl( $url ) {
        $url = parse_url( $url );
        if ( $url ) {
            return $url;
        } else {
            throw new \Syx\Exception( "url地址不合法，url:{$url}" );
        }
    }

    public static function filterQueryStr( $query_str ) {
        parse_str( $query_str, $output );
        $filter = ArrayHelp::filter( $output );
        return $filter;
    }

    public static function parsePath( $path ) {
        $path = ltrim( $path, '/' );
        $path_arr = explode( '/', $path );
        return $path_arr;
    }


    /**
     * @param $uri
     * @return string | false
     * @throws \Syx\Exception
     */
    public static function getResetFulController( $uri ) {
        $uri = self::parseUrl( $uri );
        if ( $uri['path'] ) {
            $path_arr = self::parsePath( $uri['path'] );
            return $path_arr[0];
        }
        return FALSE;
    }

    /**
     * @param string $uri
     * @return bool | string
     */
    public static function getResetFulActionFromUri( $uri ) {
        $uri = self::parseUrl( $uri );
        $path_arr = self::parsePath( $uri['path'] );
        if ( count( $path_arr ) == 2 ) {
            return $path_arr[1];
        } else {
            return FALSE;
        }
    }


    /**
     * @param string $method
     * @return string
     */
    public static function getResetFulActionFromMethod( $method ) {
        $method = strtoupper( $method );
        switch ( $method ) {
            case "POST":
                $action = 'add';
                break;
            case "DELETE":
                $action = 'delete';
                break;
            case "PUT":
                $action = "update";
                break;
            case "GET":
                $action = "get";
                break;
            default:
                $action = "get";
        }
        return $action;
    }


    /**
     * @param string $uri
     * @return bool|array
     */
    public static function getQueryStrFromUri( $uri ) {
        $uri = self::parseUrl( $uri );
        $query_str = $uri['query'];
        $query_arr = [];
        if ( $query_str ) {
            $query_arr = self::filterQueryStr( $query_str );
        }
        if ( $query_arr ) {
            return $query_arr;
        }
        return FALSE;
    }

    /**
     * @param \Syx\RequestAbstract $request
     * @param array $params
     * @return \Syx\RequestAbstract
     */
    public static function setParams( $request, $params ) {
        foreach ( $params as $key => $val ) {
            $request->setParam( $key, $val );
        }
        return $request;
    }


}