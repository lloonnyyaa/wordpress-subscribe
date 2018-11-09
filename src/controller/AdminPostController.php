<?php

namespace vds\controller;

use vds\component\{
    Plugin,
    SwiftMailerAdapter,
    WpMailer
};
use vds\model\Letter;

class AdminPostController extends PluginController {

    private $options;
    private $emails;

    public function init() {
        $this->options = Plugin::$options_controllers->options;
        $this->emails = Plugin::$options_controllers->emails;
    }

    public function wpActionAdminEnqueueScripts() {
        if (is_admin()) {
            wp_enqueue_script(Plugin::SHORT_NAME, Plugin::$url . 'view/js/admin.js');
            //wp_enqueue_script('jquery-ui-tabs');
        }
    }

    public function wpActionAddMetaBoxes() {
        add_meta_box(Plugin::SHORT_NAME, 'Notify subscribers', function($post, $meta) {
            echo $this->render('metabox', ['post' => $post->ID, 'notified' => get_post_meta($post->ID, '_vd_notified', true)]);
        }, ['post', 'page'], 'side');
    }

    public function ajaxActionVdNotifySubscribers() {
        $postId = filter_input(INPUT_POST, 'post_id');
        $mailer = $this->_getMailerInstance();
        $letter = Letter::prepareLetter($postId, $this->options['email_subject'], $this->options['email_body']);
        $body = $this->render('mail/body', ['text' => $letter['body']]);

        $result = $mailer->sendAll($this->emails, $letter['subject'], $body, $this->options['email_from']);

        update_post_meta($postId, '_vd_notified', 1);
        wp_send_json($result);
    }

    private function _getMailerInstance() {
        if (isset($this->options['smtp_enabled']) && $this->options['smtp_enabled'] == 'on') {
            return new SwiftMailerAdapter(
                    $this->options['smtp_host'], $this->options['smtp_user'], $this->options['smtp_pass'], $this->options['smtp_port'], $this->options['smtp_encryption']
            );
        } else {
            return new WpMailer();
        }
    }

}
