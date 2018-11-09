<?php

namespace vds\controller;

use vds\component\Plugin;

class FrontController extends PluginController {

    public function init() {
        $this->emails = Plugin::$options_controllers->emails;
    }

    public function wpActionWpEnqueueScripts() {
        $data = [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'selector' => Plugin::$options_controllers->options['button_selector']
        ];

        wp_enqueue_script(Plugin::SHORT_NAME, Plugin::$url . '/view/js/subscribe.js', [], '', true);
        wp_enqueue_style(Plugin::SHORT_NAME, Plugin::$url . '/view/css/style.css');
        wp_localize_script(Plugin::SHORT_NAME, Plugin::SHORT_NAME . '_data', $data);
    }

    public function wpActionWpFooter() {
        echo $this->render('subscribe_form');
    }

    public function ajaxActionVdSubscribe() {
        check_ajax_referer('vd_subscribe_form_nonce', 'vd_form_nonce');

        $email = filter_input(INPUT_POST, 'email');

        if (!is_email($email))
            wp_send_json_error('email error');

        if (in_array($email, $this->emails))
            wp_send_json_error('you are subscribed');

        $this->emails[] = $email;

        if (update_option(Plugin::SHORT_NAME . '_emails', $this->emails)) {
            wp_send_json_success('success');
        } else {
            wp_send_json_error('error! try again later');
        }
    }

}
