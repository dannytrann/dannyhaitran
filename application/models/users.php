<?php

/**
 * This is a model for Images
 *
 * @author Danny Hai Tran
 */
class USERS extends MY_Model {

    /*
     * Constructor
     */

    public function __construct() {
        parent::__construct('users', 'username');
    }
}