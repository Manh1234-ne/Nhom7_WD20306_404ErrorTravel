<?php
require_once __DIR__ . '/../configs/env.php';

class HomeController {
    public function index() {
        // Nếu bạn có view home.php
        require PATH_VIEW . 'home.php';
    }
};
