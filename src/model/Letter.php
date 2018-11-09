<?php

namespace vds\model;

class Letter {

    private static $shortcodes = [
        '[title]',
        '[text]',
        '[link]'
    ];

    public static function prepareLetter($postId, $subjectTemplate, $bodyTemplate) {
        self::_setupShortcodes($postId, $bodyTemplate);

        $letter['subject'] = self::_replaceText($subjectTemplate);
        $letter['body'] = self::_replaceText($bodyTemplate);

        return $letter;
    }

    private function _setupShortcodes($postId, $template) {
        self::$shortcodes = array_flip(self::$shortcodes);

        $post = get_post($postId);
        $textLength = self::_findTextLength($template);
        $link = get_permalink($postId);

        self::$shortcodes['[title]'] = $post->post_title;
        self::$shortcodes['[link]'] = "<a href=\"{$link}\">link</a>";
        self::$shortcodes['[text:' . $textLength . ']'] = substr($post->post_content, 0, $textLength) . '...';

        return self::$shortcodes;
    }

    private function _findTextLength($template) {
        preg_match('/\[text:[0-9]+\]/', $template, $output);
        return preg_replace("/[^0-9]+/", "", $output[0]);
    }

    private function _replaceText($template) {
        return str_replace(array_keys(self::$shortcodes), self::$shortcodes, $template);
    }

}
