<?php

/**
 * Our homepage.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Thefacestudio extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->load->view(APPPATH.'TFS/TheFaceStudio/app/index');
       
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */