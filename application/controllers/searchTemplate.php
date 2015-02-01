<?php
/**
 * The homepage.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class SearchTemplate extends Application {

    function __construct() {
        parent::__construct();

    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        require_once "application/helpers/Format.php";
        require_once "application/core/REST_Controller.php";
        require "assets/assets/twitteroauth-0.4.1/autoloader.php";
        $this->data['title'] = 'DANNY HAI TRAN';
        
        $this->data['pagebody'] = 'empty';
        $this->data['my-info'] = 'empty';
        $this->data['cover'] = 'tweet';
        $this->data['footer'] = '_footer';
  
        $this->render2();
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */