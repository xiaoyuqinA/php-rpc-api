<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :Logic.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/10 下午7:14
// +--------------------------------------------------------------------------


namespace App\Common\Logic;


class Logic {

    /**
     * @var \App\Common\Model\Common 模型
     */
    protected $model = NULL;
    /**
     * @var string 模型的类名.如\App\Common\Model\Common
     */
    protected $model_class = '';

    public function __construct() {
        if ( !empty( $this->model_class ) ) {
            $this->model = new $this->model_class;
        }
    }

    


}