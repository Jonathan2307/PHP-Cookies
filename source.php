<?php
//developpers.php
//file_get_content permet de récupérer le fichier json 
$json = file_get_contents("assets/json/members.json");
//decode  permet de récupérer une chaîne encodée en JSON et de la convertir en une variable PHP 
$parsed_json = json_decode($json);
$membersArray = $parsed_json->members;


//index.php
$regexName = '/^[a-zA-Z]+$/';
$regexMail = '/^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/';
$regexCP = '/^[0-9]{5}$/';
$redirect = 4;
$errorArray = array();
$valid = array();

if (isset($_POST['submit'])) {
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    $age = trim(htmlspecialchars($_POST['age']));
    $ugender = $_POST['ugender'];
    $codePost = trim(htmlspecialchars($_POST['codePost']));
    $email = trim(htmlspecialchars($_POST['email']));
    $searchGender = $_POST['searchGender'];

    //verification des regex
    if (!preg_match($regexName, $firstname)) {
        $errorArray['firstname'] = 'Erreur de format de prenom';
        $valid['firstname'] = 'is-invalid ';
    } else {
        $valid['firstname'] = 'is-valid';
    };

    // verification du nom avec la regex
    if (!preg_match($regexName, $lastname)) {
        $errorArray['lastname'] = 'Erreur de format de nom';
        $valid['lastname'] = 'is-invalid ';
    } else {
        $valid['lastname'] = 'is-valid';
    };

    // verification de l'age avec la regex
    if ($age < 18) {
        $errorArray['age'] = 'Age requis 18 ans minimum';
        $valid['age'] = 'is-invalid ';
    } else {
        $valid['age'] = 'is-valid';
    };

    // verification du CP avec la regex
    if (!preg_match($regexCP, $codePost)) {
        $errorArray['codePost'] = 'Erreur de code postale';
        $valid['codePost'] = 'is-invalid ';
    } else {
        $valid['codePost'] = 'is-valid';
    };

    //verification du mail avec la regex
    if (!preg_match($regexMail, $email)) {
        $errorArray['email'] = 'Erreur de format mail';
        $valid['email'] = 'is-invalid ';
    } else {
        $valid['email'] = 'is-valid';
    };

    var_dump($errorArray);

    if (empty($errorArray)) {

        //creation des cookies pour 24h
        setcookie('CKfirstname', $firstname, time() + 24 * 3600);
        setcookie('CKlastname', $lastname, time() + 24 * 3600);
        setcookie('CKage', $age, time() + 24 * 3600);
        setcookie('CKugender', $ugender, time() + 24 * 3600);
        setcookie('CKcodePost', $codePost, time() + 24 * 3600);
        setcookie('CKemail', $email, time() + 24 * 3600);
        setcookie('CKsearchGender', $searchGender, time() + 24 * 3600);

        extract($_POST);
        header("Location: ./developpers.php");
    }
};


// user.php
if (isset($_COOKIE['CKfirstname'])) {
    header('Location: ./user.php');
};

if (isset($_POST['submit'])) {
    CKdelete();
    header("Location: ./index.php");
};
// Parcourt le tableau des cookies
function CKdelete()
{

    foreach ($_COOKIE as $cookie_name => $cookie_value) {

        // Puis désactive le cookie en lui fixant 
        // une date d'expiration dans le passé
        setcookie($cookie_name, '', time() - 4200);
    }
};

?>