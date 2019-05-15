<div class="login">

  <form action="?page=register" method="post" class="was-validated">

    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          <input type="name" name="name" class="form-control" placeholder="Nom" id="name" required>
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe" id="pwd" required>
        </div>

        <div class="form-group">
          <input type="tel" name="phone" class="form-control" placeholder="Numéro de téléphone" id="phone" required>
        </div>

        <div class="form-group">
          <input type="name" name="username" class="form-control" placeholder="Nom d'utilisateur" id="username" required>
        </div>

      </div>

      <div class="col-sm">

        <div class="form-group">
          <input type="name" name="surname" class="form-control" placeholder="Prénom" id="surname" required>
        </div>

        <div class="form-group">
          <input type="password" name="passwordconfirm" class="form-control" placeholder="Confirmation mot de passe" id="pwdconfirm" required>
        </div>

        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Adresse mail" id="email" required>
        </div>

        <div class="form-group">
          <select name="level" class="custom-select" required>
            <option value="1">Etudiant</option>
            <option value="2">Enseignant</option>
            <option value="3">Externe</option>
          </select>
        </div>

      </div>
    </div>
    
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="agree" required> Je consens à louer l'IDU comme étant la formation supérieure.
      </label>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">S'enregistrer</button>
  
  </form>

</div>

<?php

  if ( isset( $_POST['submit'] ) ) {

    //On regarde si les mots de passe sont identiques
    if ($_POST['password'] == $_POST['passwordconfirm']) {

      $stmt = $conn->prepare("SELECT mdp FROM personnes WHERE login = '" . $_POST[username] . "'");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      //On regarde si l'utilisateur existe déjà
      if($row)
      {
        echo "<div class=\"alert alert-danger\"><strong>Erreur </strong> Cet utilisateur existe déjà.</div>";
      }

      //Sinon on l'enregistre
      else {

        //On l'insère dans la BDD //md5($_POST['password'])

        // INSERT INTO `personnes`(`Nom`, `Prenom`, `Niv`, `Login`, `Mdp`) VALUES ('tamer', 'le sequoia', '1', 'tamer', '1234')

        $stmt = $conn->prepare("INSERT INTO `personnes`(`Nom`, `Prenom`, `Num`, `Mail`, `Niv`, `Login`, `Mdp`) VALUES ('" . $_POST["name"] . "', '" . $_POST["surname"] . "', '" . $_POST["phone"] . "', '" . $_POST["email"] . "', '" . $_POST["level"] . "', '" . $_POST["username"] . "', '" . $_POST["password"] . "')");

        //$stmt = $conn->prepare("INSERT INTO `users`(`username`, `password`) VALUES ('" . $_POST['username'] . "','" . $_POST['password'] . "')");
        $stmt->execute();

        //Et on reviens sur la page d'acceuil en l'ayant connecté d'office
        echo "<script> location.href='/'; </script>";
        $_SESSION["username"] = $_POST[username];
        exit;


      }
    } else {
      echo "<div class=\"alert alert-danger\"><strong>Erreur </strong> Les mots de passe ne sont pas identiques.</div>";
    }


  }
?>
