<?php

namespace Core;

Class Html 
{
    private $allowedTags = [
        "paired" => ["p","h1","h2","h3","h4","h5","h6","form"],
        "single" => ["input"]
    ];

    private static $instance;

    public static function __callStatic($method, $argument) {

        if(!self::$instance) {
            self::$instance = new self();
        }
        if(in_array($method, self::$instance->allTags())) {
            return self::$instance->tag($method, $argument[0], !empty($argument[1]) ? $argument[1] : []);
        }else {
            echo "Unknown Html Tag";
        }
    }


    public function input() {
        return "hello World";
    }

    public function tag($type, $arg1, $arg2) {
        if(in_array($type, $this->allowedTags["paired"])) {
            return $this->pairedTag($type, $arg1, $arg2);
        }else if(in_array($type, $this->allowedTags["single"])) {
            return $this->singleTag($type, $arg1);
        }
    }

    private function pairedTag(string $type, string $innerText = null, array $attributes = []) {
        
        $attr = $this->renderArguments($attributes);
        return "<$type $attr>$innerText</$type>";
    }

    private function singleTag(string $type, array $attributes = []) {
        $attr = $this->renderArguments($attributes);
        return "<$type $attr/>";
    }

    private function renderArguments(array $attributes = []) {
        $attrArray = [];
        foreach ($attributes as $key => $value) {
            $attrArray[] = "$key=\"$value\"";
        }
        return implode(" ", $attrArray);
    }

    private  function allTags() {
        return array_merge($this->allowedTags["paired"],$this->allowedTags["single"]);
    }
}