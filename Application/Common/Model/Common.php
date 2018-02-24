<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :Common.php
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/4 下午5:22
// +--------------------------------------------------------------------------


namespace App\Common\Model;


class Common extends \Db\Model {

    /*public function setTable( $name = '' ) {
        if ( empty( $name ) ) {
            $name = strtolower( trim( preg_replace( "/[A-Z]/", "_\\0", $this->name ), "_" ) );
        }
        $this->table = $name;
        return $name;
    }*/

    /**
     * @param $where
     * @param string $field
     * @return bool | array
     */
    public function getOneDataByWhere( $where = [], $field = '*' ) {
        return $this->where( $where )->field( $field )->find();

    }

    /**
     * @param array $where
     * @param string $field
     * @param string $order
     * @return array
     */
    public function getDataByWhere( array $where = [], $field = '*', $order = 'id desc' ) {
        return $this->where( $where )->order( $order )->field( $field )->select()->toArray();

    }

    public function batchAdd( $data ) {
        return $this->allowField( TRUE )->saveAll( $data, FALSE );
    }

    public function add( $data ) {
        return $this->allowField( TRUE )->data( $data )->isUpdate( FALSE )->save();
    }


    public function getDataByPage( $page = 1, $size = 10, $order = 'id desc', $where = '1=1', $field = '*' ) {
        return $this->where( $where )->order( $order )->page( $page, $size )->field( $field )->select();
    }

    /*public function getBatchDataByWhere( $field, $op, $val ) {
        if ( is_array( $val ) ) {
            $val = ArrayHelp::arrayUnique( $val );
        }

        return $this->where( $field, $op, $val )->select()->toArray();
    }*/

    public function saveDataByWhere( $data, $where ) {

        return $this->allowField( TRUE )->isUpdate( TRUE )->save( $data, $where );
    }

}