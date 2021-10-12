<?php
namespace Boxun\Model\User;

use Boxun\Cache\User\UserCache;
use Boxun\Model\Model;

class UserModel extends Model
{
    protected $primaryKey = 'id';
    protected $isAutoIncr = true;
    protected $table = 'users';

    protected $allowCache = true;
    /**
     * @var CacheAbstract
     */
    protected $cacheClass = UserCache::class;
}