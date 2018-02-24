<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :Bootstrap.php
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/4 下午5:06
// +--------------------------------------------------------------------------


use \Plugin\RequestPlugin;
use \Http\Route\ResetFul;

class Bootstrap extends \Syx\BootstrapAbstract {


    /**
     * @param \Syx\Dispatcher $dispatcher
     * 注册本地库命名空间
     */
    public function _initRegisterLocalNamespace( \Syx\Dispatcher $dispatcher ) {

        $loader = \Syx\Loader::getInstance();
        $local_namespace = \Conf\Config::getConfigLocalNamespace();
        $loader->registerLocalNamespace( $local_namespace );
    }

    /**
     * @param \Syx\Dispatcher $dispatcher
     * 注册resetful路由协议
     */
    public function _initRoute( \Syx\Dispatcher $dispatcher ) {
        $resetful_route = new ResetFul();
        $router = $dispatcher->getRouter();
        $router->addRoute( 'resetful', $resetful_route );
    }

    /**
     *
     * @param \Syx\Dispatcher $dispatcher
     * 注册插件
     */
    public function _initPlugin( \Syx\Dispatcher $dispatcher ) {
        $request_plugin = new RequestPlugin();
        $dispatcher->registerPlugin( $request_plugin );
    }




}