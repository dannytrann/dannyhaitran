<?php
if (!defined('APPPATH'))
    exit('No direct script access allowed');
/**
 * view/template.php
 *
 * Pass in $pagetitle (which will in turn be passed along)
 * and $pagebody, the name of the content view.
 *
 * ------------------------------------------------------------------------
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{title}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/materialize.css"/>
    </head>
    <body>
        <div class="{alerting} white whiteBox">
            {errormessages}
        </div>
        <div id="cover">
            {cover}
        </div>
        <div>
            {footer}
        </div>
        <script src="/assets/js/libs/jquery-2.1.3.js"></script>
        <script src="/assets/js/libs/materialize.js"></script>
        <script src="/assets/js/libs/underscore.js"></script>
        <script src="/assets/js/libs/backbone.js"></script>
        <script src="/assets/js/libs/bootstrap.js"></script>
        <script src="/assets/js/main.js"></script>
        
    </body>
</html>
