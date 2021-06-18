<?php
//controle a l'entree pour eviter de visiter la page sans inscription
if (!isset($_COOKIE['CKfirstname'])) {
    header('Location: ./index.php');
};
//file_get_content permet de récupérer le fichier json 
$json = file_get_contents("assets/json/members.json");
//decode  permet de récupérer une chaîne encodée en JSON et de la convertir en une variable PHP 
$parsed_json = json_decode($json);
$membersArray = $parsed_json->members;


//fonction permettant de traduire le genre pour le front
function myGender()
{
    if ($_COOKIE['CKsearchGender'] == 'female') {
        print('femme');
    } else {
        print('homme');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <div id="navBar">
        <ul>
            <li>Bonjour <?= $_COOKIE['CKfirstname'] ?? null ?></li>
            <li>NOS CELIBATAIRES</li>
            <a href="./index.php">
                <li>INSCRIPTION</li>
            </a>
        </ul>
    </div>
    <div id="main">

        <?php foreach ($membersArray as $value) {
            if ($value->gender == $_COOKIE['CKsearchGender']) { ?>

                <div class="boxcontent" id="content">
                    <div class="img">
                        <img src="<?= $value->picture ?>" class="test" width=100% height=100%>
                    </div>
                    <div class="column">
                        <div class="titre"><?= $value->firstname . " " . $value->lastname ?></div>
                        <div class="genreAge">
                            <div class="conteneurEtoil"><?= myGender() ?></div>
                            <div class="rate">&nbsp;<?= $value->age ?>&nbsp;</div>
                        </div>
                        <div class="texte"><span>description:&nbsp; </span><?= $value->description ?></div>
                        <div class="noteInteger"><?= $value->mail ?></div>
                        <div class="codePostal">code postal:&nbsp; <?= $value->zipcode ?></div>
                        <button type="button">Like</button>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>

</html>