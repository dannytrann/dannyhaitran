<?php

/**
 * Our homepage.
 *
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Login extends Application {

    function __construct() {
        parent::__construct();
//        $this->restrict(ADMIN);
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'DANNY HAI TRAN > LOGIN';
        $this->data['cover'] = 'cover';
        $this->data['pagebody'] = 'login';
        $this->data['my-info'] = 'content';
        $this->data['footer'] = '_footer';
        $this->data['cover-name'] = 'LOGIN AREA';
        $this->data['button-blurb'] = 'PROCEED TO LOGIN';

        $this->render();
    }
    function validate(){
        if (empty($_POST['username']))
            $this->errors[] = "username cannot be empty";
        if (empty($_POST['password']))
            $this->errors[] = "password cannot be empty";


        $key = $_POST['username'];
        $password = md5($_POST['password']);

        if ($this->users->exists($key)) {
            $user = $this->users->get($key);
        } else {

            $this->errors[] = "Username does not exist";
        }

        //validation starts here
        if (count($this->errors) < 1) {
            //validation ends
            if ($password == (string) $user->password) {
                $this->session->set_userdata('username', $key);
                $this->session->set_userdata('userRole', $user->role);
                
                redirect('/admin');
            } else {
                $this->errors[] = "passwords is incorrect";
                $this->index();
            }
        } else {
            $this->index();
        }
    }
}