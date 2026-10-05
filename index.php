<?php

// Hämta klass från annan fil
require_once("router.php");
require_once("response.php");



App::get("/", 'views/home');
App::get("/about", "views/about");
App::get("/faq", "views/faq");





// Routes för guitars
App::get("/guitars/create", 'views/create');
App::post("/guitars/create", function () {
    Res::debug($_POST);
});

// Sparar detta till fredag...
App::get('/guitars/$id', function ($id) {
    Res::debug($id);
});

// Route för att kunna visa formulär på webbsidan
App::get("/register", "views/register");

// Route för att ta emot data som skickats via formuläret på route ovan.
App::post("/register", function () {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        Res::redirect("/register", "Måste fylla i data");
        return;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        Res::redirect("/register", "Epost-fel");
        return;
    }
    if (strlen($_POST['password']) < 8) {
        Res::redirect("/register", "Minst 8 tecken på lösenord");
        return;
    }


    // Kolla epost och lösenord så att allt är ok.
    // Kalla på en registringsfunktion

});






// om request som användaren gör inte funkar visa 404.php som finns i views
App::any("/404", "views/404");
