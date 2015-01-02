<?php

/**
 * This is a model for Images
 *
 * @author Danny Hai Tran
 */
class Images extends MY_Model {

    /*
     * Constructor
     */

    public function __construct() {
        parent::__construct('images', '_id');
    }
        public function getByID($id) {
        $records = $this->images->some('projectID', $id);
        return $records;
    }
}