<?php
require_once 'BaseModel.php';

class qlb extends BaseModel {
    protected $table = 'dat_tour';
     public static function formatVND($number) {
        if ($number >= 100000000) {
            return round($number / 1000000) . ' triệu';
        } elseif ($number >= 1000000) {
            $million = $number / 1000000;
            return ($million == (int)$million) ? $million.' triệu' : round($million,1).' triệu';
        } elseif ($number >= 1000) {
            $thousand = $number / 1000;
            return ($thousand == (int)$thousand) ? $thousand.' nghìn' : round($thousand,1).' nghìn';
        } else {
            return $number.' VNĐ';
        }
    }
}