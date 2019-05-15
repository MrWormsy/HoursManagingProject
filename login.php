<div class="login">

  <form action="?page=login" method="post">
    <div class="form-group">
      <label for="username">Login :</label>
      <input type="username" name="username" class="form-control" id="username">
    </div>
    <div class="form-group">
      <label for="pwd">Mot de passe :</label>
      <input type="password" name="password" class="form-control" id="pwd">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
  </form>

</div>

<?php

  // md5($_POST[password])

  if ( isset( $_POST['submit'] ) ) {
    $stmt = $conn->prepare("SELECT mdp FROM personnes WHERE login = '" . $_POST[username] . "' AND mdp = '" . $_POST[password] . "'");
    $stmt->execute();
    $row = $stmt->fetch();

    if( ! $row)
    {
      echo "<div class=\"alert alert-danger\"><strong>Erreur </strong> Le mot de passe est incorecte.</div>";
    } else {
      echo "<script> location.href='/'; </script>";
      $_SESSION["username"] = $_POST[username];
      exit;
    }
  }
?>
