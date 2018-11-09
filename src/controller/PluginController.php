<?php

namespace vds\controller;

use vds\component\Plugin;

class PluginController {

    const ACTION_PREFIX = 'wpAction';
    const AJAX_ACTION_PREFIX = 'ajaxAction';

    public function __construct() {        
        $this->init();
        $this->initActions();
    }

    protected function init() {
        
    }

    public function initActions() {
        $reflection_class = new \ReflectionClass($this);

        $actions_patern = '/^' . self::ACTION_PREFIX . '(.*)$/';
        $ajax_actions_patern = '/^' . self::AJAX_ACTION_PREFIX . '(.*)$/';

        foreach ($reflection_class->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (preg_match($actions_patern, $method->name, $m)) {
                $action = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $m[1]));
                add_action($action, [$this, $method->name]);
            } elseif (preg_match($ajax_actions_patern, $method->name, $m)) {
                $action = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $m[1]));
                add_action('wp_ajax_nopriv_' . $action, [$this, $method->name]);
                add_action('wp_ajax_' . $action, [$this, $method->name]);
            }
        }
    }

    public function render($view, $params = []) {
        $file = Plugin::$path . 'view' . DIRECTORY_SEPARATOR . $view . '.php';
        if (file_exists($file)) {
            ob_start();
            ob_implicit_flush(false);
            extract($params, EXTR_OVERWRITE);
            require($file);

            return ob_get_clean();
        } else {
            return '';
        }
    }

}
