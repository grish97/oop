<?php
namespace Core;

Class View {
    public function render($view) {
        $pageView = $this->get_view($view);
        $layouts = $this->get_view("layouts.main");
        $page = str_replace("@content",$pageView, $layouts);
        return $page;
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
}