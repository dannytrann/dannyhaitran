<?php

/**
 * Our homepage.
 *
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Admin extends Application {

    function __construct() {
        parent::__construct();
        $this->restrict(ADMIN);
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'DANNY HAI TRAN > ADMIN';
        $this->data['cover'] = 'cover';
        $this->data['pagebody'] = 'admin';
        $this->data['my-info'] = 'content';
        $this->data['footer'] = '_footer';
        $this->data['cover-name'] = 'HELLO, WELCOME TO THE ADMIN PAGE';
        $this->data['button-blurb'] = 'NEW PROJECT';


//        edit section

        $source = $this->projects->getAll();
        $projects = array();
        $listofprojects = array();
        $imagesArray = array();
        foreach ($source as $record) {
            $imageSource = $this->images->getByID($record->_id);
            foreach ($imageSource as $imageRecord) {
                $imagesArray[] = array('image' => $imageRecord->fileName);
            }
            $projects[] = array(
                'id' => $record->_id,
                'name' => $record->name,
                'description' => $record->description,
                'images' => $imagesArray
            );
            $listofprojects[] = array(
                'pid' => $record->_id,
                'pname' => $record->name
            );
            $imagesArray = null;
        }

        $this->data['accordion'] = $projects;
        $this->data['list-of-projects'] = $listofprojects;
        $this->render();
    }
    function post() {
        // config uploader settings and load helpers and libraries
        $config['upload_path'] = 'data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|xml';
        $config['overwrite'] = 'TRUE';
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload', $config);

        if (empty($_POST['name'])) {
            $this->errors[] = 'Name cannot be left blank';
        } else {

            $record['name'] = $_POST['name'];
        }
        if (empty($_POST['description'])) {
            $this->errors[] = 'Description must not be empty';
        } else {
            $record['description'] = $_POST['description'];
        }
        
        if (count($this->errors) < 1) {
            $record['_id'] = "";
            $record['date_added'] = date("Y-m-d");
            $this->projects->add($record);
        }
        $this->data['name'] = "";
        $this->data['description']="";
        redirect('admin');
    }
    function image(){
          // config uploader settings and load helpers and libraries
        $config['upload_path'] = 'data/projects';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|xml';
        $config['overwrite'] = 'TRUE';
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload', $config);

        if (empty($_POST['pid'])) {
            $this->errors[] = 'Project name cannot be left blank';
        } else {

            $record['projectID'] = $_POST['pid'];
        }
        $image = null;
        if ($this->upload->do_upload('pimage')) {
            $image = $_FILES['pimage']['name'];
        }
        if (count($this->errors) < 1) {
            $record['_id'] = "";
            $record['fileName'] = $image;
            $this->images->add($record);
        }
        $this->data['pid'] = "";
        $this->data['pimage']="";
        redirect('admin');
    }
}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */