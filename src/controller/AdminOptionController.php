<?php

namespace vds\controller;

use vds\component\Plugin;

class AdminOptionController extends PluginController {

    public $options;
    public $emails;

    public function init() {
        $this->options = get_option(Plugin::SHORT_NAME);
        $this->emails = get_option(Plugin::SHORT_NAME . '_emails');

        $save = filter_input(INPUT_POST, 'vds_save') !== null;

        if ($save)
            $this->saveOptions();
    }

    public function wpActionAdminMenu() {
        add_options_page('Subscribe', 'Subscribe Options', 'read', 'vd-subscribe-options.php', function() {
            echo $this->render('admin_form', [
                'options' => $this->options
            ]);
        });
    }

    public function saveOptions() {
        $options = filter_input(INPUT_POST, Plugin::SHORT_NAME, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        update_option(Plugin::SHORT_NAME, array_filter($options));
        $this->options = $options;
    }

}
