<?php

require_once 'app/models/Home.php';

class HomeController {
    public function index() {
        $souliers = Home::getSoulier();
        include 'app/views/partials/header.php';
        include 'app/views/home.php';
        include 'app/views/partials/footer.php';
    }

}