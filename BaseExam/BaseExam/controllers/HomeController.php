<?php
require_once __DIR__ . '/../configs/env.php';

class HomeController {
    public function index() {
        require PATH_VIEW . 'home.php';
    }
};
