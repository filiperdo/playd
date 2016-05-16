<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() {

        $this->view->title = 'Home';
        
        require_once 'models/peca_model.php';
        require_once 'models/statuspeca_model.php';
        require_once 'models/produto_model.php';
        
        $this->view->objStatus = new Statuspeca_Model();
        $this->view->objPeca = new Peca_Model();
        $this->view->objProduto = new Produto_Model();
        
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
        
    }
    
}