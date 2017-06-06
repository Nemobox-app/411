<?php

namespace FOO;

class Null_Enricher extends Enricher {
    public static $TYPE = 'null';

    public static function process($data) {
        return $data;
    }

    public static function processHTML($data) {
        return htmlentities($data, ENT_QUOTES, 'UTF-8');
    }
}
