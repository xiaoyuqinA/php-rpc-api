<?php
// +--------------------------------------------------------------------------
// | ProjectName :interface
// +--------------------------------------------------------------------------
// | Description :RedisHelp.php
//+--------------------------------------------------------------------------
// | Author: xiaoyuqin 
// +--------------------------------------------------------------------------
// | Version:0.0.1                Date:2018/1/10 上午11:05
// +--------------------------------------------------------------------------


namespace Helper;


/**
 * Class RedisHelp
 * @package Helper
 */
class RedisHelp {


    /**
     * @var array $redis_cleint_pool
     */
    protected static $redis_cleint_pool = [];
    protected $name = 'redis';
    protected $name_prefix = 'redis';


    public function __construct( $name = NULL ) {
        if ( $name ) {
            $this->name = $this->name_prefix . "." . $name;
        }
        if ( !isset( self::$redis_cleint_pool[$this->name] ) ) {
            self::$redis_cleint_pool[$this->name] = $this->instanceRedisClient();
        }
        return self::$redis_cleint_pool[$this->name];
    }


    /**
     * @return \Cache\Redis
     */
    public function instanceRedisClient() {
        $config = $this->getRedisConfig( $this->name );
        $redis_client = new \Cache\Redis( $config );
        return $redis_client;
    }


    public function getRedisConfig( $name ) {
        $config = \Conf\Config::get( $name );
        return $config;
    }

    /**
     * @return \Cache\Redis
     */
    public function getRedisClient() {
        return self::$redis_cleint_pool[$this->name];
    }

    public static function getInstance( $name = NULL ) {
        $instance = new self( $name );
        return $instance->getRedisClient();
    }

}