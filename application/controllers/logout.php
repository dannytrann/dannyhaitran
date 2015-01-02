<?php

/*
 * A Controller to logout of the current user session
 */

class Logout extends Application {

    function index() {
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('home');
    }

}
