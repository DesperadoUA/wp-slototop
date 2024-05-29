<?php
class Cash {
    public static function get($url) {
        global $wpdb;
        $result = $wpdb->get_results("SELECT data FROM `cash` WHERE url = '{$url}'");
        return count($result) ? $result[0]->data : [];
    }
    public static function store($url, $data) {
        global $wpdb;
        $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO `cash` ( url, data ) VALUES ( %s, %s )",
                $url,
                $data
            )
        );
    }
    public static function clear() {
        global $wpdb;
        $result = $wpdb->get_results("TRUNCATE TABLE cash");
    }
}