<?php
namespace Core;

Class View {

    protected $contents = "";

    public function render($view, $title) {
        $pageView = $this->get_view($view);
        $layouts = $this->get_view("layouts.main");
        $this->contents = str_replace("@content",$pageView, $layouts);
        $this->contents = str_replace("@title", $title, $this->contents);
        return $this;
    }

    public function render_partial() {

    }

    public function get_view($view) {
        $path = views_path(str_replace(".", "/", $view) . ".php");
        if(is_readable($path)) {
            ob_start();
            require($path);
            return ob_get_clean();
        }
        return null;
    }

    public function __toString() {
        return $this->contents;
    }
}