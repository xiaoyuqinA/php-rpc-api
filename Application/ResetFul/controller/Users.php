<?php
// +--------------------------------------------------------------------------
// | ProjectName :php_api
// +--------------------------------------------------------------------------
// | Description :Users.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/2/9 下午3:27
// +--------------------------------------------------------------------------


namespace App\ResetFul\controller;


use App\Common\controller\Common;
use Extend\Error\HttpException;
use Http\Response;


class Users extends Common {

    public function addAction() {
        return $this->getRequest()->getParams();
    }

    public function deleteAction() {
        return $this->getRequest()->getParams();
    }

    public function updateAction() {
        return $this->getRequest()->getParams();
    }

    public function getAction() {
        try {
            $params = $this->getRequest()->getParams();
            $data = $this->data( $params );
            $this->response( $data );
        } catch ( \Exception $e ) {
            Response::setResponseBody( $e, "ceshi" );
            throw  new HttpException( "error", 11, $e );
        }
    }
}