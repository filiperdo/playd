<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
<<<<<<< HEAD
        Auth::handleLogin();
=======
>>>>>>> 34b1e18370ba8688d6d719a3c6276197d1a13910
    }
    
    function index() {

        $this->view->title = 'Home';
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }
    
}