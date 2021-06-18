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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Love Machine</title>
</head>

<body>
    <div id="form">
        <div class="container-fluid">
            <h1 class="text-center">Bonjour <?= $_COOKIE['CKfirstname'] ?? null ?>, heureux de vous revoir !</h1>
            <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6  mx-auto">
                <input disabled class="form-control <?= $_COOKIE['CKfirstname'] ?? null ?>" type="text" name="firstname" id="firstname" placeholder="Your firstname" value="<?= $_COOKIE['CKfirstname'] ?? null  ?> " required>
                <label for="firstname">Your firstname</label>


            </div>
            <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                <input disabled class="form-control <?= $_COOKIE['CKlastname'] ?? null ?>" type="text" name="lastname" id="lastname" placeholder="Your lastname" value="<?= $_COOKIE['CKlastname'] ?? null ?> " required>
                <label for="lastname">Your lastname</label>

            </div>
            <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                <input disabled class="form-control" type="text" name="age" id="age" placeholder="Your age" required value="<?= $_COOKIE['CKage'] ?? null ?>">
                <label for="age">Your age</label>
            </div>


            <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                <input disabled class="form-control" type="text" name="codePost" id="codePost" placeholder="Your post code" required value="<?= $_COOKIE['CKcodePost'] ?? null ?> ">
                <label for="codePost">Your post code in 5 digit</label>


            </div>
            <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                <input disabled class="form-control" type="mail" name="email" id="email" placeholder="Your email" value="<?= $_COOKIE['CKemail'] ?? null ?> " required>
                <label for="email">Your email</label>


            </div>
            <div class="mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto d-flex justify-content-center">Vous recherchez <?php if ($_COOKIE['CKsearchGender'] == 'female') {
                                                                                                                    print('une femme');
                                                                                                                } else {
                                                                                                                    print('un homme');
                                                                                                                } ?>
            </div>
            <div class="mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto d-flex justify-content-center">Vous êtes <?php if ($_COOKIE['CKugender'] == 'female') {
                                                                                                                print('une femme');
                                                                                                            } else {
                                                                                                                print('un homme');
                                                                                                            } ?>

            </div>
        </div>
    </div>
    <form action="user.php" method="post">
        <div class="d-grid gap-2 mx-auto">
            <button class="btn btn-primary d-grid gap-2 mx-auto" type="submit" name="submit">Effacer toutes traces</button>
            <a href="https://imgur.com/Gc7IFzZ"><button class="btn btn-primary d-grid gap-2  mx-auto" type="button">Shut up and take my money</button></a>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>