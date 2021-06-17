# PHP - Les cookies : Miam Miam Miam

**Pour les exercices qui suivent** :

- Bien respecter *les normes W3C*.  
- Ne pas oublier le CSS : ***Bootstrap*** de rigueur dans vos exercices !  

## Un site de rencontre pour les gens exigeants qui ne voit que le monde à travers un IDE
> Les cookies rassemblent les gens et ça, vous le savez bien ;)

Cette exercice aura la structure suivante :

- **assets**
    - *style.css*
    - *script.js*
    - *members.json*
    - img
- *index.php*
- *developpers.php*
- *user.php*

## MISE EN PLACE DES DONNEES DANS LE FORMAT "JSON"

> Mise en place des données du site : Les fameux developpeurs / euses <3

Transformer le **tableau à 2 dimensions** en un **fichier json** qui contiendra les informations suivantes :

- [ 'members' => 
    - 'id' => '001',
    - 'lastname' => 'DOE',
    - 'firstname' => 'John',
    - 'age' => '33ans',
    - gender => 'homme',
    - mail => 'mail@mail.com',
    - zipcode => '76600',
    - picture => 'monimage.jpg', **!! ATTENTION !!, il va falloir mettre le nom de la photo que vous allez enregistrer dans votre *assets/img***
    - description => 'Je suis un homme qui ...'  
]

Vous allez devoir créer **12 profils** pour le site : Hommes et Femmes.

## INDEX.PHP

> Création d'un formulaire de pre-inscription sur votre site de rencontre car c'est ici que tout commence ...

Sur la page **index.php**, vous allez créer un formulaire de pré-inscription demandant les infos suivantes :

BIENVENUE JEUNE **<3 LOVER <3**

- Nom
- Prénom
- Age
- Genre
- Code postal
- Adresse mail
- Votre type de recherche : homme ou femme

Vous allez voir un bouton **Rencontrer nos célibataires** qui vous renverra vers la page **developpers.php**.  

Les contraintes :

1. Ses informations seront stockées via la super globale **$_COOKIE** d'une durée de vie de 24H.  
2. Faire un verification que **SI** le formulaire est déja renseigné et que nous arrivons sur **index.php**, rediriger directement sur la page **lovers.php**, **SINON** afficher le formulaire d'inscription cad rester sur la page **index.php**.

## DEVELOPPERS.PHP

> Il est temps de tomber amoureux ...

Faire un **Navbar** de type :  
**Bonjour John <3 / NOS CELIBATAIRES / INSCRIPTION**

Afficher les célibataires selon le type de recherche préalablement enregistré : HOMME ou FEMME (Souvenez-vous des cookies!).  
Les profils seront affichés sous forme de **Card** avec les informations suivantes :

- Images
- Nom
- Prénom
- Age
- Code postal
- Description

Sur cette **Card** vous allez mettre en place un bouton **like <3**.

## USER.PHP

> Affichages des infos et deconnexion :'(

Sur cette page **user.php** :

- Afficher toutes les informations de l'utilisateur lors de l'inscription.
    - Nom
    - Prénom
    - Age
    - Genre
    - Code postal
    - Adresse mail
    - Votre type de recherche : homme ou femme
- Mettre en place 2 boutons
    - Le premier bouton permettant **EFFACER TOUTES TRACES**. Celui ci aura pour effet :
        1. De détruire tous les **cookies** concernant le **User**.
        2. Retourner sur la page **index.php** et donc, comme les cookies ont été détruits, afficher le **formulaire d'inscription**.
    - Le deuxième avec un lien vers le site Meetic et ayant pour nom = **"TAKE MY MONEY"**

> Attention à Cupidon <3-------------------<<