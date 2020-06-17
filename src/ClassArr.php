<?php
/**
 * Created by PhpStorm.
 * User: Lany
 * Date: 2020/6/17
 * Time: 上午10:02
 */
namespace Lany\LaravelCurd;

use Illuminate\Config\Repository;

class ClassArr
{
    public static $stats;
    public static $url;

    public function __construct(Repository $config)
    {
        self::$stats = $config->get('l_curd.stats');
        self::$url = $config->get('l_curd.url');
    }

    public function initClass($type, $params = [])
    {
        if (!array_key_exists($type, self::$stats)) {
            return false;
        }
        return (new \ReflectionClass(self::$stats[$type]))->newInstanceArgs($params);
    }
}

