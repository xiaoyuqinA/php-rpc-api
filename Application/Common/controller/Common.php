<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :Common.php
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/4 下午5:18
// +--------------------------------------------------------------------------


namespace App\Common\controller;


use Extend\Error\ErrorNo;
use Helper\ArrayHelp;
use Http\Controller;

class Common extends Controller {


    public function getHeaderIp() {

        $default_ip = '127.0.0.1';
        $ip1 = $this->getRequest()->getServer( 'REMOTE_ADDR' );
        $ip2 = $this->getRequest()->getServer( 'HTTP_X_FORWORD_FOR' );
        $ip3 = $this->getRequest()->getServer( 'HTTP_CLIENT_IP' );
        $ip4 = $this->getRequest()->getServer( 'HTTP_VIA' );

        if ( $ip1 ) {
            return $ip1;
        }
        if ( $ip2 ) {
            return $ip2;
        }
        if ( $ip3 ) {
            return $ip3;
        }

        if ( $ip4 ) {
            return $ip4;
        }
        return $default_ip;
    }


    protected function response( array $response = [] ) {
        $headers = [ 'Content-type' => 'application/json;charset=utf-8' ];
        if ( !headers_sent() ) {
            foreach ( $headers as $key => $header ) {
                $this->_response->setHeader( $key, $header );
            }
        }
        $resp = ArrayHelp::jsonEncode( $response );
        $this->recordResponse( $resp );
        return $this->_response->setBody( $resp );
    }

    public function recordResponse( $resp ) {
        \Log\Log::record( "resp:{$resp}" );
    }

    public function data( $data = [], $errno = NULL, $errmsg = NULL ) {

        if ( is_null( $errno ) ) {
            $errno = ErrorNo::SUCCESS;
        }

        if ( is_null( $errmsg ) ) {
            $errmsg = ErrorNo::getErrMsg( $errno );
        }

        $resp = [
            'status' => $errno,
            'message' => $errmsg,
            'data' => $data
        ];

        return $resp;
    }


}