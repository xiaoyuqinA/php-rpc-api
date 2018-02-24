<?php
// +--------------------------------------------------------------------------
// | ProjectName :php_api
// +--------------------------------------------------------------------------
// | Description :ResetFul.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/2/9 上午11:26
// +--------------------------------------------------------------------------


namespace Http\Route;


use Helper\ArrayHelp;
use \Http\Request;
use \Syx\RequestAbstract;


class ResetFul implements \Syx\RouteInterface {


    public function __construct() {

    }

    /**
     * @param \Syx\RequestAbstract $request
     */
    public function route( $request ) {
        //根据HTTP请求的方法，获取到控制器、方法、参数
        $uri = $request->getRequestUri();

        $controller = Request::getResetFulController( $uri );
        $action = Request::getResetFulActionFromUri( $uri );
        if ( !$action ) {
            $action = Request::getResetFulActionFromMethod( $request->getMethod() );
        }
        $query = ArrayHelp::filter( $request->getQuery() );
        $post = ArrayHelp::filter( $request->getPost() );
        $params = array_merge( $query, $post );
        $model_name = \Conf\Config::get( "application.resetful_module_name" );
        $request->setModuleName( $model_name );
        $request->setControllerName( $controller );
        $request->setActionName( $action );
        Request::setParams( $request, $params );
    }

    /**
     * assemble
     * @description Assemble a url
     * @param array $param
     * @param array $query
     * @return string
     */

    public function assemble( array $info, array $query = NULL ) {

    }

}