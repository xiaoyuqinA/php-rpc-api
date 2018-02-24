<?php
// +--------------------------------------------------------------------------
// | ProjectName :best_gms_oversea_api
// +--------------------------------------------------------------------------
// | Description :ArrayHelp.php 
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/15 下午9:16
// +--------------------------------------------------------------------------


namespace Helper;


class ArrayHelp {

    public static function jsonEncode( $arr ) {
        return \json_encode( $arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_BIGINT_AS_STRING );
    }

    public static function strToArr( $delimiter = ',', $string ) {
        $arr = explode( $delimiter, $string );
        return $arr;
    }

    /**
     * @param array $arr
     * @param string $val
     * @return int | string
     */
    public static function searchValueInArr( $arr, $val ) {
        $key = array_keys( $arr, $val );
        if ( $key ) {
            return array_shift( $key );
        }
        return FALSE;
    }

    public static function filter( $arr ) {
        array_walk( $arr, function ( &$v ) {
            return htmlspecialchars( $v );
        } );
        return $arr;
    }
}