<?php

/**
 * Our homepage.
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
        $this->data['title'] = 'DANNY HAI TRAN';
        $this->data['cover'] = 'cover';
        $this->data['pagebody'] = 'content';
        $this->data['my-info'] = 'my-info';
        $this->data['footer'] = '_footer';
        $this->data['cover-name'] = 'DANNY HAI TRAN';
        $this->data['button-blurb'] = 'VIEW PROJECTS';
        
        $items = array('elephant.jpg', 'days.jpg');
        $this->data['top'] = $items[array_rand($items)];

        $source = $this->projects->getAll();
        $projects = array();
        $imagesArray = array();
        foreach($source as $record){
            $imageSource = $this->images->getByID($record->_id);
            foreach($imageSource as $imageRecord){
                $imagesArray[] = array('image' => $imageRecord->fileName);
                    
            }
            $projects[] = array(
                'id' => $record->_id,
                'name' => $record->name,
                'description' => $record->description,
                'link' => $record->link,
                'images' => $imagesArray,
                'logo' => $record->logo,
                'type' => $record->type
        );
            $imagesArray = null;
        }
        
        $this->data['accordion'] = $projects;
        $this->render();
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */