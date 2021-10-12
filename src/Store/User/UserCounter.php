<?php
namespace Boxun\Store\User;

use Taurus\Redis\RedisAbstract;

class UserCounter extends RedisAbstract
{
    /**
     * 配置文件的key
     * @var string
     */
    protected $configKey = 'redis';
    /**
     * 缓存前缀
     * @var string
     */
    protected $prefixKey = 'test:uc:';
    /**
     * 过期时间
     *
     * @var integer
     */
    protected $ttl = 0;
}