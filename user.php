<?php

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