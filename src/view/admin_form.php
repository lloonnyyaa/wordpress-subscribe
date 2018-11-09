<div class="wrap">
    <div>
        <h1>Viaduct Subscribe Options</h1>
    </div>
    <form method="post">
        <h2>General settings</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="button-selector">Button selector</label></th>
                    <td>
                        <input type="text" id="button-selector" name="vd_subscribe[button_selector]" value="<?php echo!empty($options['button_selector']) ? $options['button_selector'] : '' ?>">
                        <p class="description">CSS selector</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2>Email Template</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="email-from">From</label></th>
                    <td>
                        <input type="text" id="email-from" name="vd_subscribe[email_from]" value="<?php echo!empty($options['email_from']) ? $options['email_from'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="email-subject">Email subject</label></th>
                    <td>
                        <input type="text" id="email-subject" name="vd_subscribe[email_subject]" value="<?php echo!empty($options['email_subject']) ? $options['email_subject'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="email-body">Email body</label></th>
                    <td>
                        <?php
                        wp_editor(!empty($options['email_body']) ? $options['email_body'] : '', 'wpeditor', [
                            'wpautop' => 0,
                            'media_buttons' => 0,
                            'teeny' => 0,
                            'textarea_rows' => 10,
                            'tabindex' => 1,
                            'textarea_name' => 'vd_subscribe[email_body]'
                        ]);
                        ?>
                        <p class="description">You can use shortcodes: [title] - post title, [link] - post link, [text:00] - post text, where '00' - number of characters of text (used only for email body).</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2>SMTP settings</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="smtp-enabled">Use smtp</label></th>
                    <td>
                        <input type="checkbox" id="smtp-enabled" name="vd_subscribe[smtp_enabled]" <?php checked("on", $options['smtp_enabled'])?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="smtp-host">Host</label></th>
                    <td>
                        <input type="text" id="smtp-host" name="vd_subscribe[smtp_host]" value="<?php echo!empty($options['smtp_host']) ? $options['smtp_host'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="smtp-port">Port</label></th>
                    <td>
                        <input type="text" id="smtp-port" name="vd_subscribe[smtp_port]" value="<?php echo!empty($options['smtp_port']) ? $options['smtp_port'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="button-selector">Encryption</label></th>
                    <td>
                        <select id="smtp-encryption" name="vd_subscribe[smtp_encryption]">
                            <option value="none" <?php selected('none', $options['smtp_encryption']) ?>>none</option>
                            <option value="ssl" <?php selected('ssl', $options['smtp_encryption']) ?>>SSL</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="smtp-user">Username</label></th>
                    <td>
                        <input type="text" id="smtp-user" name="vd_subscribe[smtp_user]" value="<?php echo!empty($options['smtp_user']) ? $options['smtp_user'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="smtp-pass">Password</label></th>
                    <td>
                        <input type="password" id="smtp-pass" name="vd_subscribe[smtp_pass]" value="<?php echo!empty($options['smtp_pass']) ? $options['smtp_pass'] : '' ?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="<?php _e('Save', 'vd-subscribe'); ?>" name="vds_save" class="button button-primary">
        <?php wp_nonce_field('vd_settings_form_submit', 'vd_form_nonce');?>
    </form>
</div>
