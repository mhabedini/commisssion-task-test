<?php

namespace App\Traits;

trait Storagable
{
    private static mixed $instance = null;
    private array $storage = array();

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function create(array $array)
    {
        self::getInstance()->storage[] = $array;
    }

    public static function all()
    {
        return collect(self::getInstance()->storage);
    }

}
