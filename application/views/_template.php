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
        <link href="/assets/css/button.css" rel="stylesheet" type="text/css"/>
        <link href='http://fonts.googleapis.com/css?family=Karla:400,400italic' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="{alerting} white whiteBox">
            {errormessages}
        </div>
        <div id="cover" class="parallax-window" data-parallax="scroll" data-image-src="/data/bg/{top}"       >
            {cover}
        </div>
        <div id="content">
            {content}
        </div>
        <div id="about" class="parallax-window" data-parallax="scroll" data-image-src="/data/bg/sky.jpg">
            {my-info}
        </div>  
        {footer}
        <script src="/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/parallax.min.js"></script>
        <script src="/assets/js/prefixfree.min.js" type="text/javascript"></script>
        <script>
            $('#viewProjects').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                        || location.hostname == this.hostname) {

                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        </script>
    </body>
</html>
