<?php


namespace Db\Exception;

use PDOException;
use Throwable;

/**
 * PDO参数绑定异常
 */
class BindParamException extends PDOException {


    /**
     * BindParamException constructor.
     * @param string $message
     * @param array $config
     * @param string $sql
     * @param array $bind
     * @param int $code
     */
    public function __construct( $message, $config, $sql, $bind, $code = 10502 ) {


        unset( $config['username'], $config['password'] );
        $data = [
            'Error Code' => $code,
            'Error Message' => $message,
            'Error SQL' => $sql,
            'Bind ' => $bind,
            'config ' => $config
        ];
        $this->message = var_export( $data, TRUE );
        $this->code = $code;
    }


}
