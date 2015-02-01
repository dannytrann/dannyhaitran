<?php
/**
 * The homepage.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Home extends Application {

    function __construct() {
        parent::__construct();

    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        require_once "application/helpers/Format.php";
        require_once "application/core/REST_Controller.php";
        require "assets/twitteroauth-0.4.1/autoloader.php";
        $this->data['title'] = 'DANNY HAI TRAN';
        $this->data['cover'] = 'cover';
        $this->data['footer'] = '_footer';
  
        $this->render();
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */