<?php
namespace Boxun\Cache\User;

use Taurus\Cache\Cache;
use Taurus\Cache\CacheAbstract;

class UserCache extends CacheAbstract
{
    /**
     * 缓存类型
     * @var int
     */
    protected $type = Cache::TYPE_MEMCACHED;
    /**
     * 配置文件的key
     * @var string
     */
    protected $configKey = 'memcache';
    /**
     * 缓存前缀
     * @var string
     */
    protected $prefixKey = 'test:u:';
    /**
     * 过期时间
     *
     * @var integer
     */
    protected $ttl = 86400;
}