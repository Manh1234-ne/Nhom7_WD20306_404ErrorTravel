<?php
require_once 'BaseModel.php';

class Tour extends BaseModel {
    protected $table = 'tour';

    // Hàm format giá hiển thị
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
