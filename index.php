<?php

session_start();

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
        Res::redirect_error("/register", "Måste fylla i data");
        return;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        Res::redirect_error("/register", "Epost-fel");
        return;
    }
    if (strlen($_POST['password']) < 8) {
        Res::redirect_error("/register", "Minst 8 tecken på lösenord");
        return;
    }


    // hämta lista med users
    $users = json_decode(file_get_contents("users.json"), true);

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Först kolla så att användren inte redan finns

    $checkUser = array_find($users, function ($u) use ($email) {
        return $u['email'] == $email;
    });

    if ($checkUser != null) {
        Res::redirect_error("/register", "Användare finns redan");
        return;
    }
    // Skapa id till ny user
    $id = uniqid(true);

    // automatisk append/push
    $users[] = [
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "id" => $id
    ];

    // spara användare till fil;

    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));

    Res::redirect("/register", "REGISTER SUCCESS");
});

// Route som visar formulär
App::get("/login", "views/login");

// Route som tar emot användarens inloggningsdata
App::post("/login", function () {

    $email = $_POST['email'];
    $password = $_POST['password'];

    //  Hämta alla users
    $users = json_decode(file_get_contents("users.json"), true);

    // Hitta användare med email = $email
    $checkUser = array_find($users, function ($u) use ($email) {

        return $email == $u['email'];
    });

    // Om vi INTE hittar en användare
    if ($checkUser == null) {
        Res::redirect_error("/register", "No such user please REGISTER!!!");
        return;
    }

    // Kolla lösenord för nu vet vi att vi hittat en user
    if (!password_verify($password, $checkUser['password'])) {
        Res::redirect_error("/login", "Wrong password");
        return;
    }

    // TJOHO nu är vi inloggade vad ska hända nu??????

    $_SESSION["auth"] = true;
    $_SESSION['email'] = $email;

    Res::redirect("/","LOGGED IN");

});


App::get("/session", function(){

    Res::debug($_SESSION);

});

App::get("/secret", function(){

    if(empty($_SESSION['auth'])){
        Res::redirect_error("/", "NOT LOGGED IN");
        return;
    }

    Res::redirect("/", "The secret is friday!!!");


});

App::get("/logout", function(){

    session_destroy();
    Res::redirect("/", "Logged OUT");

});


// om request som användaren gör inte funkar visa 404.php som finns i views
App::any("/404", "views/404");
