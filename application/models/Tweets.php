<?php

/**
 * This is a model for Tweets
 *
 * @author Danny Tran
 */
class Tweets extends MY_Model {
    /*
     * Constructor
     */

    public function __construct() {
        parent::__construct('tweets', '_id');
    }

    public function index_get()
    {
        //Display all Tweets
        $this->response($this->db->get('tweets')->result());
    }
}
