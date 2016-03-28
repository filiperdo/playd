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
        $objPeca = new Peca_Model();
        
        $row_1 = $objPeca->getTotalByStatus( Statuspeca_Model::EM_ABERTO );
        $this->view->getTotal['EM_ABERTO'] = $row_1['total'];
        
        $row_2 = $objPeca->getTotalByStatus( Statuspeca_Model::PRONTO_VERDE );
        $this->view->getTotal['PRONTO_VERDE'] = $row_2['total'];
        
        $row_3 = $objPeca->getTotalByStatus( Statuspeca_Model::PRONTO_AMARELO );
        $this->view->getTotal['PRONTO_AMARELO'] = $row_3['total'];
        
        $row_4 = $objPeca->getTotalByStatus( Statuspeca_Model::AGUARDANDO_FLEX );
        $this->view->getTotal['AGUARDANDO_FLEX'] = $row_4['total'];
        
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
        
    }
    
}