<?php

namespace Core;

Class Redirector {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public static function setHeader() {
        header("Location: " . $this->url);
        return $this;
    }
}