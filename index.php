<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Projet INFO632</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
  </head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "anto1998";

try {
    $conn = new PDO("mysql:host=$servername;dbname=info642;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
}


function getUserLevel($conn, $user) {

  $stmt = $conn->prepare("SELECT niv FROM `personnes` WHERE login = '" . $user . "'");
  $stmt->execute();

  $row = $stmt->fetch();

  return $row[0];
}


if( !isset($_GET["page"]) ) {
  $page="home";
}else{
  $page = $_GET["page"];
}

  if( file_exists($page.".php") ){
    include($page.".php");
  }
?>


  


<header class="page-header header container-fluid">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:24px 0;">
    <a class="navbar-brand" href="?page=home">Accueil</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="?page=MRT">Vers Page de MRT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=HENAFF">Vers Page de Theo</a>
        </li>
        <?php
          if (isset($_SESSION["username"])) {

            // FAIRE ATTENTION AUX PERMISSION POUR CHAQUES PAGES POUR LES DONNEES SENSIBLES

            //switch ($_SESSION["level"]) {
            switch (getUserLevel($conn, $_SESSION["username"])) {

              //Si le niveau est de 1 c'est à dire que nous somme un enseignant
              case 1:
                  echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"?page=visualisation_demande\">Visualiser les demandes</a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"?page=gestion_expert\">Gestion des experts</a>
                  </li>
                  ";
                  break;

              //Si le niveau est de 2 c'est à dire que nous somme un expert
              case 2:
                  echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"?page=resume_formation_volume_horraire\">Résumé des formations / volume horraire</a>
                  </li>";
                  break;

              //Si le niveau est de 3 c'est à dire que nous somme un admin
              case 3:
                  echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"?page=admin_users\">Gestion des utilisateurs</a>
                  </li>";
                  break;

              //Si le niveau est tout le reste (si les choses sont bien faites c'est 0) c'est à dire un etudiant
              default:
                  echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"?page=saisie_demande\">Saisir une demande</a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"?page=visualisation_demande\">Visualiser les demandes</a>
                  </li>
                  ";
                  break;
            }
          }
        ?>

      </ul>
      <ul class="navbar-nav ml-auto">
        <?php
          if (isset($_SESSION["username"])) {
            echo "<li class=\"nav-item\">
            <a class=\"nav-link\" href=\"?page=profile\">" . $_SESSION["username"] . "</a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link\" href=\"?page=logout\">Se déconnecter</a>
            </li>";
          } else {
            echo "<li class=\"nav-item\">
            <a class=\"nav-link\" href=\"?page=login\">Se connecter</a>
            </li>
            <li class=\"nav-item\">
              <a class=\"nav-link\" href=\"?page=register\">S'enregistrer</a>
            </li>";
          }
        ?>
      </ul>
    </div>
  </nav>
</header>












</body>
</html>
