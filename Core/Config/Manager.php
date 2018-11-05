<?php

namespace Core\Config;

Use Core\SingletonTrait;

Class Manager {

    Use SingletonTrait;

    private $configs = [
        "main",
    ]; 

    private static $load_connnf = [];

    private function __construct() {
        foreach ($this->configs as $config) {
            $this->load_connf[$config] = [];
            $path = base_path("config/" . $config . ".php");
            if (file_exists($path)) {
                $this->load_connf[$config] = array_replace_recursive($this->load_connf[$config], require_once($path));
            }else {
                echo "Config for $config not Found";
                exit;
            }

        }
}

    public static function get($key) {
        $configs = self::getInstance()->load_connf;
        $parts = explode(".", $key);
        foreach($parts as $part) {
            $configs = !empty($configs[$part]) ? $configs[$part] : null;
        }
        return $configs;
    }
    
}