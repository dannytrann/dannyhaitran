<?php

/**
 * This is a model for projects, but with temporary data
 *
 * @author glo and dtran
 */
class Projects extends MY_Model {

    var $data = array();

    /*
     * Constructor
     */

    public function __construct() {
        parent::__construct('projects', '_id');
    }

    /*
     * Retrieves a single attraction by ID
     */

    public function getByID($id) {
        $temp = $this->projects->get($id);
        return $temp;
    }

    /*
     * Retrieves all projects
     */

    public function getAll() {
        return $this->projects->all();
    }

    /*
     * Retrieves all projects in a category
     */

    public function getByCategory($category) {
        $records = $this->projects->some('_id', $category);
        return $records;
    }

    /*
     * Retrieves the most recent attraction by date value
     */

    public function getMostRecent() {
        $records = $this->projects->all();

        $temp = $this->projects->get(1);
        // iterate over the data and return most recent
        foreach ($records as $record)
            if ($record->date > $temp->date)
                $temp = $record;
        return $temp;
    }

}
