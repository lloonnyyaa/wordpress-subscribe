<div class="subscribe-modal" id="subscribe-modal">
    <div class="content-modal">
        <span class="close-modal">&times;</span>
        <form method="post" id="vd-subscribe-form">
            <label for="email-input">Email</label>
            <input type="email" name="email" required>
            <?php wp_nonce_field('vd_subscribe_form_nonce', 'vd_form_nonce'); ?>
            <input type="hidden" name="action" value="vd_subscribe">
            <input type="submit" value="Subscribe">
        </form>
        <div id="response"></div>
    </div>
</div>