<?php

// Hämta klass från annan fil
require_once("router.php");


App::get("/", function(){
    include("views/home.php");
});


App::get("/about", "views/about");



App::get("/faq", "views/faq");

// om request som användaren gör inte funkar visa 404.php som finns i views
App::any("/404","views/404");