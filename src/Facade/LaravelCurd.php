<?php
/**
 * Created by PhpStorm.
 * User: Lany
 * Date: 2020/6/17
 * Time: 上午10:54
 */
namespace Lany\LaravelCurd\Facade;
class LaravelCurd extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'l_curd';
    }
}
