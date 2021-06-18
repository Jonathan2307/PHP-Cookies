<?php
//file_get_content permet de récupérer le fichier json 
$json = file_get_contents("assets/json/members.json");
var_dump($json);
//decode  permet de récupérer une chaîne encodée en JSON et de la convertir en une variable PHP 
$parsed_json = json_decode($json);
$membersArray = $parsed_json->members;
var_dump($parsed_json);
function displayMenMembers($membersArray)
{
    foreach ($membersArray as $value) {
        if ($value->gender == "homme") {
            echo '<div class="boxcontent" class="content">
        <div class=img >
        <img src=$value->picture class=test width=100% height=100%>
        </div>
        <div class= "column" >
            <div class="titre" >.$value->firstname .$value->lastname</div>
            <div class="genreAge">
            <div class="conteneurEtoil">$value->gender </div>
            <div class="rate"> $value->age</div>
            </div>
            <div class="texte"> <span>description :</span>  $value->description</div>
            <div class="noteInteger"> $value->mail</div>
            <div class= "codePostal">code postal :$value->zipcode</div>
            <button type="button">Like</button>
        </div>
    </div>';
        }
    }
};
displayMenMembers($membersArray);
foreach ($membersArray as $value) {
    if ($value->gender == $_cookie["CKugender"]) {
        echo "<div class=boxcontent class=content>
            <div class=img >
            <img src=$value->picture class=test width=100% height=100%>
            </div>
            <div class= column >
                <div class=titre >$value->firstname $value->lastname</div>
                <div class=genreAge>
                <div class=conteneurEtoil>$value->gender </div>
                <div class=rate> $value->age</div>
                </div>
                <div class=texte <span>description :</span>  $value->description</div>
                <div class=noteInteger>$value->mail</div>
                <div class= codePostal>code postal :$value->zipcode</div>
                <button type=button>Like</button>
            </div>
        </div>";
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
            <li>Bonjour <? $name ?></li>
            <li>NOS CELIBATAIRES</li>
            <li>INSCRIPTION</li>
        </ul>
    </div>
    <div id="main">

        <?php foreach ($membersArray as $value) {
            if ($value->gender == "homme") { ?>

                <div class="boxcontent" id="content">
                    <div class="img">
                        <img src="<?= $value->picture ?>" class="test" width=100% height=100% >
                    </div>
                    <div class="column">
                        <div class="titre"><?= $value->firstname . " " . $value->lastname ?></div>
                        <div class="genreAge">
                            <div class="conteneurEtoil"><?= $value->gender ?></div>
                            <div class="rate"><?= $value->age ?></div>
                        </div>
                        <div class="texte"><span>description :</span> $value->description</div>
                        <div class="noteInteger">$value->mail</div>
                        <div class="codePostal">code postal :$value->zipcode</div>
                        <button type="button">Like</button>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>



    <!-- <script src="assets/js/script.js"></script> -->
    <script>
console.log(document.querySelectorAll("#content"))
    </script>
</body>

</html>