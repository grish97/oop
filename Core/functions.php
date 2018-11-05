<?php

function replace_separator($path) {
    return preg_replace("/[\\/]/", DIRECTORY_SEPARATOR, $path);
}

function base_path($path) {
    return replace_separator(BASE_PATH . "/" . $path);
}

function app_path($path) {
    return base_path("app" . "/"  . $path);
}

function views_path($path) {
    return app_path("Views/" . $path);
}

function get_connection() {
    return Core\Database\Connection::getInstance();
}

function get_config($key) {
    return Core\Config\Manager::get($key);
}

function get_router() {
    return Core\Router::getInstance();
}

function view($view) {
    $v = new Core\View();
    return $v->render($view);
}

function view_partial($view) {
    $v = new Core\View();
    return $v->render_partial($view);
}