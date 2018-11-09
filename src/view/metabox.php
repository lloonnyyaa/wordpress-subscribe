<?php if (!$notified): ?>
    <button id="notify-subscribers" class="button button-large" data-postid="<?php echo $post ?>">Notify</button>
    <div id="response" style="display: none">Notifications sended</div>
<?php else: ?>
    already notified
<?php endif?>