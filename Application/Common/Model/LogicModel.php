<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :LogicModel.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/11 下午3:13
// +--------------------------------------------------------------------------


namespace App\Common\Model;


class LogicModel {

    /**
     * @var string
     */
    protected $model_class = '';

    /**
     * @var \App\Common\Model\Common;
     */
    protected $model = '';

    public function __construct() {

        if ( empty( $this->model_class ) ) {
            throw new \Exception( "model_class of " . __CLASS__ . "is null , need give a value" );
        }

        $this->model = $this->initModel();
    }

    public function initModel() {
        $class = $this->model_class;
        $model = new $class();
        return $model;
    }





}