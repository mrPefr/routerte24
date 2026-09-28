<?php

// Hämta klass från annan fil
require_once("router.php");
require_once("response.php");



App::get("/", 'views/home');
App::get("/about", "views/about");
App::get("/faq", "views/faq");


// Routes för guitars
App::get("/guitars/create", 'views/create');
App::post("/guitars/create",function(){
    Res::debug($_POST);
});


// om request som användaren gör inte funkar visa 404.php som finns i views
App::any("/404", "views/404");


