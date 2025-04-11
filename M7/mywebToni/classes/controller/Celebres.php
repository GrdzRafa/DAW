<?php

class Celebres extends Controller{
    protected $registresPerPagina = 10;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header("location:index.php?user/log_in");
        }
    }
}

