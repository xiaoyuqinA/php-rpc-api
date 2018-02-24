<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Db;
use Log\Log;


/**
 * Class Db
 * @package think
 * @method Query table( string $table ) static 指定数据表（含前缀）
 * @method Query name( string $name ) static 指定数据表（不含前缀）
 * @method Query where( mixed $field, string $op = NULL, mixed $condition = NULL ) static 查询条件
 * @method Query join( mixed $join, mixed $condition = NULL, string $type = 'INNER' ) static JOIN查询
 * @method Query union( mixed $union, boolean $all = FALSE ) static UNION查询
 * @method Query limit( mixed $offset, integer $length = NULL ) static 查询LIMIT
 * @method Query order( mixed $field, string $order = NULL ) static 查询ORDER
 * @method Query cache( mixed $key = NULL, integer $expire = NULL ) static 设置查询缓存
 * @method mixed value( string $field ) static 获取某个字段的值
 * @method array column( string $field, string $key = '' ) static 获取某个列的值
 * @method Query view( mixed $join, mixed $field = NULL, mixed $on = NULL, string $type = 'INNER' ) static 视图查询
 * @method mixed find( mixed $data = NULL ) static 查询单个记录
 * @method mixed select( mixed $data = NULL ) static 查询多个记录
 * @method integer insert( array $data, boolean $replace = FALSE, boolean $getLastInsID = FALSE, string $sequence = NULL ) static 插入一条记录
 * @method integer insertGetId( array $data, boolean $replace = FALSE, string $sequence = NULL ) static 插入一条记录并返回自增ID
 * @method integer insertAll( array $dataSet ) static 插入多条记录
 * @method integer update( array $data ) static 更新记录
 * @method integer delete( mixed $data = NULL ) static 删除记录
 * @method boolean chunk( integer $count, callable $callback, string $column = NULL ) static 分块获取数据
 * @method mixed query( string $sql, array $bind = [], boolean $master = FALSE, bool $pdo = FALSE ) static SQL查询
 * @method integer execute( string $sql, array $bind = [], boolean $fetch = FALSE, boolean $getLastInsID = FALSE, string $sequence = NULL ) static SQL执行

 * @method mixed transaction( callable $callback ) static 执行数据库事务
 * @method void startTrans() static 启动事务
 * @method void commit() static 用于非自动提交状态下面的查询提交
 * @method void rollback() static 事务回滚
 * @method boolean batchQuery( array $sqlArray ) static 批处理执行SQL语句
 * @method string quote( string $str ) static SQL指令安全过滤
 * @method string getLastInsID( $sequence = NULL ) static 获取最近插入的ID
 */
class Db {
    //  数据库连接实例
    private static $instance = [];
    // 查询次数
    public static $queryTimes = 0;
    // 执行次数
    public static $executeTimes = 0;

    /**
     * 数据库初始化 并取得数据库类实例
     * @static
     * @access public
     * @param mixed $config 连接配置
     * @param bool|string $name 连接标识 true 强制重新连接
     * @return Connection
     * @throws \Exception
     */
    public static function connect( $config = [], $name = FALSE ) {
        if ( FALSE === $name ) {
            $name = md5( serialize( $config ) );
        }
        if ( TRUE === $name || !isset( self::$instance[$name] ) ) {
            // 解析连接参数 支持数组和字符串
            $options = self::parseConfig( $config );
            if ( empty( $options['type'] ) ) {
                throw new \InvalidArgumentException( 'Undefined db type' );
            }
            $class = FALSE !== strpos( $options['type'], '\\' ) ? $options['type'] : '\\Db\\Connector\\' . ucwords( $options['type'] );
            // 记录初始化信息
            if ( \Conf\Config::get( 'debug' ) ) {
                Log::record( '[ DB ] INIT ' . $options['type'] );
            }
            if ( TRUE === $name ) {
                $name = md5( serialize( $config ) );
            }
            self::$instance[$name] = new $class( $options );
        }
        return self::$instance[$name];
    }

    public static function clear() {
        self::$instance = NULL;
    }

    /**
     * 数据库连接参数解析
     * @static
     * @access private
     * @param mixed $config
     * @return array
     */
    private static function parseConfig( $config ) {
        if ( empty( $config ) ) {
            $config = \Conf\Config::get( 'database' );
        } elseif ( is_string( $config ) && FALSE === strpos( $config, '/' ) ) {
            // 支持读取配置参数
            $config = \Conf\Config::get( "db.{$config}" );
        }
        if ( is_string( $config ) ) {
            return self::parseDsn( $config );
        } else {
            return $config;
        }
    }

    /**
     * DSN解析
     * 格式： mysql://username:passwd@localhost:3306/DbName?param1=val1&param2=val2#utf8
     * @static
     * @access private
     * @param string $dsnStr
     * @return array
     */
    private static function parseDsn( $dsnStr ) {
        $info = parse_url( $dsnStr );
        if ( !$info ) {
            return [];
        }
        $dsn = [
            'type' => $info['scheme'],
            'username' => isset( $info['user'] ) ? $info['user'] : '',
            'password' => isset( $info['pass'] ) ? $info['pass'] : '',
            'hostname' => isset( $info['host'] ) ? $info['host'] : '',
            'hostport' => isset( $info['port'] ) ? $info['port'] : '',
            'database' => !empty( $info['path'] ) ? ltrim( $info['path'], '/' ) : '',
            'charset' => isset( $info['fragment'] ) ? $info['fragment'] : 'utf8',
        ];

        if ( isset( $info['query'] ) ) {
            parse_str( $info['query'], $dsn['params'] );
        } else {
            $dsn['params'] = [];
        }
        return $dsn;
    }

    // 调用驱动类的方法
    public static function __callStatic( $method, $params ) {
        // 自动初始化数据库
        return call_user_func_array( [ self::connect(), $method ], $params );
    }
}
