<?php
	require("../../../config_vp2019.php");
	require("functions_film.php");
	$userName = "Tauri Miilits";
	$database = "if19_tauri_mi_1";
	
	//var_dump($_POST);
	//kui on nuppu vajutatud
	if(isset($_POST["submitFilm"])){
		//salvestame, kui vähemalt pealkiri on olemas (! ees - eitus)
		if(!empty($_POST["submitFilm"])){
		saveFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"], $_POST["filmGenre"], $_POST["filmCompany"], $_POST["filmDirector"]);
		}
	}
	
	//lisame lehe päise
	require("header.php");
?>


<body>
	<?php
		echo "<h1>" .$userName ." koolitöö leht </h1>";
	?>
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid, lisame uue</h2>
  <p>Täida kõik filmid ja lisa andmebaasi:</p>
  <form method="POST">
	<lable>Sisesta pealkiri: </lable><input type="text" name="filmTitle">
	<br>
	<lable>Filmi tootmisaasta: </lable><input type="number" min="1912" max="2019" value="2019" name="filmYear">
	<br>
	<lable>Filmi kestus (min): </lable><input type="number" min="1" max="300" value="80" name="filmDuration">
	<br>
	<lable>Filmi žanr: </lable><input type="text" name="filmGenre">
	<br>
	<lable>Filmi tootja: </lable><input type="text" name="filmCompany">
	<br>
	<lable>Filmi lavastaja: </lable><input type="text" name="filmDirector">
	<br>
	<input type="submit" value="Salvesta filmi info" name="submitFilm">
  </form>
 
  <?php
  //echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  //echo $filmInfoHTML;
  ?>
</body)>
</html>