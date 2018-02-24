<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :RequestPlugin.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/10 下午8:10
// +--------------------------------------------------------------------------


namespace Plugin;


class RequestPlugin extends \Syx\PluginAbstract {

    /**
     * @param \Syx\RequestAbstract $request
     * @param \Syx\RequestAbstract $response
     * 在路由开始,记录数据
     */
    /*public function routerStartup( \Syx\RequestAbstract $request, \Syx\ResponseAbstract $response ) {
        $param = $request->getParams();
        \Log\Log::record( "路由前的参数请求参数:" . var_export( $param, TRUE ) );
    }*/

    /**
     * @param \Syx\RequestAbstract $request
     * @param \Syx\RequestAbstract $response
     * 在路由开始,记录数据
     */
    public function routerShutdown( \Syx\RequestAbstract $request, \Syx\ResponseAbstract $response ) {

        /**
         * 记录路由信息
         */
        \Http\Request::recordRouterInfo();

        /**
         * 记录路由参数
         */
        \Http\Request::recordRequestParam();

    }

}