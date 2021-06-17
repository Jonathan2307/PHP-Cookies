<?php
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
        header("Location: ./user.php");
    }
};

if (isset($_COOKIE['CKfirstname'])) {
    header('Location: ./user.php');
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
            <h1 class="text-center">Pre inscription</h1>
            <form action="index.php" method="post">
                <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6  mx-auto">
                    <input class="form-control <?= $valid['firstname'] ?? null ?>" type="text" name="firstname" id="firstname" placeholder="Your firstname" value="<?= $firstname ?? null ?> " required>
                    <label for="firstname">Your firstname</label>
                    <span class="text-danger"><?= $errorArray['firstname'] ?? null ?></span>

                </div>
                <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                    <input class="form-control <?= $valid['lastname'] ?? null ?>" type="text" name="lastname" id="lastname" placeholder="Your lastname" value="<?= $lastname ?? null ?> " required>
                    <label for="lastname">Your lastname</label>
                    <span class="text-danger"><?= $errorArray['lastname'] ?? null  ?></span>

                </div>
                <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                    <input class="form-control <?= $valid['age'] ?? null ?>" type="text" name="age" id="age" placeholder="Your age" required value="<?= $age ?? null ?> ">
                    <label for="age">Your age</label>
                    <span class="text-danger"><?= $errorArray['age'] ?? null  ?></span>

                </div>


                <div class="mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto d-flex justify-content-center">Vous êtes :
                    <div class="d-flex">
                        <div class="mx-1">
                            <input class="form-check-input" name='ugender' type="radio" value="male" checked="checked">
                            <label class="form-check-label" for="ugender">Homme</label>
                        </div>
                        <div>
                            <input class="form-check-input" name='ugender' type="radio" value="female">
                            <label class="form-check-label" for="ugender">Femme</label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                    <input class="form-control <?= $valid['codePost'] ?? null ?>" type="text" name="codePost" id="codePost" placeholder="Your post code" required value="<?= $codePost ?? null ?> ">
                    <label for="codePost">Your post code in 5 digit</label>
                    <span class="text-danger"><?= $errorArray['codePost'] ?? null ?></span>


                </div>
                <div class="form-floating mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto">
                    <input class="form-control <?= $valid['email'] ?? null ?>" type="mail" name="email" id="email" placeholder="Your email" value="<?= $email ?? '' ?> " required>
                    <label for="email">Your email</label>
                    <span class="text-danger"><?= $errorArray['email'] ?? null ?></span>


                </div>
                <div class="mb-3 col-sm-8 col-md-7 col-lg-6 mx-auto d-flex justify-content-center">Vous recherchez :
                    <div class="d-flex">
                        <div class="mx-1">
                            <input class="form-check-input" name='searchGender' type="radio" value="male">
                            <label class="form-check-label" for="searchGender">Homme</label>
                        </div>
                        <div>
                            <input class="form-check-input" name='searchGender' type="radio" value="female" checked="checked">
                            <label class="form-check-label" for="searchGender">Femme</label>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-6 text-center mx-auto">
        <input class="btn col-sm-8 col-md-7 col-lg-8 btn-primary" type="submit" id="submit" value="Rencontrer nos célibataires" name="submit">
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>