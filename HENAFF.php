<div class="page">


<?php 

if (getUserLevel($conn, $_SESSION["username"]) == 1) {

	echo "
	<form method=\"post\" name=\"formulaire\">
		<fieldset>
			
			<legend> Saisie d'une démarche </legend>
			<p>	</p>
				<label>date :</label>
				<input type=\"date\" name=\"datee\">

			<p>	</p>
				<label>Durée :</label>
				<input type=\"time\" name=\"duree\">

			<p>	</p>
				<label>matière :</label>
				<select name = \"domaine\">";
	        $stmt=$conn->prepare('SELECT NomMatieres FROM matieres');
	        $stmt->execute();
	        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
	        foreach ($results as $row) {
	          echo "<option>" . $row["NomMatieres"] . "</option>";
	        }
	        echo "</select>
			<p>	</p>
				<label>unite :</label>
				<input type=\"text\" name=\"unite\">

			<p>	</p>
				<label>valmin :</label>
				<input type=\"text\" name=\"valmin\">

			<p>	</p>
				<label>valmax :</label>
				<input type=\"text\" name=\"valmax\">

			<br><br>
				<input type=\"submit\" name=\"bouton\" value=\"Envoyer\">
		</fieldset>
	</form>
	";
}
else {
	echo "<p>You are not an ELEVE</p>";
}
?>

</div>