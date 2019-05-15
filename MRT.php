
 <!-- faire requete pour avoir option du formulaire -->
<div class = "page">


  <form  method="post">
    Séléctionnez un domaine : <select name="domaine">
    <?php
        $stmt=$conn->prepare('SELECT DISTINCT NomDomaine FROM domaine');
        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
          echo  "<option>".$row["NomDomaine"]."</option>";
        }
        echo "</select>";
    ?>
    <button type="submit" name="bouton">Rechercher les experts</button>
  </form>


  <?php
    if (isset($_POST["bouton"])) {
      $selectedDomain=$_POST["domaine"];
      $stmt2=$conn->prepare("SELECT Nom,Prenom,Num FROM personnes,domexpert,domaine WHERE domaine.NomDomaine LIKE '". $selectedDomain ."' AND domexpert.IdDomaine = domaine.IdDomaine AND personnes.IdPersonnes = domexpert.IdPersonnes");

      $stmt2->execute();
      $results2=$stmt2->fetchAll(PDO::FETCH_ASSOC);
      if ($results2)  { 
        echo "<table class=\"table table-bordered\">
        <thead>
          <tr><th>Expert du domaine ".$selectedDomain."</th></tr>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
          </tr>
        </thead>
        <tbody>";
        foreach ($results2 as $row) {
          echo "<tr>
            <td>".$row["Nom"]."</td>
            <td>".$row["Prenom"]."</td>
            <td>".$row["Num"]."</td>
            </tr>";
          }
          echo "</tbody>
          </table>";
      }
      else {
        echo "Aucun expert dans ce domaine";
      } 
    }
  ?>
</div>
