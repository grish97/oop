<?php

namespace Core;

trait SingletonTrait {

    private static $instance;

    public static function getInstance() {
        if(!static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}   